<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doc;
use App\Models\Client;
use App\Models\ItemType;
use App\Models\Item;
use App\Custom\Revenues\Ity;
use App\Custom\PrintDoc\PDFBuilder;

// Actions on Revenues
class RevController extends Controller
{
    // List of revenues
    public function index()
    {
        $docs = Doc::with('client')
            ->orderBy(DB::raw('substr(gen,1,4)'))
            ->where('doctype_id',1)
            ->orderBy(DB::raw('substr(gen,6,2)'))
            ->with('items')->paginate(20);

        return view('revenues.revlist', ['docs'=>$docs]);
    }

    // Form for creating a new revenue
    public function create(Request $request)
    {
        $invoices = Doc::select('name','gen')->orderBy('substr(gen,1,4)')->get();
        $client = Client::whereId($request->id)->first();
        $itemtypes = ItemType::get();

        //old form input fields values after possible (not passed) validation -> this.store()
        $qty = $request->old('qty');
        $item_id = $request->old('item_id');
        $unitprice = $request->old('unitprice');

        return view('revenues.revcreate',[
                                          'client'=>$client,
                                          'itemtypes'=>$itemtypes,
                                          'inv'=>$invoices,
                                          'item_id'=>$item_id,
                                          'qty'=>$qty,
                                          'unitprice'=>$unitprice
                                        ]);
    }

    // Store a newly created revenue
    public function store(Request $request)
    {
        $request->flash();
        $validated = $request->validate([
            'gen'=> 'date|date_format:Y-m-d',
            'paygen'=> 'nullable|date|date_format:Y-m-d',
            'name' => 'unique:docs,name',
        ],
        [
            'gen.date'=>'Insert date in format YYYY-mm-dd',
            'gen.date_format'=>'Insert date in format YYYY-mm-dd',
            'paygen.date_format'=>'Insert date in format YYYY-mm-dd',
            'name.unique'=>'The inserted invoice number is already taken'
        ]);

        $doc = new Doc();
        $doc->gen = $request->gen;
        $doc->client_id = $request->client_id;
        $doc->doctype_id = 1;
        $doc->description = $request->description;
        $doc->name = $request->name;
        $doc->paygen = $request->paygen;
        $doc->save();

        $i=0;
        foreach ($request->item_id as $iti) {
            $item = new Item();
            $item->doc_id = $doc->id;
            $item->qty = $request->qty[$i];
            $item->unitprice = $request->unitprice[$i];
            $item->itemtype_id = $iti;
            $item->save();
            $i++;
        }
        return redirect('customers');
    }

    // Form for editing the specified revenue
    public function edit(Request $request)
    {
        $invoices = DB::table('docs')->select('name','gen')->orderBy('name')->get();
        $doc = Doc::whereId($request->id)->with('client', 'items', 'items.itemtype')->first();
        $itemtypes = ItemType::get();
        $clients = Client::where('clienttype_id', 1)->get(); // only customers type (1)

        $qty = $request->old('qty');
        $item_id = $request->old('item_id');
        $unitprice = $request->old('unitprice');

        return view('revenues.revedit', [
                                        'doc'=>$doc,
                                        'clients'=>$clients,
                                        'itemtypes'=>$itemtypes,
                                        'inv'=>$invoices,
                                        'item_id'=>$item_id,
                                        'qty'=>$qty,
                                        'unitprice'=>$unitprice,
                                        'backurl'=>substr($doc->gen,0,7)
                                    ]);
    }

