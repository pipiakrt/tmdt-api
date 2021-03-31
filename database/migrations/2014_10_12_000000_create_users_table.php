<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('phone')->unique();
            $table->string('avatar')->nullable();
            $table->string('cover')->nullable();
            $table->dateTime('birthday')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('point')->default(0);
            $table->decimal('wallet', 15, 2)->default(0);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('gender')->nullable();
            $table->string('user_address_id')->nullable();
            $table->string('booth_id')->nullable();

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
