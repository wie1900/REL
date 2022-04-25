<?php

use App\Models\DocType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateDocTypesTable extends Migration
{
    /**
     * DocumntTypes
     * 3 predefioned records:
     * - revenues
     * - expenses
     * - not documented revenues
     * in accordance to polish booking law
     */
    public function up()
    {
        Schema::create('doc_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        // Insert 3 predefined document types
        DB::table('doc_types')->insert(
            ['name' => 'Income']
        );

        DB::table('doc_types')->insert(
            ['name' => 'Cost']
        );

        DB::table('doc_types')->insert(
            ['name' => 'Undocumented sale']
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_types');
    }
}
