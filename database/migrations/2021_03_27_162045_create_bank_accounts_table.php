<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('cmnd'); // số chứng minh nhân dân
            $table->string('name'); // tên chủ tài khoản ngân hàng
            $table->string('banking_name'); // tên ngân  hàng
            $table->string('banking_number'); // số tài khoản ngân hàng
            $table->string('province'); // khu vực, tỉnh thành
            $table->string('banking_branch'); // chi nhánh
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
        Schema::dropIfExists('bank_accounts');
    }
}
