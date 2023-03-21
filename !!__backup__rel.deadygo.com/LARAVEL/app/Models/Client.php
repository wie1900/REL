<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Client class for:
 * - Customers (clienttype_id = 1) for those we sell our services (our revenues)
 * - Contractors (clienttype_id = 2) from whe we buy products (our expenses)
 */
class Client extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ([
        'name',
        'fname',
        'shortname',
        'address',
        'nip',
        'gen',
        'clienttype_id'
    ]);

    public function docs(){
        return $this->hasMany(Doc::class);
    }

    public function clienttype(){
        return $this->belongsTo(ClientType::class);
    }
}
