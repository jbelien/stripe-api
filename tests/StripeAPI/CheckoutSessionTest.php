<?php

namespace Tests\StripeAPI;

use Slim\Middleware\BodyParsingMiddleware;
use StripeAPI\Controllers\CheckoutSessionController;
use Tests\TestCase;

final class CheckoutSessionTest extends TestCase
{
    public function testCreateSessionPayment(): void
    {
        $app = $this->getAppInstance();
        $app->post('/checkout/session/{mode:(?:payment|subscription)}', CheckoutSessionController::class)->addMiddleware(new BodyParsingMiddleware());

        $request = $this->createRequest('POST', '/checkout/session/payment', [
            'currency' => 'eur',
            'amount' => 1000,
            'successUrl' => 'https://example.com/success',
            'cancelUrl' => 'https://example.com/cancel',
        ]);

        $response = $app->handle($request);

        self::assertEquals(200, $response->getStatusCode());

        $json = json_decode((string) $response->getBody(), true);

        self::assertArrayHasKey('id', $json);
        self::assertEquals('checkout.session', $json['object']);
        self::assertEquals(1000, $json['amount_total']);
        self::assertEquals('https://example.com/cancel', $json['cancel_url']);
        self::assertEquals('eur', $json['currency']);
        self::assertEquals('payment', $json['mode']);
        self::assertEquals('https://example.com/success', $json['success_url']);
        self::assertIsString($json['url']);
    }

    public function testCreateSessionSubscription(): void
    {
        $app = $this->getAppInstance();
        $app->post('/checkout/session/{mode:(?:payment|subscription)}', CheckoutSessionController::class)->addMiddleware(new BodyParsingMiddleware());

        $request = $this->createRequest('POST', '/checkout/session/subscription', [
            'plan' => 'price_1NX4RVEKdKUBXjXuTlaGwGsk', // Test Plan €1.00 / month
            'successUrl' => 'https://example.com/success',
            'cancelUrl' => 'https://example.com/cancel',
        ]);

        $response = $app->handle($request);

        self::assertEquals(200, $response->getStatusCode());

        $json = json_decode((string) $response->getBody(), true);

        self::assertArrayHasKey('id', $json);
        self::assertEquals('checkout.session', $json['object']);
        self::assertEquals(100, $json['amount_total']);
        self::assertEquals('https://example.com/cancel', $json['cancel_url']);
        self::assertEquals('eur', $json['currency']);
        self::assertEquals('subscription', $json['mode']);
        self::assertEquals('https://example.com/success', $json['success_url']);
        self::assertIsString($json['url']);
    }
}
