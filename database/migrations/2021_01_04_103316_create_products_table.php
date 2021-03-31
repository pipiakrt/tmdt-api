<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->nullable()->index();
            $table->string('slug')->nullable()->index();
            $table->string('avatar')->nullable()->index();
            $table->text('description')->nullable();
            $table->unsignedInteger('origin_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->integer('star')->default(5)->index();
            $table->integer('favourite')->default(0)->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->unsignedInteger('employee_id')->nullable();
            $table->unsignedInteger('booth_id')->nullable();
            $table->unsignedInteger('province_id')->nullable();
            $table->unsignedInteger('condition_id')->nullable();
            $table->decimal('price', 10, 2)->nullable()->default(0)->index();
            $table->decimal('discount', 10, 2)->nullable()->default(0)->index();
            $table->integer('amount')->default(0)->nullable()->index();
            $table->integer('sold')->default(0)->index();
            $table->string('classification_group_one')->nullable()->index();
            $table->string('classification_group_two')->nullable()->index();
            $table->integer('weight')->default(0)->index();
            $table->integer('length')->default(0)->index();
            $table->integer('width')->default(0)->index();
            $table->integer('height')->default(0)->index();
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
        Schema::dropIfExists('products');
    }
}
