<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilldetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billdetail', function (Blueprint $table) {
            $table->integer('IdDetail',1)->nullable(false);
            $table->string('IdBill',50)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('IdMenu',50)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('Quantity')->nullable(true);
            $table->string('Price',11)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->index(['IdBill','IdMenu']);
            $table->foreign('IdBill')->references('IdBill')->on('bill');
            $table->foreign('IdMenu')->references('IdMenu')->on('menus');
            // $table->primary(['IdBill','IdMenu','IdDetail']);
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
        Schema::dropIfExists('billdetail');
    }
}
