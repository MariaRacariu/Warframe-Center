<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //reworked compoents table
        // | COMPONENTS_ID | FAVORITES_ID | NAME | AMOUNT | FILENAME | ACQUIRED     
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->integer('favorites_id');
            $table->string('name');
            $table->integer('amount');
            $table->string('filename');
            $table->boolean('acquired')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('components');
    }
};
