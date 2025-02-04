<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // 商品名
            $table->integer('quantity'); // 数量
            $table->unsignedBigInteger('category_id'); // カテゴリID
            $table->text('detail')->nullable(); // 詳細
            $table->string('company_name'); // 会社名
            $table->date('delivery_date'); // 配送日
            $table->string('image')->nullable(); // 画像
            $table->timestamps();

            // 外部キー制約を設定
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

