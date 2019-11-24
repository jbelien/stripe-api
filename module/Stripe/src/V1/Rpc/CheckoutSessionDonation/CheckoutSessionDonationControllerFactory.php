<?php

namespace Stripe\V1\Rpc\CheckoutSessionDonation;

use Psr\Container\ContainerInterface;

class CheckoutSessionDonationControllerFactory
{
    public function __invoke(ContainerInterface $controllers)
    {
        $config = $controllers->get('config');

        return new CheckoutSessionDonationController(
            $config['secretKey'] ?? null,
            $config['connectAccount'] ?? null,
            $config['fee'] ?? 0
        );
    }
}
