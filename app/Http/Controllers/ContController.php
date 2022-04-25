<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Doc;

// Actions on Contractors (clienttype 2) selling products / services to us
class ContController extends Controller
{
    // View list of contractors
    public function index()
    {
        $clients = Client::orderBy('name')->where('clienttype_id', 2)->paginate(20);
        return view('expenses.contlist', ['clients'=>$clients]);
    }

    // Form for creating a new contractor
    public function create()
    {
        return view('expenses.contcreate');
    }

    // Store new created contractor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip'=> 'regex:/^\d{10}$/'
        ],
        [
            'nip.regex'=>'Insert 10-digit number',
        ]);

        $client = new Client();
        $client->clienttype_id = 2;
        $client->name = $request->name;
        $client->fname = $request->fname;
        $client->shortname = $request->shortname;
        $client->address = $request->address;
        $client->nip = $request->nip;
        $client->gen = Carbon::now()->format('Y-m-d');
        $client->save();
        return redirect('contractors');
    }

    // Form for editing an existing contractor
    public function edit($id)
    {
        $client = Client::whereId($id)->first();
        return view('expenses.contedit', ['client'=>$client]);
    }

    // Update an existing contractor
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
        return redirect('contractors');
    }

    // Remove an existing contractor (with all related docs)
    public function destroy($id)
    {
        Doc::where('client_id', $id)->delete();
        Client::whereId($id)->first()->delete();
        return redirect('contractors');
    }

    // Warning window before deleting a contractor
    public function warning($id)
    {
        $client = Client::whereId($id)->first();
        return view('expenses.contwarning', ['client'=>$client]);
    }
}
