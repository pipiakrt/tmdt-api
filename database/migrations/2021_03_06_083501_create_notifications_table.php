<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            // trường classify dự kiến với tất cả các trường hợp có thể có
            # 0. từ người mua đến người bán -> với những thông báo như: đặt hàng, hủy đơn hàng, đánh giá đơn hàng, bình luân sản phẩm, trả lời lại bình luận...
            # 1. từ người mua đến đến người mua -> với những thông báo như: bình luận, trả lời bình luận...   
            # 3. từ người mua đến người quản trị viên -> với những thông báo như: báo báo lỗi, khiếu nại sản phẩm, hỗ trợ, tư vấn ...
            # 4. từ người bán đến người mua -> với những thông báo như: giao dịch đơn thành công, hủy đơn hàng thành công, mời đánh giá sao sản phẩm, thông báo lỗi đơn hàng, hết hàng...  
            # 5. từ người bán đến người quản trị viên -> với những thông báo như: thêm mới sản phẩm.
            # 6. từ người quản trị viên đến người bán -> với những thông báo như: đã duyệt san phẩm.
            $table->id();
            $table->tinyInteger('from_id');
            $table->string('from_name');
            $table->tinyInteger('to_id');
            $table->string('to_name');
            $table->string('title');
            $table->string('content');
            $table->tinyInteger('type'); //1 Admin->user, 2 User->admin, 3 Admin->admin, 4 user->user
            $table->tinyInteger('classify')->default(0)->index();
            $table->tinyInteger('status')->default(0)->index();
            $table->dateTime('seen')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
