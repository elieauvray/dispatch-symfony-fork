<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Liveness probe.
 *
 * This endpoint is intentionally dependency-free: it never touches the
 * database, cache, session or any external service. It answers 200 as long as
 * the PHP process can serve requests, so a dependency outage does not turn
 * into a restart loop. Readiness checks belong in a separate endpoint.
 */
class HealthController extends AbstractController
{
    #[Route('/healthz', name: 'healthz', methods: ['GET', 'HEAD'])]
    public function healthz(): JsonResponse
    {
        $response = $this->json([
            'status' => 'ok',
        ]);

        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
