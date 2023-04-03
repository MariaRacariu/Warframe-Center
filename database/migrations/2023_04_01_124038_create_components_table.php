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
        Schema::create('components', function (Blueprint $table) {
            $table->id('components_id');
            $table->integer('favorites_id');
            $table->boolean('component_1')->nullable()->default(NULL);
            $table->boolean('component_2')->nullable()->default(NULL);
            $table->boolean('component_3')->nullable()->default(NULL);
            $table->boolean('component_4')->nullable()->default(NULL);
            $table->boolean('component_5')->nullable()->default(NULL);
            $table->boolean('component_6')->nullable()->default(NULL);
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
