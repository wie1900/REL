<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocsTable extends Migration
{
    /**
     * Docs - documents:
     * - revenues
     * - expenses
     * - no predefioned records
     */
    public function up()
    {
        Schema::create('docs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('doctype_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('description');
            $table->date('gen');
            $table->date('paygen')->nullable();
            $table->decimal('val')->nullable(); // only for expenses (doctype_id = 2)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docs');
    }
}
