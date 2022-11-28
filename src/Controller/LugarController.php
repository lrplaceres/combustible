<?php

namespace App\Controller;

use App\Entity\Lugar;
use App\Form\LugarType;
use App\Repository\LugarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/lugar')]
class LugarController extends AbstractController
{
    #[Route('/', name: 'app_lugar_index', methods: ['GET'])]
    public function index(LugarRepository $lugarRepository): Response
    {
        return $this->render('lugar/index.html.twig', [
            'lugars' => $lugarRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lugar_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LugarRepository $lugarRepository): Response
    {
        $lugar = new Lugar();
        $form = $this->createForm(LugarType::class, $lugar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lugarRepository->save($lugar, true);

            return $this->redirectToRoute('app_lugar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lugar/new.html.twig', [
            'lugar' => $lugar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lugar_show', methods: ['GET'])]
    public function show(Lugar $lugar): Response
    {
        return $this->render('lugar/show.html.twig', [
            'lugar' => $lugar,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lugar_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lugar $lugar, LugarRepository $lugarRepository): Response
    {
        $form = $this->createForm(LugarType::class, $lugar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lugarRepository->save($lugar, true);

            return $this->redirectToRoute('app_lugar_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lugar/edit.html.twig', [
            'lugar' => $lugar,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lugar_delete', methods: ['POST'])]
    public function delete(Request $request, Lugar $lugar, LugarRepository $lugarRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lugar->getId(), $request->request->get('_token'))) {
            $lugarRepository->remove($lugar, true);
        }

        return $this->redirectToRoute('app_lugar_index', [], Response::HTTP_SEE_OTHER);
    }
}
