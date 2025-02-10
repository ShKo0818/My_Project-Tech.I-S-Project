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
    // マスター会員または法人会員の場合は全ての更新を許可する
    if (in_array($user->user_type, ['master', 'corporate'])) {
        return true;
    }

    // 通常のユーザーは、アイテムの所有者であれば更新できる
    return $user->id === $item->user_id;
}

}
