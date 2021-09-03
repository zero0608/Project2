<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->integer('IdTable',1)->nullable(false);
            $table->string('TableName',200)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->tinyInteger('Status')->nullable(false);
            $table->integer('IdArea')->nullable(true);
            $table->foreign('IdArea')->references('IdArea')->on('areas');
            $table->index(['IdArea']);
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
        Schema::dropIfExists('tables');
    }
}
