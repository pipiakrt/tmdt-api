<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->index();
            $table->string('title')->index();
            $table->string('slug')->unique()->nullable();
            $table->bigInteger('status')->default(0)->index();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('serial')->default(0);
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->bigInteger('featured')->default(0);
            $table->unsignedInteger('employee_id');
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
        Schema::dropIfExists('categories');
    }
}
