<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('email');
            $table->string('buyer_phone');
            $table->string('buyer_name');
            $table->string('buyer_document');
            $table->float('discount_rate');
            $table->string('item_name');
            $table->string('item_description');
            $table->string('item_type');
            $table->float('item_qty');
            $table->float('item_amount');
            $table->float('total_amount');
            $table->boolean('iva');
            $table->date('payment_date')->nullable()->change();
            $table->string('payment_ip');
            $table->string('token');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dte');
    }
}
