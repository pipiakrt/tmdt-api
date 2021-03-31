<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->index();
            $table->string('email')->unique()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_admin')->default(0);

            $table->string('address')->nullable();
            $table->unsignedInteger('ward_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('province_id')->nullable();

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
        Schema::dropIfExists('employees');
    }
}
