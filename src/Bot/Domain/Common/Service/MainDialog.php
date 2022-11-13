<?php

namespace App\Bot\Domain\Common\Service;

use Jefero\Bot\Main\Domain\Common\Model\Dialog;

class MainDialog extends Dialog
{
    const CODE = 'main';

    public static function getCode(): string
    {
        return self::CODE;
    }
}