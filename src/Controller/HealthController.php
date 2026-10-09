<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Liveness probe: only reports that the app can serve requests.
 * It intentionally performs no database or external-service checks.
 */
class HealthController
{
    #[Route('/healthz', name: 'healthz', methods: ['GET', 'HEAD'])]
    public function __invoke(): JsonResponse
    {
        $response = new JsonResponse(['status' => 'ok']);
        $response->headers->set('Cache-Control', 'no-store, private');
        $response->headers->set('X-Robots-Tag', 'noindex');

        return $response;
    }
}
