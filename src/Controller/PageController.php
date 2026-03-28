<?php

namespace App\Controller;

use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Job;
use Symfony\Component\HttpFoundation\Request;



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



#[Route('/jobs', name: 'app_jobs')]
public function jobs(Request $request, JobRepository $jobRepository): Response
{
    $query    = $request->query->get('q');
    $category = $request->query->get('category');
    $country  = $request->query->get('country');
    $salaryMin = $request->query->get('salary_min');
    $salaryMax = $request->query->get('salary_max');
    $page     = max(1, (int) $request->query->get('page', 1));
    $limit    = 10;
    $offset   = ($page - 1) * $limit;

    $qb = $jobRepository->createQueryBuilder('j')
        ->leftJoin('j.company', 'c')
        ->leftJoin('j.category', 'cat');

    // Keyword search
    if ($query) {
        $qb->andWhere('j.title LIKE :keyword OR c.name LIKE :keyword OR j.city LIKE :keyword OR j.country LIKE :keyword')
           ->setParameter('keyword', '%' . $query . '%');

        $lowerQuery = strtolower($query);
        if ($lowerQuery === 'remote') {
            $qb->orWhere('j.remoteAllowed = 1');
        } elseif ($lowerQuery === 'onsite') {
            $qb->orWhere('j.remoteAllowed = 0');
        }
    }

    // Category filter
    if ($category) {
        $qb->andWhere('cat.id = :category')
           ->setParameter('category', $category);
    }

    // Country filter
    if ($country) {
        $qb->andWhere('j.country = :country')
           ->setParameter('country', $country);
    }

    // Salary filter
    if ($salaryMin) {
        $qb->andWhere('j.salaryMin >= :salaryMin')
           ->setParameter('salaryMin', $salaryMin);
    }
    if ($salaryMax) {
        $qb->andWhere('j.salaryMax <= :salaryMax')
           ->setParameter('salaryMax', $salaryMax);
    }

    // Total for pagination
    $totalQb = clone $qb;
    $total = count($totalQb->getQuery()->getResult());
    $totalPages = (int) ceil($total / $limit);

    // Apply pagination
    $jobs = $qb->setFirstResult($offset)
               ->setMaxResults($limit)
               ->getQuery()
               ->getResult();

    // Get distinct countries for filter dropdown
    $countries = $jobRepository->createQueryBuilder('j')
        ->select('DISTINCT j.country')
        ->orderBy('j.country', 'ASC')
        ->getQuery()
        ->getResult();

    // Get all categories
    $categories = $jobRepository->createQueryBuilder('j')
        ->select('DISTINCT cat.id, cat.name')
        ->leftJoin('j.category', 'cat')
        ->where('cat.id IS NOT NULL')
        ->orderBy('cat.name', 'ASC')
        ->getQuery()
        ->getResult();

    return $this->render('page/jobs.html.twig', [
        'jobs'       => $jobs,
        'query'      => $query,
        'category'   => $category,
        'country'    => $country,
        'salaryMin'  => $salaryMin,
        'salaryMax'  => $salaryMax,
        'countries'  => array_column($countries, 'country'),
        'categories' => $categories,
        'currentPage'=> $page,
        'totalPages' => $totalPages,
        'total'      => $total,
    ]);
}
    
    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('page/about.html.twig');   
    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('page/contact.html.twig');
    }



}