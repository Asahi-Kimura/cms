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
            $table->id();
            $table->integer('prefecture_id');
            $table->string('authority')->nullable();
            $table->string('name')->nullable();
            $table->string('kana')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('post_code')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->string('remark')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
