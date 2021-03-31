<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_details', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->nullable()->index();
            $table->string('discount')->nullable()->index();
            $table->string('amount')->nullable()->index();
            $table->unsignedInteger('product_attribute_id')->nullable();
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
        Schema::dropIfExists('attribute_details');
    }
}
