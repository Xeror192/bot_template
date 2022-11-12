<?php

namespace App\Bot\UI\Http\Controller;

use App\Bot\Application\Callback\CallbackHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Jefero\Bot\Main\UI\Http\Controller\VKCallbackController as BaseVKCallbackController;

class VKCallbackController extends BaseVKCallbackController
{
    public function __construct(CallbackHandler $handler)
    {
        parent::__construct($handler);
    }

    /**
     * @Route("/vk/callback", name = "bot_vk_callback", methods = {"GET", "POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request): Response
    {
        return $this->invoke($request);
    }
}
