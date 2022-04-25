<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateItemTypesTable extends Migration
{
    /**
     * ItemTypes
     * Few custom predefioned records:
     * - german lessons
     * - translations
     * - medical translations
     * - transport translations
     * mostly used by customers.
     * Additionally itemtypes got their own type, one of two:
     * - education
     * - other services
     * that require different notes on specified invoices.
     */
    public function up()
    {
        Schema::create('item_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
        });

        // THERE ARE ONLY 2 CATEGORIES: EDU and Others eg. TRANSLATIONS
        $type_edu = 'education';
        $type_other = 'translation';

        // Insert some production data
        DB::table('item_types')->insert(
            ['name' => 'German lessons', 'type'=>$type_edu]
        );

        DB::table('item_types')->insert(
            ['name' => 'Translations', 'type'=>$type_other]
        );

        DB::table('item_types')->insert(
            ['name' => 'Translations - medicine', 'type'=>$type_other]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_types');
    }
}
