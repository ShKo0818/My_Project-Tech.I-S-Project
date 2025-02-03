<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsMasterToUsersTable extends Migration
{
    /**
     * 実行するマイグレーション
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_master')->default(false); // is_masterカラムを追加
        });
    }

    /**
     * ロールバックするマイグレーション
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_master'); // カラムを削除
        });
    }
}
