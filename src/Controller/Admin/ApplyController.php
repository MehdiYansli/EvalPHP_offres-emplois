<?php

namespace App\Controller\Admin;

use App\Entity\Apply;
use App\Form\Apply1Type;
use App\Repository\ApplyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/apply')]
class ApplyController extends AbstractController
{
    #[Route('/', name: 'app_admin_apply_index', methods: ['GET'])]
    public function index(ApplyRepository $applyRepository): Response
    {
        return $this->render('admin/apply/index.html.twig', [
            'applies' => $applyRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_apply_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ApplyRepository $applyRepository): Response
    {
        $apply = new Apply();
        $form = $this->createForm(Apply1Type::class, $apply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $applyRepository->save($apply, true);

            return $this->redirectToRoute('app_admin_apply_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/apply/new.html.twig', [
            'apply' => $apply,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_apply_show', methods: ['GET'])]
    public function show(Apply $apply): Response
    {
        return $this->render('admin/apply/show.html.twig', [
            'apply' => $apply,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_apply_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Apply $apply, ApplyRepository $applyRepository): Response
    {
        $form = $this->createForm(Apply1Type::class, $apply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $applyRepository->save($apply, true);

            return $this->redirectToRoute('app_admin_apply_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/apply/edit.html.twig', [
            'apply' => $apply,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_apply_delete', methods: ['POST'])]
    public function delete(Request $request, Apply $apply, ApplyRepository $applyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$apply->getId(), $request->request->get('_token'))) {
            $applyRepository->remove($apply, true);
        }

        return $this->redirectToRoute('app_admin_apply_index', [], Response::HTTP_SEE_OTHER);
    }
}
