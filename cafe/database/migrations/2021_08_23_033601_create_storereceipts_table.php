<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorereceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storereceipts', function (Blueprint $table) {
            $table->string('Idreceipt',50)->primary()->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('IdUser',50)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('IdStore')->nullable(false);
            $table->string('IdSupplier',50)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->text('Note')->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('Paymentmethod')->nullable(true);
            $table->string('Image',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('Totalprice')->nullable(true);
            $table->index(['IdUser','IdStore','Idsupplier']);
            $table->foreign('IdUser')->references('UserId')->on('users');
            $table->foreign('IdStore')->references('IdStore')->on('stores');
            $table->foreign('IdSupplier')->references('IdSupplier')->on('suppliers');
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
        Schema::dropIfExists('storereceipts');
    }
}
