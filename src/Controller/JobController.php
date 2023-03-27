<?php

namespace App\Controller;

use App\Entity\Job;
use App\Repository\JobRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JobController extends AbstractController
{
    #[Route('/job/{id}', name: 'app_job')]
    public function index(Job $job): Response
    {
        return $this->render('job/index.html.twig', [
            'job' => $job,
        ]);
    }
}
