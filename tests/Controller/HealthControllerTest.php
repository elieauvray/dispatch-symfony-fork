<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthControllerTest extends WebTestCase
{
    public function testHealthzIsRemoved(): void
    {
        $client = static::createClient();
        $client->request('GET', '/healthz');

        $this->assertResponseStatusCodeSame(404);
    }
}
