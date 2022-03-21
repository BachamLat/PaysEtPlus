<?php

namespace App\Controller;

use App\Entity\Town;
use App\Form\TownType;
use App\Repository\TownRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/town")
 */
class TownController extends AbstractController
{
    /**
     * @Route("/", name="app_town_index", methods={"GET"})
     */
    public function index(TownRepository $townRepository): Response
    {
        return $this->render('town/index.html.twig', [
            'towns' => $townRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_town_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TownRepository $townRepository): Response
    {
        $town = new Town();
        $form = $this->createForm(TownType::class, $town);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $townRepository->add($town);
            return $this->redirectToRoute('app_town_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('town/new.html.twig', [
            'town' => $town,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_town_show", methods={"GET"})
     */
    public function show(Town $town): Response
    {
        return $this->render('town/show.html.twig', [
            'town' => $town,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_town_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Town $town, TownRepository $townRepository): Response
    {
        $form = $this->createForm(TownType::class, $town);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $townRepository->add($town);
            return $this->redirectToRoute('app_town_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('town/edit.html.twig', [
            'town' => $town,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_town_delete", methods={"POST"})
     */
    public function delete(Request $request, Town $town, TownRepository $townRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$town->getId(), $request->request->get('_token'))) {
            $townRepository->remove($town);
        }

        return $this->redirectToRoute('app_town_index', [], Response::HTTP_SEE_OTHER);
    }
}
