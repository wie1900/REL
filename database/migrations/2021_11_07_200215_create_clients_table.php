<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Clients - buyers and product deliverers:
     * - customers (buying sold services)
     * - contractors (delivering bought products)
     * - no predefioned records
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fname')->nullable();
            $table->string('shortname');
            $table->string('address');
            $table->char('nip')->length(10)->unsigned()->nullable();
            $table->date('gen');
            $table->integer('clienttype_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
