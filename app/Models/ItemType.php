<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * ItemTypes - predefined:
 * - education
 * - translation
 * impact polish booking law and necessary notes on invoices
 */
class ItemType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ([
        'name',
        'type' // education or translation (important for invoicing - regulation about VAT exemption in Poland)
    ]);

    public function items(){
        return $this->hasMany(Item::class);
    }
}
