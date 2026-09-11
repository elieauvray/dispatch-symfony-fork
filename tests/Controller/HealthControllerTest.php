<?php

namespace App\Tests\Controller;

use App\Controller\HealthController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * The project has no test tooling installed (no symfony/test-pack, so no
 * WebTestCase/browser-kit), so the liveness probe is covered with a plain
 * unit test on the controller's response. The GET-only restriction is
 * enforced by the route attribute and is asserted through reflection.
 */
class HealthControllerTest extends TestCase
{
    public function testHealthzReturnsOkPayload(): void
    {
        $response = (new HealthController())->healthz();

        self::assertSame(Response::HTTP_OK, $response->getStatusCode());
        self::assertSame('application/json', $response->headers->get('Content-Type'));
        self::assertSame('no-store', $response->headers->get('Cache-Control'));
        self::assertSame(['status' => 'ok'], json_decode($response->getContent(), true));
    }

    public function testHealthzIsRestrictedToGet(): void
    {
        $method = new \ReflectionMethod(HealthController::class, 'healthz');
        $attributes = $method->getAttributes(\Symfony\Component\Routing\Attribute\Route::class);

        self::assertCount(1, $attributes);

        $route = $attributes[0]->newInstance();

        self::assertSame('/healthz', $route->getPath());
        self::assertSame('app_healthz', $route->getName());
        self::assertSame(['GET'], $route->getMethods());
    }
}
