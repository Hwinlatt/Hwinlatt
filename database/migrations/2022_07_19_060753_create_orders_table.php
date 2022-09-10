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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_code')->nullable();
            $table->string('name');
            $table->string('email');
            $table->date('will_deli_date')->nullable();
            $table->dateTime('received_date')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->text('remark')->nullable();
            $table->string('phone_one');
            $table->string('phone_two');
            $table->text('address');
            $table->string('country',20);
            $table->string('city',20);
            $table->string('payment',20);
            $table->integer('total_price');
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
        Schema::dropIfExists('orders');
    }
};
