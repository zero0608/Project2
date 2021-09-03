<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->increments('id')->nullable(false);
            $table->string('UserId',50)->primary()->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('UserName',100)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->string('Email',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('IdNumber')->nullable(true);
            $table->string('Address',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->integer('Phone')->nullable('true');
            $table->string('Avatar',200)->nullable(true)->collation('utf8mb4_unicode_ci');
            $table->date('Birthday')->nullable(false);
            $table->string('Pass',200)->nullable(false)->collation('utf8mb4_unicode_ci');
            $table->unsignedInteger('GroupId')->nullable(false);
            $table->unsignedInteger('IdStore')->nullable(false);
            $table-> foreign('GroupId')->references('GroupId')->on('groups');
            $table->foreign('IdStore')->references('IdStore')->on('stores');
            $table->index(['IdStore', 'GroupId']);
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
        Schema::dropIfExists('users');
    }
}
