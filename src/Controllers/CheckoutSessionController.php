<?php

namespace StripeAPI\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Stripe\StripeClient;
use StripeAPI\Configuration;
use StripeAPI\Services\StripeService;

class CheckoutSessionController
{
    private readonly Configuration $config;
    private readonly StripeClient $client;

    public function __construct(Configuration $config, StripeService $stripeService)
    {
        $this->config = $config;
        $this->client = $stripeService->client;
    }

    /**
     * @param array{mode:"payment"|"subscription"} $args
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        /** @var array<string, mixed> $data */
        $data = $request->getParsedBody();

        list($params, $options) = match ($args['mode']) {
            'payment' => $this->payment($data),
            'subscription' => $this->subscription($data),
        };

        $session = $this->client->checkout->sessions->create($params, $options);

        /** @var string $json */
        $json = json_encode($session, JSON_THROW_ON_ERROR);

        $response->getBody()->write($json);

        return $response
            ->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param array{locale:string|null, successUrl:string|null, cancelUrl:string|null, currency:string|null, amount:int|null, message:string|null} $data
     *
     * @return array{0:array<string, mixed>, 1:array<string, mixed>}
     */
    private function payment(array $data): array
    {
        $params = [
            'mode' => 'payment',
            'submit_type' => 'donate',
            'locale' => $data['locale'] ?? 'auto',
            'success_url' => $data['successUrl'],
            'cancel_url' => $data['cancelUrl'],
            'payment_method_types' => ['card', 'bancontact'],
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => $data['currency'],
                        'unit_amount' => $data['amount'],
                        'product_data' => [
                            'name' => 'Single donation',
                        ],
                    ],
                ],
            ],
            'payment_intent_data' => [
                'description' => $data['message'] ?? null,
            ],
        ];

        $options = [];
        if (!is_null($this->config->stripeConnectedAccount)) {
            $options['stripe_account'] = $this->config->stripeConnectedAccount;

            if (!is_null($data['amount']) && !is_null($this->config->feePercentage) && $this->config->feePercentage > 0) {
                $params['payment_intent_data']['application_fee_amount'] = $data['amount'] * $this->config->feePercentage;
            }
        }

        return [$params, $options];
    }

    /**
     * @param array{locale:string|null, successUrl:string|null, cancelUrl:string|null, plan:string|null} $data
     *
     * @return array{0:array<string, mixed>, 1:array<string, mixed>}
     */
    private function subscription(array $data): array
    {
        $params = [
            'mode' => 'subscription',
            'locale' => $data['locale'] ?? 'auto',
            'success_url' => $data['successUrl'] ?? null,
            'cancel_url' => $data['cancelUrl'] ?? null,
            'payment_method_types' => ['card'],
            'subscription_data' => [
                'items' => [['plan' => $data['plan'] ?? null]],
            ],
        ];

        $options = [];
        if (!is_null($this->config->stripeConnectedAccount)) {
            $options['stripe_account'] = $this->config->stripeConnectedAccount;

            if (!is_null($this->config->feePercentage) && $this->config->feePercentage > 0) {
                $params = array_merge_recursive($params, [
                    'subscription_data' => [
                        'application_fee_percent' => $this->config->feePercentage * 100,
                    ],
                ]);
            }
        }

        return [$params, $options];
    }
}
