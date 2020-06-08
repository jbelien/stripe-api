<?php

namespace Stripe\V1\Rpc\Ping;

use Laminas\ApiTools\ContentNegotiation\ViewModel;
use Laminas\Mvc\Controller\AbstractActionController;

class PingController extends AbstractActionController
{
    public function pingAction()
    {
        return new ViewModel([
            'ack' => time(),
        ]);
    }
}
