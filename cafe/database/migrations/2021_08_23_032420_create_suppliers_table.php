<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->string('IdSupplier',50)->primary()->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('Namesupplier',200)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('Email',100)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('Phone')->nullable(true);
            $table->string('Address',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->text('Note')->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('Debit')->nullable(true);
            $table->string('Avatar',200)->nullable(true)->collation('utf8mb4_unicode_ci');
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
        Schema::dropIfExists('suppliers');
    }
}
