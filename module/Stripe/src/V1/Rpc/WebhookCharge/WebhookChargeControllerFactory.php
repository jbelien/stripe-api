<?php

namespace Stripe\V1\Rpc\WebhookCharge;

use Psr\Container\ContainerInterface;

class WebhookChargeControllerFactory
{
    public function __invoke(ContainerInterface $controllers)
    {
        $config = $controllers->get('config');

        return new WebhookChargeController(
            $config['secretKey'] ?? null,
            $config['connectAccount'] ?? null,
            $config['fee'] ?? 0
        );
    }
}
