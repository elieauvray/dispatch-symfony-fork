<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Liveness probe.
 *
 * Deliberately dependency-free: it touches no database, cache, filesystem or
 * external service, so it only reports whether this application process can
 * still serve a request. A dependency-aware readiness check would belong on a
 * separate endpoint.
 */
class HealthController extends AbstractController
{
    #[Route('/healthz', name: 'app_healthz', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->json(
            ['status' => 'ok'],
            JsonResponse::HTTP_OK,
            ['Cache-Control' => 'no-store'],
        );
    }
}
