<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name', 64); // Reduced further from 100
            $table->string('column_name', 64); // Reduced further from 100
            $table->unsignedInteger('foreign_key');
            $table->string('locale', 32); // Reduced further from 50
            $table->text('value');
            $table->timestamps();

            $table->unique(['table_name', 'column_name', 'foreign_key', 'locale'], 'translations_unique_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}

