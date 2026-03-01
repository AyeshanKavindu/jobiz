<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Job;



final class PageController extends AbstractController
{
   #[Route('/', name: 'app_home')]
public function home(JobRepository $jobRepository): Response
{
    // 3 latest jobs for featured section
    $latestJobs = $jobRepository->findBy([], ['id' => 'DESC'], 3);

    // Total job count
    $jobCount = $jobRepository->count([]);

    return $this->render('page/index.html.twig', [
        'jobs' => $latestJobs, // <-- send only 3 jobs
        'jobCount' => $jobCount,
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