<?php

namespace App\Bot\Application\Callback;

use App\Bot\Domain\Common\Service\BookingDialog;
use App\Bot\Domain\Common\Service\ExampleDialog;
use App\Bot\Domain\Common\Service\LocationDialog;
use App\Bot\Domain\Common\Service\MainDialog;
use App\Bot\Domain\Common\Service\PriceDialog;
use App\Bot\Domain\Common\Service\RegistrationDialog;
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
        MainDialog $mainDialog,
        BookingDialog $bookingDialog,
        LocationDialog $locationDialog,
        ExampleDialog $exampleDialog,
        PriceDialog $priceDialog,
        RegistrationDialog $registrationDialog
    ) {
        $this->dialogs = [
            BookingDialog::getCode() => $bookingDialog->setCallbackHandler($this),
            LocationDialog::getCode() => $locationDialog->setCallbackHandler($this),
            ExampleDialog::getCode() => $exampleDialog->setCallbackHandler($this),
            PriceDialog::getCode() => $priceDialog->setCallbackHandler($this),
            RegistrationDialog::getCode() => $registrationDialog->setCallbackHandler($this),
        ];
        parent::__construct(
            $telegramCustomerRepository,
            $redisBagService,
            $telegram,
            $VKClient,
            $mainDialog
        );
    }
}