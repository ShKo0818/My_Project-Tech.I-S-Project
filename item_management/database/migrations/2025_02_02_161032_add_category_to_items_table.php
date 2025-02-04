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
        if (!Schema::hasColumn('items', 'category')) {
            Schema::table('items', function (Blueprint $table) {
                $table->string('category')->after('name')->default('その他'); // 種別のデフォルトは「その他」
            });
        }
    }
    
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('items', 'category')) {
            Schema::table('items', function (Blueprint $table) {
                $table->dropColumn('category');
            });
        }
    }
};
