<?php

namespace App\Telegram\States;

use App\Telegram\Services\UserService;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

abstract class State
{
    protected Api $telegram;
    protected UserService $userService;
    protected $name = '';
    protected Update $update;
    protected $chatId = '';

    public function __construct(Api $telegram, UserService $userService)
    {
        $this->telegram = $telegram;
        $this->userService = $userService;
    }

    public function setContext($update)
    {
        $this->update = $update;
        $this->chatId = $update->getMessage()->getChat()->getId() ?? '';
        return $this;
    }

    abstract public function handle();

    public function getName(): string
    {
        return $this->name;
    }

    public function replyWithMessage($params)
    {
        $this->telegram->sendMessage(array_merge(['chat_id' => $this->chatId], $params));
    }
}
