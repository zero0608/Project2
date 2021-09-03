<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
             $table->string('IdMenu')->primary()->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('NameMenu',200)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->integer('Price')->nullable(true);
            $table->string('Images',200)->nullable(true)->collation('utf8mb4_unicode_ci');
             $table->string('Unit',5)->nullable(true)->collation('utf8mb4_unicode_ci');

            $table->unsignedInteger('Idcate')->nullable(true);
        
            $table->index(['Idcate']);
            $table->foreign('Idcate')->references('Idcate')->on('categories');
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
        Schema::dropIfExists('menus');
    }
}
