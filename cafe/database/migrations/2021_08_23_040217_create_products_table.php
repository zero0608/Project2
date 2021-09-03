<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('IdProduct',50)->primary()->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('NameProduct',200)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->integer('Quantity')->nullable(true);
            $table->string('Unit',10)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->string('Images',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('CostPrice')->nullable(true);
            $table->integer('SallingPrice')->nullable(true);
            $table->string('IdSupplier',50)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('Idcate')->nullable(true);
        
            $table->index(['Idcate','IdSupplier']);
            $table->foreign('Idcate')->references('Idcate')->on('categories');
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
        Schema::dropIfExists('products');
    }
}
