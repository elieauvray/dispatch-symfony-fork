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

        $this->assertSame(200, $response->getStatusCode());
        $this->assertStringContainsString('application/json', (string) $response->headers->get('Content-Type'));
        $this->assertSame('no-store', $response->headers->get('Cache-Control'));
        $this->assertSame(['status' => 'ok'], json_decode((string) $response->getContent(), true));
    }

    public function testHealthzRejectsOtherMethods(): void
    {
        $client = static::createClient();
        $client->request('POST', '/healthz');

        $this->assertSame(405, $client->getResponse()->getStatusCode());
    }
}
