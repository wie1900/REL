<?php

namespace App\Http\Controllers;

use App\Models\ItemType;
use Illuminate\Http\Request;

/**
 * --------- ItemTypeController ------
 * for possible  managing ItemTypes
 * (base ItemTypes are being added by migrations)
 */
class ItemTypeController extends Controller
{
    // List of itemtypes
    public function index()
    {
        $itemtypes = ItemType::get();
        return view('itemtypes.list', ['itemtypes'=>$itemtypes]);
    }

    // Form for creating a new itemtype
    public function create()
    {
        return view('itemtypes.create');
    }

    // Store a newly created itemtype
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type'=> 'regex:/^(education|translation)$/'
        ],
        [
            'type.regex'=>'Insert \'education\' or \'translation\''
        ]);

        $itemtype = new ItemType();
        $itemtype->name = $request->name;
        $itemtype->type = $request->type;
        $itemtype->save();
        return redirect('itemtypes');
    }


    // Form for editing the specified itemtype
    public function edit($id)
    {
        $itemtype = ItemType::whereId($id)->first();
        return view('itemtypes.edit', ['itemtype'=>$itemtype]);
    }

    // Update the specified itemtype
    public function update(Request $request)
    {
        $validated = $request->validate([
            'type'=> 'regex:/^(education|translation)$/'
        ],
        [
            'type.regex'=>'Insert \'education\' or \'translation\''
        ]);

        $itemtype = ItemType::whereId($request->id)->first();
        $itemtype->name = $request->name;
        $itemtype->type = $request->type;
        $itemtype->save();
        return redirect('itemtypes');
    }

    // Remove the specified itemtype
    public function destroy($id)
    {
        $itemtype = ItemType::whereId($id)->first();
        $itemtype->delete();
        return redirect('itemtypes');
    }

    // Warning window before deleting the itemtype
    public function warning($id)
    {
        $itemtype = ItemType::whereId($id)->first();
        return view('itemtypes.warning', ['itemtype'=>$itemtype]);
    }
}
