<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Job;



final class PageController extends AbstractController
{
    // HOMEPAGE: show only 3 latest jobs
    #[Route('/', name: 'app_home')]
    public function home(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findBy([], ['id' => 'DESC'], 3);

        return $this->render('page/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    // ALL JOBS PAGE: show all jobs
    #[Route('/all-jobs', name: 'app_all_jobs')]
    public function allJobs(JobRepository $jobRepository): Response
    {
        $jobs = $jobRepository->findAll();

        return $this->render('page/jobs.html.twig', [
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

    #[Route('/job/{id}/apply', name: 'app_jobapplication')]
    public function jobApplication(Job $job): Response
    {
    return $this->render('page/jobApply.html.twig', [
        'job' => $job
    ]);
    }

}