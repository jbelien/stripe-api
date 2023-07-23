<?php

namespace StripeAPI\Services;

use Stripe\StripeClient;
use StripeAPI\Configuration;

class StripeService
{
    public const VERSION = '2022-11-15';

    public readonly StripeClient $client;

    public function __construct(Configuration $config)
    {
        $this->client = new StripeClient([
            'api_key'        => $config->stripeApiKey,
            'stripe_version' => self::VERSION,
        ]);
    }
}
