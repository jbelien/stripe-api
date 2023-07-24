<?php

namespace Tests\StripeAPI;

use StripeAPI\Controllers\PingController;
use Tests\TestCase;

final class PingTest extends TestCase
{
    public function testCreateSessionPayment(): void
    {
        $app = $this->getAppInstance();
        $app->get('/ping', PingController::class);

        $request = $this->createRequest('GET', '/ping', []);

        $response = $app->handle($request);

        self::assertEquals(200, $response->getStatusCode());

        /** @var array<string, mixed> $json */
        $json = json_decode((string) $response->getBody(), true, 512, JSON_THROW_ON_ERROR);

        self::assertArrayHasKey('ack', $json);
    }
}
