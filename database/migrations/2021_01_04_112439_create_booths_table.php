<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booths', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->nullable()->index();
            $table->string('email')->unique()->index();
            $table->string('phone')->nullable()->index();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->text('description')->nullable()->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->tinyInteger('highlight')->default(0)->index();
            $table->string('address')->nullable();
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('employee_id')->nullable();
            $table->unsignedInteger('ward_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('province_id')->nullable();
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
        Schema::dropIfExists('booths');
    }
}
