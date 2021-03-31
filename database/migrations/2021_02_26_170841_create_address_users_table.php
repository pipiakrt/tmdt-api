<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('phone')->nullable()->index();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('ward_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('province_id');
            $table->tinyInteger('status')->default(0)->index();
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
        Schema::dropIfExists('address_users');
    }
}
