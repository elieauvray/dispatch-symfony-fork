<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthzControllerTest extends WebTestCase
{
    public function testHealthzIsNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/healthz');

        $this->assertResponseStatusCodeSame(404);
    }
}
