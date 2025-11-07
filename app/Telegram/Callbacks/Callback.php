<?php

namespace App\Telegram\Callbacks;

use App\Telegram\Services\UserService;
use Telegram\Bot\Api;

abstract class Callback
{
    protected Api $telegram;
    protected UserService $userService;
    protected $name = '';
    protected $pattern = '';
    protected $update;
    protected $callback;
    protected $chatId = '';

    public function __construct(Api $telegram, UserService $userService)
    {
        $this->telegram = $telegram;
        $this->userService = $userService;
    }

    public function setContext($update, $callback)
    {
        $this->update = $update;
        $this->callback = $callback;
        $this->chatId = $callback->getMessage()->getChat()->getId() ?? '';
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

    public function match(string $data): bool
    {
        if ($this->name && $this->name === $data) {
            return true;
        }

        if ($this->pattern && preg_match("/^{$this->pattern}$/", $data)) {
            return true;
        }

        return false;
    }
}
