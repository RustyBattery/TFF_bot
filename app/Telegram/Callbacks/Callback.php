<?php

namespace App\Telegram\Callbacks;

use Telegram\Bot\Api;

abstract class Callback
{
    protected Api $telegram;
    protected $name = '';
    protected $update;
    protected $callback;
    protected $chatId = '';

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
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
}
