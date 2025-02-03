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
        Schema::table('items', function (Blueprint $table) {
            $table->string('company_name')->nullable();  // メーカー名
            $table->string('image')->nullable();  // 画像のパス
            $table->string('category')->nullable(); 
        });
    }
    
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn(['company_name', 'image','category']);
        });
    }
    
};
