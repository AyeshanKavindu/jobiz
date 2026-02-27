<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PageController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findAll();
        return $this->render('page/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('page/about.html.twig');   
    }

    #[Route('/jobs', name: 'app_jobs')]
    public function jobs(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findAll();
        return $this->render('page/jobs.html.twig', [
            'jobs' => $jobs,
        ]); 
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig');
    }

}
class HomeController extends AbstractController
{
    public function index(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findLatestJobs(3); // fetch only 3 latest jobs

        return $this->render('home/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }
}