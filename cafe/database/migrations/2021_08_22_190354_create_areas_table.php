<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->integer('IdArea',1)->nullable(false);
            $table->string('BranchName',200)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('IdStore')->nullable(false);
            $table->foreign('IdStore')->references('IdStore')->on('stores');
             $table->index(['IdStore']);
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
        Schema::dropIfExists('areas');
    }
}
