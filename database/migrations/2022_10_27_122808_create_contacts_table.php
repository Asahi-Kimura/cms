<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('inquiry_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('user_name')->nullable();
            $table->string('tele_num')->nullable();
            $table->string('email')->nullable();
            $table->date('birthday')->nullable();
            $table->string('sex')->nullable();
            $table->string('job')->nullable();
            $table->string('content')->nullable();
            //管理者側表示
            $table->integer('status')->nullable();
            //備考欄
            $table->string('remark')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('contacts');
    }
}
