<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banking_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('type')->default(0);
            $table->string('banking_number');
            $table->decimal('amount_prev', 15, 2);
            $table->decimal('amount_payment', 15, 2);
            $table->decimal('amount_next', 15, 2);
            $table->mediumText('content');
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
        Schema::dropIfExists('banking_histories');
    }
}
