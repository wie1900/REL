<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Clienttype
 * - Customers (clienttype_id = 1) for those we sell our services (our revenues)
 * - Contractors (clienttype_id = 2) from whe we buy products (our expenses)
 */
class ClientType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ([
        'name'
    ]);

    public function clients(){
        return $this->hasMany(Client::class);
    }
}
