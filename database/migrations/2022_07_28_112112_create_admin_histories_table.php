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
        Schema::create('admin_histories', function (Blueprint $table) {
            $table->id();
            $table->string('type',20)->nullable();
            $table->string('id_s',50)->nullable();
            $table->string('user',50)->nullable();
            $table->longText('actions')->nullable();
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
        Schema::dropIfExists('admin_histories');
    }
};
