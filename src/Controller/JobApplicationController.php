<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\JobApplication;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class JobApplicationController extends AbstractController
{
    #[Route('/job/{id}/apply', name: 'app_job_application', requirements: ['id' => '\d+'])]
    public function index(Request $request, Job $job, EntityManagerInterface $em): Response
    {
        // Ensure user is logged in
        $user = $this->getUser();
        if (!$user) {
            $this->addFlash('danger', 'You must be logged in to apply.');
            return $this->redirectToRoute('app_login');
        }

        if ($request->isMethod('POST')) {
            // Get form data
            $coverLetter = $request->request->get('message');

            // Handle resume upload
            $resumeFile = $request->files->get('resume');
            $resumeFilename = null;
            if ($resumeFile) {
                $resumeFilename = uniqid() . '-' . $resumeFile->getClientOriginalName();
                $resumeFile->move($this->getParameter('resume_directory'), $resumeFilename);
            }

            // Save application to DB
            $jobApplication = new JobApplication();
            $jobApplication->setJob($job);
            $jobApplication->setUser($user);
            $jobApplication->setCoverLetter($coverLetter);
            $jobApplication->setCreatedAt(new \DateTime());
            $jobApplication->setResume($resumeFilename);

            $em->persist($jobApplication);
            $em->flush();

            // Success flash message and reload same page
            $this->addFlash('success', 'Your application has been submitted successfully!');
            return $this->redirectToRoute('app_job_application', ['id' => $job->getId()]);
        }

        return $this->render('page/jobApply.html.twig', [
            'job' => $job,
        ]);
    }
}