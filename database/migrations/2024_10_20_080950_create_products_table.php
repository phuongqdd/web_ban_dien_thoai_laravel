<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // Tên sản phẩm
            $table->string('name');
            // Slug sản phẩm, là phiên bản thân thiện với URL
            $table->string('slug')->unique();
            // Mô tả ngắn gọn về sản phẩm, không bắt buộc
            $table->string('short_description')->nullable();
            // Mô tả chi tiết sản phẩm
            $table->text('description');
            // Giá bán gốc
            $table->bigInteger('regular_price');
            // Giá bán sau giảm giá (nếu có), không bắt buộc
            $table->bigInteger('sale_price')->nullable();
            // Mã SKU (Stock Keeping Unit) để quản lý sản phẩm
            $table->string('SKU');
            // Trạng thái tồn kho (còn hàng hoặc hết hàng)
            $table->enum('stock_status', ['instock', 'outofstock']);
            // Đánh dấu sản phẩm nổi bật (true/false), mặc định là false
            $table->boolean('featured')->default(false);
            // Số lượng sản phẩm trong kho, mặc định là 10
            $table->unsignedInteger('quantity')->default(10);
            // Ảnh đại diện của sản phẩm, không bắt buộc
            $table->string('image')->nullable();
            // Nhiều ảnh sản phẩm, có thể lưu dưới dạng chuỗi JSON, không bắt buộc
            $table->text('images')->nullable();
            // Liên kết đến danh mục sản phẩm (category_id), không bắt buộc
            $table->bigInteger('category_id')->unsigned()->nullable();
            // Liên kết đến nhãn hiệu sản phẩm (brand_id), không bắt buộc
            $table->bigInteger('brand_id')->unsigned()->nullable();
            // Khóa ngoại: Liên kết đến bảng 'categories', xóa sản phẩm khi danh mục bị xóa
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // Khóa ngoại: Liên kết đến bảng 'brands', xóa sản phẩm khi nhãn hiệu bị xóa
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
