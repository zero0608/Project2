<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('IdCustomer',50)->primary()->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('CustomerName',200)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->integer('PhoneNumber')->nullable(true);
            $table->string('Email',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->string('Address',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->text('Note')->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->date('Birthday')->nullable(true);
            $table->string('Gender',3)->nullable(true)->collation('utf8mb4_unicode_ci');
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
        Schema::dropIfExists('customers');
    }
}
