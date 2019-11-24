<?php

namespace Stripe\V1\Rpc\CheckoutSessionPlan;

use Psr\Container\ContainerInterface;

class CheckoutSessionPlanControllerFactory
{
    public function __invoke(ContainerInterface $controllers)
    {
        $config = $controllers->get('config');

        return new CheckoutSessionPlanController(
            $config['secretKey'] ?? null,
            $config['connectAccount'] ?? null,
            $config['fee'] ?? 0
        );
    }
}
