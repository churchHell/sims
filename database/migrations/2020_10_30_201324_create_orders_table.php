<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->bigInteger('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('pid');
            $table->integer('sid');
            $table->string('name');
            $table->string('url');
            $table->string('img');
            $table->integer('price');
            $table->integer('min_qty');
            $table->string('plural_name_format');
            $table->string('currency', 10);
            $table->bigInteger('cart_status_id')->nullable()->unsigned();
            $table->foreign('cart_status_id')->references('id')->on('cart_statuses');
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
}
