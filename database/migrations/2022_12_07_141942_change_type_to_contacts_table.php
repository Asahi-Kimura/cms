<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('company_name')->nullable(false)->change();
            $table->string('user_name')->nullable(false)->change();
            $table->string('tele_num')->nullable(false)->change();
            $table->string('email')->nullable(false)->change();
            $table->date('birthday')->nullable(false)->change();
            $table->string('sex')->nullable(false)->change();
            $table->string('job')->nullable(false)->change();
            $table->text('content')->nullable(false)->change();
            //備考欄
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
        Schema::table('contacts', function (Blueprint $table) {
            //
        });
    }
}
