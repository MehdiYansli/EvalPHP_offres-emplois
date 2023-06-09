<?php

namespace App\Controller;

use App\Form\JobSortType;
use App\Repository\JobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]

    public function index(JobRepository $jobRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $formSort = $this->createForm(JobSortType::class);

        if($formSort->handleRequest($request)->isSubmitted() && $formSort->isValid()){
            $criteria = $formSort->getData();
        }
            
            $pagination = $paginator->paginate(
                // $jobRepository->findBy([], ['sendAt' => 'DESC']),
                $jobRepository->search($criteria ?? []),
                
                // $jobRepository->findAll(), /* query NOT result */
                $request->query->getInt('page', 1), /*page number*/
                15 /*limit per page*/
            );

        return $this->render('home/index.html.twig', [
            'jobs' => $pagination,
            'formSort' => $formSort->createView(),
        ]);
    }
}
