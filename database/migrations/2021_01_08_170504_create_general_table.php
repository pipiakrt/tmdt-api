<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general', function (Blueprint $table) {
            $table->id()->index();
            
            $table->string('logo_header')->nullable()->index();
            $table->string('logo_footer')->nullable()->index();
            $table->string('thumbnail')->nullable()->index();
            $table->string('favicon')->nullable()->index();

            $table->string('description')->nullable()->index();
            $table->string('title')->nullable()->index();
            $table->string('keywords')->nullable()->index();

            $table->string('name')->nullable()->index();
            $table->string('phone_1')->nullable()->index();
            $table->string('phone_2')->nullable()->index();
            $table->string('address_1')->nullable()->index();
            $table->string('address_2')->nullable()->index();
            $table->string('links_map')->nullable()->index();

            $table->string('facebook')->nullable()->index();
            $table->string('instagram')->nullable()->index();
            $table->string('twitter')->nullable()->index();
            $table->string('youtube')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general');
    }
}
