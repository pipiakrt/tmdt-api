<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('order_id');
            $table->string('quantity')->nullable()->index();
            $table->decimal('price', 10, 2)->nullable()->index();
            $table->string('name_product_attribute')->nullable();
            $table->string('name_attribute_detail')->nullable();
            $table->unsignedInteger('product_attribute_id')->nullable();
            $table->unsignedInteger('attribute_detail_id')->nullable();
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
        Schema::dropIfExists('order_details');
    }
}
