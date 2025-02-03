<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // テーブル名の指定
    protected $table = 'categories';

    // マスアサインメント可能な属性
    protected $fillable = ['name'];

    /**
     * Category と Item のリレーション（一対多）
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
