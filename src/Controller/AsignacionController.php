<?php

namespace App\Controller;

use App\Entity\Asignacion;
use App\Form\AsignacionType;
use App\Repository\AsignacionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/asignacion')]
class AsignacionController extends AbstractController
{
    #[Route('/', name: 'app_asignacion_index', methods: ['GET'])]
    public function index(AsignacionRepository $asignacionRepository): Response
    {
        return $this->render('asignacion/index.html.twig', [
            'asignacions' => $asignacionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_asignacion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AsignacionRepository $asignacionRepository): Response
    {
        $asignacion = new Asignacion();
        $form = $this->createForm(AsignacionType::class, $asignacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $asignacionRepository->save($asignacion, true);

            return $this->redirectToRoute('app_asignacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('asignacion/new.html.twig', [
            'asignacion' => $asignacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asignacion_show', methods: ['GET'])]
    public function show(Asignacion $asignacion): Response
    {
        return $this->render('asignacion/show.html.twig', [
            'asignacion' => $asignacion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_asignacion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Asignacion $asignacion, AsignacionRepository $asignacionRepository): Response
    {
        $form = $this->createForm(AsignacionType::class, $asignacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $asignacionRepository->save($asignacion, true);

            return $this->redirectToRoute('app_asignacion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('asignacion/edit.html.twig', [
            'asignacion' => $asignacion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_asignacion_delete', methods: ['POST'])]
    public function delete(Request $request, Asignacion $asignacion, AsignacionRepository $asignacionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$asignacion->getId(), $request->request->get('_token'))) {
            $asignacionRepository->remove($asignacion, true);
        }

        return $this->redirectToRoute('app_asignacion_index', [], Response::HTTP_SEE_OTHER);
    }
}
