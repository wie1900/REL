<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Doctype for 
 * Revenues (doctype.id = 1)
 * Expenses (doctype.id = 2)
 */
class DocType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ([
        'name'
    ]);

    public function docs(){
        return $this->hasMany(Doc::class);
    }
}
