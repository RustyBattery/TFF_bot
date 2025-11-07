<?php

namespace App\Telegram\Services;

use App\Models\Telegram\User;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update;

class UserService
{
    public function findUserByChatId($chatId): User
    {
        $user = User::where('chat_id', $chatId)->first();
        return $user;
    }

    public function createOrUpdateUser(Update $update): User
    {
        $chatId = $update->getMessage()->getChat()->getId();
        $username = $update->getMessage()->getChat()->getUsername();
        $user = User::updateOrCreate(
            ['chat_id' => $chatId],
            ['username' => $username]
        );
        return $user;
    }
}
