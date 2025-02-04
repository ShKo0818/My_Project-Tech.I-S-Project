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
    Schema::table('orders', function (Blueprint $table) {
        // 'category' フィールドを nullable に変更
        $table->string('category')->nullable()->change();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        // 元に戻す場合は nullable を削除
        $table->string('category')->nullable(false)->change();
    });
}

};
