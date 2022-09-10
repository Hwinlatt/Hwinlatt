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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->longText('description');
            $table->text('colors') ;
            $table->integer('price');
            $table->text('tags')->nullable();
            $table->integer('price_from')->nullable();
            $table->string('company');
            $table->mediumInteger('qty');
            $table->tinyInteger('populer');
            $table->tinyInteger('available');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
