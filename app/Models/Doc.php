<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Docs for
 * Revenues (doctype_id = 1)
 * Expenses (doctype_id = 2)
 */
class Doc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ([
        'name',
        'doctype_id',
        'client_id',
        'description',
        'gen',
        'paygen'
    ]);

    public function doctype(){
        return $this->belongsTo(DocType::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function items(){
        return $this->hasMany(Item::class);
    }

    public function getTotalPrice() {
        if(is_null($this->val)) {
            return $this->items->sum(function($v) {
                return $v->qty * $v->unitprice;
              });
        } else {
            return $this->val;
        }
    }
}
