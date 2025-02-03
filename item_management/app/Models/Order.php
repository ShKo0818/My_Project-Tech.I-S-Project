<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // このモデルが関連するテーブルを指定
    protected $table = 'orders';

    // 複数代入可能な属性を指定
    protected $fillable = [
        'name',
        'quantity',
        'category',
        'detail',
        'company_name',
        'delivery_date',
        'image',
    ];

    // リレーションを定義する（例えば、Item モデルとのリレーション）
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
