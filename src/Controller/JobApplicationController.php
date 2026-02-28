<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JobApplicationController extends AbstractController
{
    #[Route('/job/application', name: 'app_job_application')]
    public function index(): Response
    {
        return $this->render('job_application/index.html.twig', [
            'controller_name' => 'JobApplicationController',
        ]);
    }
}
