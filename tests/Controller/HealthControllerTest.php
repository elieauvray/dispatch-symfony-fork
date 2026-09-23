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
        $this->assertSame(
            ['status' => 'ok'],
            json_decode($client->getResponse()->getContent(), true)
        );
    }

    public function testHealthzRejectsPost(): void
    {
        $client = static::createClient();
        $client->request('POST', '/healthz');

        $this->assertResponseStatusCodeSame(405);
    }
}
