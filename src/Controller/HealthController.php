<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthController extends AbstractController
{
    /**
     * Liveness probe: no database, cache or outbound calls, so it only
     * reports that the PHP process is alive and able to serve a request.
     */
    #[Route('/healthz', name: 'app_healthz', methods: ['GET'])]
    public function healthz(): JsonResponse
    {
        $response = new JsonResponse(['status' => 'ok']);
        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
