<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthControllerTest extends WebTestCase
{
    public function testHealthzReturnsOk(): void
    {
        $client = static::createClient();
        $client->request('GET', '/healthz');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'application/json');
        $this->assertJsonStringEqualsJsonString('{"status":"ok"}', $client->getResponse()->getContent());
    }

    public function testHealthzIsNotCacheable(): void
    {
        $client = static::createClient();
        $client->request('GET', '/healthz');

        $this->assertStringContainsString('no-store', (string) $client->getResponse()->headers->get('cache-control'));
    }

    public function testHealthzSupportsHead(): void
    {
        $client = static::createClient();
        $client->request('HEAD', '/healthz');

        $this->assertResponseIsSuccessful();
    }

    public function testHealthzRejectsPost(): void
    {
        $client = static::createClient();
        $client->request('POST', '/healthz');

        $this->assertResponseStatusCodeSame(405);
    }
}
