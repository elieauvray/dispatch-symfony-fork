<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HealthzController extends AbstractController
{
    #[Route('/healthz', name: 'app_healthz', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $response = $this->json([
            'status' => 'ok',
        ]);

        $response->headers->set('Cache-Control', 'no-store');

        return $response;
    }
}
