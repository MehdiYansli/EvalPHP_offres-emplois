<?php

namespace App\Controller;

use App\Entity\Job;
use App\Entity\Apply;
use App\Form\ApplyType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class JobController extends AbstractController
{
    #[Route('/job/{id}', name: 'app_job')]
    public function index(Job $job, Request $request, EntityManagerInterface $entityManager): Response
    {
        $apply = new Apply();
        $form = $this->createForm(ApplyType::class, $apply);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $apply->setSendAt(new \DateTimeImmutable('now'));
            $apply->setJobId($job);
            $entityManager->persist($apply);
            $entityManager->flush();

            return $this->redirectToRoute('app_job', ['id' => $job->getId()]);
        }

        return $this->render('job/index.html.twig', [
            'job' => $job,
            'form' => $form,

        ]);
    }
}
