<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateClienttypesTable extends Migration
{
    /**
    * ClientTypes, 2 predefined:
    * 1 - Customer (buying sold services)
    * 2 - Contractor (selling bought products)
     */
    public function up()
    {
        Schema::create('client_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        // Insert some production data
        DB::table('client_types')->insert(
            ['name' => 'Customer']
        );
        DB::table('client_types')->insert(
            ['name' => 'Contractor']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_types');
    }
}
