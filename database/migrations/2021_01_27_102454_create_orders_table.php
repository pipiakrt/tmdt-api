<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->index();
            $table->string('guest_name')->nullable()->index();
            $table->string('guest_phone')->nullable()->index();
            $table->string('guest_address')->nullable()->index();
            $table->string('guest_email')->nullable()->index();
            $table->string('code')->nullable()->index();
            $table->string('note')->nullable();
            $table->decimal('total', 12, 2)->nullable()->index();
            $table->decimal('ship_price', 10, 2)->nullable()->index();
            $table->unsignedInteger('employee_id')->nullable();
            $table->unsignedInteger('booth_id');
            $table->tinyInteger('status')->default(1)->index();
            $table->tinyInteger('status_pay')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('ward_id')->nullable();
            $table->unsignedInteger('district_id')->nullable();
            $table->unsignedInteger('province_id')->nullable();
            $table->dateTime('shipped_at')->nullable()->index();
            $table->dateTime('completed_at')->nullable()->index();
            $table->unsignedInteger('shipper_id')->nullable();
            $table->unsignedInteger('transport_id')->nullable();

            $table->tinyInteger('status_id_delivery')->nullable()->index();
            $table->string('id_delivery')->nullable();
            $table->string('estimated_pick_time')->nullable();
            $table->string('estimated_deliver_time')->nullable();
            $table->string('tracking_id_delivery')->nullable();
            $table->string('package_name_freight')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
