<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    protected Api $telegram;
    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }
    public function handle(Request $request)
    {
        $update = $this->telegram->commandsHandler(true);

        $callback = $update->getCallbackQuery();

        if ($callback) {
            $data = $callback->getData();
            $chatId = $callback->getMessage()->getChat()->getId();

            switch ($data) {
                case 'registration':
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Позже здесь будет доступно добавление фио ребенка, возраста, района, после чего в ответ будет отправлена ссылка на родительский чат'
                    ]);
                    break;
                case 'schedule':
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Позже здесь будет доступен просмотр расписания'
                    ]);
                    break;

                case 'support':
                    $this->telegram->sendMessage([
                        'chat_id' => $chatId,
                        'text' => 'Позже здесь будет доступно обращение в поддержку'
                    ]);
                    break;
            }

            $this->telegram->answerCallbackQuery([
                'callback_query_id' => $callback->getId(),
            ]);
        }

        Log::info('webhook info', [
            'update' => $update,
        ]);

    }
}