    // Update the edited revenue
    // OPTIMIZED TO RUN POSSIBLE MINIMUM NUMBER OF QUERRIES (!)
    // checking: existing, deleted and changed DOC and ITEMS data
    public function update(Request $request)
    {

        $request->flash();
        $validated = $request->validate([
            'gen'=> 'date|date_format:Y-m-d',
            'paygen'=> 'nullable|date|date_format:Y-m-d',
            'name' => 'unique:docs,name,' . $request->doc_id,
        ],
        [
            'gen.date'=>'Insert date in format YYYY-mm-dd',
            'gen.date_format'=>'Insert date in format YYYY-mm-dd',
            'paygen.date_format'=>'Insert date in format YYYY-mm-dd',
            'name,unique'=>'The inserted invoice number is already taken'
        ]);

        // Check differences between original / new doc properties
        $doc = Doc::whereId($request->doc_id)->with('items')->first();

        // IF REV. DOCUMENT DETAILS HAVE changed - apply form data (document section)
        if( $doc->client_id !== $request->client_id ||
            $doc->gen !== $request->gen ||
            $doc->paygen !== $request->paygen ||
            $doc->name !== $request->name ||
            $doc->description !== $request->description)
            {
                $doc->client_id = $request->client_id;
                $doc->gen = $request->gen;
                $doc->paygen = $request->paygen;
                $doc->name = $request->name;
                $doc->description = $request->description;
                $doc->save();
            }

        // IF ITEMS have changed - check what has changed (among items data)
        $ori = array();
        $nee = array();

        // ORIGIN data array
        foreach ($doc->items as $item) {
            $ori[] = new ity($item->id, $item->itemtype_id, $item->qty, $item->unitprice);
        }

        // FORM data array
        $i = 0;
        foreach ($request->item_id as $item) {
            $nee[] = new ity(0, $item, $request->qty[$i], $request->unitprice[$i]);
            $i++;
        }

        // COMPARE ORIGIN WITH FORM data
        // IF IDENTICAL found - marked both as 'done' (set v = 1, default 0)
        foreach ($ori as $a) {
            foreach ($nee as $niu) {
                if($niu->v == 0) {
                    if ($a->comp == $niu->comp) {
                        $niu->v = 1;
                        $a->v = 1;
                        break;
                    }
                }
            }
        }

        // FURTHER COMPARING ORIGINS with v = 0 looking for form data with v = 0
        // IF FOUND - ORIGIN TAKES VALUE from FORM data and are being set to v = 2 (marked to be updated)
        // and FORM data set to v = 1 (as done)
        foreach ($ori as $a) {
            if($a->v == 0) {
                foreach ($nee as $niu) {
                    if($niu->v == 0) {
                        $a->comp = $niu->comp;
                        $a->qty = $niu->qty;
                        $a->unitprice = $niu->unitprice;
                        $a->typeId = $niu->typeId;
                        $a->v = 2;
                        $niu->v = 1;
                        break;
                    }
                }
            }
        }

        // There are left only new added items among Form data
        // THESE FORM DATA should be set to v = 3 (to be added to the ORIGIN array)
        // WHILE LEFT ORIGIN DATA with v = 0 should be deleted
        foreach ($nee as $niu) {
            if($niu->v == 0){
                $niu->v = 3;
                $ori[] = $niu;
            }
        }

        // CREATING 3 arrays: _upd, _del, _add
        // for RECORDS (Items) TO BE updated, deleted and added to the database
        // (with reference to the current document)
        foreach ($ori as $a) {
            switch ($a->v) {
                case 0:
                    $item = Item::whereId($a->id)->first()->delete();
                    break;
                case 2:
                    $item = Item::find($a->id);
                    $item->itemtype_id = $a->typeId;
                    $item->qty = $a->qty;
                    $item->doc_id = $request->doc_id;
                    $item->unitprice = $a->unitprice;
                    $item->save();
                    break;
                case 3:
                    $item = new Item();
                    $item->itemtype_id = $a->typeId;
                    $item->qty = $a->qty;
                    $item->unitprice = $a->unitprice;
                    $item->doc_id = $request->doc_id;
                    $item->save();
                    break;
                default:
                    break;
            }
        }
        // return redirect('revenues');
        return redirect('month/'.$request->backurl);
    }

    // Remove the specified revenue
    public function destroy(Request $request)
    {
        Item::where('doc_id', $request->id)->delete();
        Doc::whereId($request->id)->delete();
        return redirect('month/'.$request->backurl);
    }

    // Warning window before deleting revenue
    public function warning($id)
    {
        $doc = Doc::whereId($id)->with('client')->first();
        return view('revenues.revwarning', ['doc'=>$doc, 'backurl'=>substr($doc->gen,0,7)]);
    }

    // Save DOC as pdf in the given path (here: public/pdf/)
    public function printpdf($id)
    {
        $doc = DOC::whereId($id)->with('client','items','items.itemtype')->first();
        $dpdf = new PDFBuilder($doc);
        // $path = public_path().'/pdf/';
	$path = '/home/srv35437/domains/rel.deadygo.com/public/pdf/';
        $dpdf->save($path);
        return redirect('month/'.substr($doc->gen,0,7));
    }

    // Preview DOC as PDF in new tab window
    public function showPdf($id)
    {
        $doc = DOC::whereId($id)->with('client','items','items.itemtype')->first();
        $dpdf = new PDFBuilder($doc);
        $dpdf->show();
    }
}
