<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name')->index();
            $table->string('code');
            $table->string('address')->index();
            $table->string('maps')->nullable();
            $table->string('phone')->nullable()->index();
            $table->string('fax')->nullable()->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable();
            $table->unsignedInteger('ward_id');
            $table->unsignedInteger('district_id');
            $table->unsignedInteger('province_id');
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
        Schema::dropIfExists('warehouses');
    }
}
