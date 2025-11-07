<?php

namespace App\Telegram\Services;

use App\Models\Telegram\User;
use App\Models\Telegram\UserState;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Objects\Update;

class UserService
{
    public function findUserByChatId($chatId): User
    {
        $user = User::where('chat_id', $chatId)->first();
        return $user;
    }

    public function findUserByUpdate(Update $update): User
    {
        $chatId = $update->getMessage()->getChat()->getId();
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

    public function resetState(User $user): void
    {
        UserState::updateOrCreate(
            ['user_id' => $user->id],
            ['state' => 'default']
        );
    }

    public function setState(User $user, string $state): void
    {
        UserState::updateOrCreate(
            ['user_id' => $user->id],
            ['state' => $state]
        );
    }
}
