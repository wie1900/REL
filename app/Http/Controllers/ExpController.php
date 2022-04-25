<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doc;
use App\Models\Client;

// Actions on Expenses
class ExpController extends Controller
{
    // List of expenses (doctype_id = 2)
    public function index()
    {
        $docs = Doc::with('client')->orderBy('gen')->where('doctype_id', 2)->orderBy('name')->with('items')->paginate(20);
        return view('expenses.explist', ['docs'=>$docs]);
    }

    // Form for creating a new expense
    public function create($id)
    {
        $client = Client::whereId($id)->first();
        $doc = new Doc();
        $doc->client_id = $client->id;
        $doc->doctype_id = 2; // expense
        return view('expenses.expcreate',['doc'=>$doc, 'client'=>$client]);
    }

    // Store a newly created expense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gen'=> 'date|date_format:Y-m-d',
            'paygen'=> 'nullable|date|date_format:Y-m-d',
            'val'=> 'regex:/^\d{1,13}(\.\d{1,2})?$/'
        ],
        [
            'gen.date'=>'Insert date in format YYYY-mm-dd',
            'gen.date_format'=>'Insert date in format YYYY-mm-dd',
            'paygen.date_format'=>'Insert date in format YYYY-mm-dd',
            'val.regex'=>'Insert number value (decimals separated by .)'
        ]);

        $doc = new Doc();
        $doc->gen = $request->gen;
        $doc->client_id = $request->client_id;
        $doc->doctype_id = $request->doctype_id;
        $doc->description = $request->description;
        $doc->name = $request->name;
        $doc->paygen = $request->paygen;
        $doc->val = $request->val;
        $doc->save();
        return redirect('contractors');
    }

    // Form for editing the specified expense
    public function edit($id)
    {
        $doc = Doc::where('id', $id)->with('client')->first();
        $clients = Client::where('clienttype_id', 2)->get();
        return view('expenses.expedit', ['doc'=>$doc, 'clients'=>$clients]);
    }

    // Update the specified expense
    public function update(Request $request)
    {
        $validated = $request->validate([
            'gen'=> 'date|date_format:Y-m-d',
            'paygen'=> 'nullable|date|date_format:Y-m-d',
            'val'=> 'regex:/^\d{1,13}(\.\d{1,2})?$/'
        ],
        [
            'gen.date'=>'Insert date in format YYYY-mm-dd',
            'gen.date_format'=>'Insert date in format YYYY-mm-dd',
            'paygen.date_format'=>'Insert date in format YYYY-mm-dd',
            'val.regex'=>'Insert number value (decimals separated by .)'
        ]);

        $doc = Doc::whereId($request->id)->first();
        $doc->client_id = $request->client_id;
        $doc->gen = $request->gen;
        $doc->paygen = $request->paygen;
        $doc->name = $request->name;
        $doc->description = $request->description;
        $doc->val = $request->val;
        $doc->save();
        return redirect('month/'.substr($doc->gen,0,7));
    }


    // Remove the specified expense
    public function destroy(Request $request)
    {
        Doc::whereId($request->id)->delete();
        return redirect('month/'.$request->backurl);
    }

    // Warning window before deleting the specified expense
    public function warning($id)
    {
        $doc = Doc::whereId($id)->with('client')->first();
        return view('expenses.expwarning', ['doc'=>$doc, 'backurl'=>substr($doc->gen,0,7)]);
    }

}
