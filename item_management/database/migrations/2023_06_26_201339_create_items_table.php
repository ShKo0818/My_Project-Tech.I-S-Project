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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->string('name', 100)->index();
            $table->string('type', 100)->nullable();
            $table->string('detail', 500)->nullable();
            $table->timestamps();
        });

        // usersテーブルにuser_typeカラムを追加
        Schema::table('users', function (Blueprint $table) {
            $table->enum('user_type', ['general', 'corporate', 'master'])->default('general');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_type');  // user_typeのカラムを削除
        });
    }
};
