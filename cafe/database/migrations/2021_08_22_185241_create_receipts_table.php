<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
             $table->increments('IdReceipt',1)->nullable(false);
            $table->string('UserId',50)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('IdStore')->nullable(false);
            $table->date('DatePay')->nullable(true);
            $table->text('Note')->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->string('Format',50)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->string('Image',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('Totalprice')->nullable(false);
            $table->foreign('UserId')->references('UserId')->on('users');
            $table->foreign('IdStore')->references('IdStore')->on('stores');
            $table->index(['IdStore', 'UserId']);
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
        Schema::dropIfExists('receipts');
    }
}
