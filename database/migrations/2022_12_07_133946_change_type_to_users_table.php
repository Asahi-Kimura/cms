<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('authority')->nullable(false)->change();
            $table->string('name')->nullable(false)->change();
            $table->string('kana')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->string('phone_number')->nullable(false)->change();
            $table->string('post_code')->nullable(false)->change();
            $table->string('city')->nullable(false)->change();
            $table->string('password')->nullable(false)->change();
            $table->text('remark')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
