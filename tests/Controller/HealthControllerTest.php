<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthControllerTest extends WebTestCase
{
    public function testHealthzReturnsOk(): void
    {
        $client = static::createClient();
        $client->request('GET', '/healthz');

        $response = $client->getResponse();

        self::assertResponseIsSuccessful();
        self::assertSame(200, $response->getStatusCode());
        self::assertStringStartsWith('application/json', (string) $response->headers->get('Content-Type'));
        self::assertSame('{"status":"ok"}', $response->getContent());
        self::assertSame(['status' => 'ok'], json_decode((string) $response->getContent(), true));
    }

    public function testHealthzRejectsNonGetMethods(): void
    {
        $client = static::createClient();
        $client->request('POST', '/healthz');

        self::assertSame(405, $client->getResponse()->getStatusCode());
    }
}
