<?php

namespace StripeAPI;

use Symfony\Component\Dotenv\Dotenv;

final class Configuration
{
    public readonly bool $debug;
    public readonly string $corsAllowOrigin;
    public readonly string $stripeApiKey;
    public readonly ?string $stripeConnectedAccount;
    public readonly ?float $feePercentage;

    public function __construct()
    {
        $dotenv = new Dotenv();
        $dotenv->load(__DIR__.'/.env');

        $this->debug = filter_var($_ENV['APP_DEBUG'], FILTER_VALIDATE_BOOLEAN);

        $this->corsAllowOrigin = $_ENV['CORS_ALLOW_ORIGIN'] ?? '*';

        $this->stripeApiKey = $_ENV['STRIPE_API_KEY'];
        $this->stripeConnectedAccount = $_ENV['STRIPE_CONNECTED_ACCOUNT'] ?? null;
        $this->feePercentage = $_ENV['FEE_PERCENTAGE'] ?? null;
    }
}
