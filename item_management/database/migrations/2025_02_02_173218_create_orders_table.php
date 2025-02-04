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
    if (!Schema::hasTable('orders')) { // テーブルがない場合のみ作成
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('quantity');
            $table->unsignedBigInteger('category_id');
            $table->text('detail')->nullable();
            $table->string('company_name');
            $table->date('delivery_date');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    } else {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'category_id')) {
                $table->unsignedBigInteger('category_id');
            }
        });
    }
}

    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

