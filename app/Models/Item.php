<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Items are parts of revenues (sold services)
 */
class Item extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ([
        'id',
        'qty',
        'unitprice',
        'itemtype_id',
        'doc_id'
    ]);

    public function itemtype(){
        return $this->belongsTo(ItemType::class);
    }

    public function doc(){
        return $this->belongsTo(Doc::class);
    }
}
