<?php

namespace App\Bot\UI\Http\Controller;

use App\Bot\Application\Callback\CallbackHandler;
use Jefero\Bot\Common\Infrastructure\Persistence\RedisRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \Jefero\Bot\Main\UI\Http\Controller\TelegramCallbackController as BaseTelegramCallbackController;

class TelegramCallbackController extends BaseTelegramCallbackController
{
    private RedisRepository $redisRepository;

    public function __construct(CallbackHandler $handler, string $telegramChatId, RedisRepository $redisRepository)
    {
        $this->redisRepository = $redisRepository;
        parent::__construct($handler, $telegramChatId);
    }

    /**
     * @Route("/telegram/callback", name = "bot_telegram_callback", methods = {"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->invoke($request);
    }
}
