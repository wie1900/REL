<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Doc;
use App\Models\Item;

// Actions on Customers (clienttype 1) buying our services
class CustController extends Controller
{
    // View list of customers
    public function index()
    {
        $clients = Client::orderBy('shortname')->where('clienttype_id', 1)->paginate(20);
        return view('revenues.custlist', ['clients'=>$clients]);
    }

    // Form for creating a new customer
    public function create()
    {
        return view('revenues.custcreate');
    }

    // Store new created customer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip'=> 'regex:/^\d{10}$/'
        ],
        [
            'nip.regex'=>'Insert only pure 10-digit number',
        ]);

        $client = new Client([
            'clienttype_id' => 1,
            'name' => $request->name,
            'fname' => $request->fname,
            'shortname' => $request->shortname,
            'address' => $request->address,
            'nip' => $request->nip,
            'gen' => Carbon::now()->format('Y-m-d')
        ]);
        $client->save();
        return redirect('customers');
    }

    // Form for editing an existing customer
    public function edit($id)
    {
        $client = Client::whereId($id)->first();
        return view('revenues.custedit', ['client'=>$client]);
    }

    // Update an existing customer
    public function update(Request $request)
    {
        $validated = $request->validate([
            'gen'=> 'date|date_format:Y-m-d',
            'nip'=> 'regex:/^\d{10}$/'
        ],
        [
            'gen.date'=>'Insert date in format YYYY-mm-dd',
            'gen.date_format'=>'Insert date in format YYYY-mm-dd',
            'nip.regex'=>'Insert 10-digit number'
        ]);

        $client = Client::whereId($request->id)->first();
        $client->name = $request->name;
        $client->fname = $request->fname;
        $client->address = $request->address;
        $client->nip = $request->nip;
        $client->gen = $request->gen;
        $client->shortname = $request->shortname;
        $client->save();
        return redirect('customers');
    }

    // Remove an existing customer with his documents and their items
    public function destroy($id)
    {
        Item::join('docs','items.doc_id', 'docs.id')->where('docs.client_id', $id)->delete();
        Doc::where('client_id', $id)->delete();
        Client::whereId($id)->first()->delete();
        return redirect('customers');
    }

    // Warning window before deleting a customer
    public function warning($id)
    {
        $client = Client::whereId($id)->with('docs')->first();
        return view('revenues.custwarning', ['client'=>$client]);
    }
}
