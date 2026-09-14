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
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $this->assertJsonStringEqualsJsonString(
            '{"status":"ok"}',
            $client->getResponse()->getContent()
        );
    }

    public function testHealthzRejectsPost(): void
    {
        $client = static::createClient();
        $client->request('POST', '/healthz');

        $this->assertResponseStatusCodeSame(405);
    }
}
