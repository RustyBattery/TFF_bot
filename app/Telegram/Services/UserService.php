<?php

namespace App\Telegram\Services;

use App\Models\Telegram\User;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update;

class UserService
{
    public function findOrCreateUser($chatId): User
    {
        $user = User::query()->where('chat_id', $chatId)->first();
        if (!$user) {
            $user = User::query()->create([
                'username' => '', // как-то достать надо
                'chat_id' => $chatId
            ]);
        }
        return $user;
    }

    public function createOrUpdateUser(Update $update)
    {
        $chatId = $update->getMessage()->getChat()->getId();
        $username = $update->getMessage()->getChat()->getUsername();
        Log::debug('createOrUpdateUser', ['chatId' => $chatId, 'username' => $username]);
    }
}
