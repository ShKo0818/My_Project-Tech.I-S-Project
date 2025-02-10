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
        // マスター会員ならすべてのアイテムを更新可能
        if ($user->user_type === 'master') {
            return true;
        }

        // 通常のユーザーは自身が所有するアイテムのみ更新可能
        return $user->id === $item->user_id;
    }
}
