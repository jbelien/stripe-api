<?php

namespace Stripe\V1\Rpc\SourceBancontact;

use Psr\Container\ContainerInterface;

class SourceBancontactControllerFactory
{
    public function __invoke(ContainerInterface $controllers)
    {
        $config = $controllers->get('config');

        return new SourceBancontactController(
            $config['secretKey'] ?? null,
            $config['connectAccount'] ?? null,
            $config['fee'] ?? 0
        );
    }
}
