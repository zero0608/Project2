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
            $table->string('IdBill')->primary()->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('IdUser')->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('IdTable')->nullable(true);
            $table->unsignedInteger('IdStore')->nullable(true);
            $table->string('IdCustomer',50)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('Sale')->nullable(true);
            $table->integer('Totalprice')->nullable(false);
            $table->text('Note')->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->index(['IdUser','IdCustomer','IdTable','IdStore']);
            $table->foreign('IdUser')->references('UserId')->on('users');
            $table->foreign('IdTable')->references('IdTable')->on('tables');
            $table->foreign('IdStore')->references('IdStore')->on('stores');
            $table->foreign('IdCustomer')->references('IdCustomer')->on('customers');

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
        Schema::dropIfExists('bill');
    }
}
