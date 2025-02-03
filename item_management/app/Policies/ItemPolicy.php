<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Item;

class ItemPolicy
{
    /**
     * アイテム更新の権限を確認
     */
    public function update(User $user, Item $item)
    {
        // マスターユーザーの場合はすべて更新できる
        if ($user->is_master) {
            return true;
        }

        // 通常のユーザーはアイテムの所有者であれば更新できる
        return $user->id === $item->user_id;
    }
}
