<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiptdetail', function (Blueprint $table) {
            $table->integer('DetaiId',1)->nullable(false);
            $table->string('Idreceipt',50)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('IdProduct',50)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->integer('Quantity')->nullable(true);
            $table->string('Unit',50)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('Price')->nullable(true);
            $table->index(['Idreceipt','IdProduct']);
            $table->foreign('Idreceipt')->references('Idreceipt')->on('storereceipts');
            $table->foreign('IdProduct')->references('IdProduct')->on('products');
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
        Schema::dropIfExists('receiptdetail');
    }
}
