<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_users', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('email')->nullable();
            $table->string('name');
            $table->string('phone');
            $table->string('note')->nullable();
            $table->string('address');
            $table->enum('order_method', ['COD', 'Online']);
            $table->string('order_status')->default('1');
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
        Schema::dropIfExists('order_users');
    }
}
