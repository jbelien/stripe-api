<?php

namespace Stripe\V1\Rpc\Ping;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ApiTools\ContentNegotiation\ViewModel;

class PingController extends AbstractActionController
{
    public function pingAction()
    {
        return new ViewModel([
            'ack' => time(),
        ]);
    }
}
