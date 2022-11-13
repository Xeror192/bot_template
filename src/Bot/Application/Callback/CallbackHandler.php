<?php

namespace App\Bot\Application\Callback;

use App\Bot\Domain\Common\Service\MainDialog;
use \Jefero\Bot\Main\Application\Callback\CallbackHandler as BaseCallbackHandler;
use Jefero\Bot\Main\Domain\Common\Service\CustomerRepository;
use Jefero\Bot\Main\Domain\Common\Service\RedisBagService;
use Jefero\Bot\Main\Domain\Telegram\Service\Telegram;
use Jefero\Bot\Main\Domain\VK\Service\VKClient;

class CallbackHandler extends BaseCallbackHandler
{
    public function __construct(
        CustomerRepository $telegramCustomerRepository,
        RedisBagService $redisBagService,
        Telegram $telegram,
        VKClient $VKClient,
        MainDialog $mainDialog
    ) {
        $this->dialogs = [];
        parent::__construct(
            $telegramCustomerRepository,
            $redisBagService,
            $telegram,
            $VKClient,
            $mainDialog
        );
    }
}