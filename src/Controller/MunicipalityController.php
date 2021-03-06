<?php

namespace App\Controller;

use App\Entity\Municipality;
use App\Form\MunicipalityType;
use App\Repository\MunicipalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/municipality")
 */
class MunicipalityController extends AbstractController
{
    /**
     * @Route("/", name="app_municipality_index", methods={"GET"})
     */
    public function index(MunicipalityRepository $municipalityRepository): Response
    {
        return $this->render('municipality/index.html.twig', [
            'municipalities' => $municipalityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_municipality_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MunicipalityRepository $municipalityRepository): Response
    {
        $municipality = new Municipality();
        $form = $this->createForm(MunicipalityType::class, $municipality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $municipalityRepository->add($municipality);
            return $this->redirectToRoute('app_municipality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('municipality/new.html.twig', [
            'municipality' => $municipality,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_municipality_show", methods={"GET"})
     */
    public function show(Municipality $municipality): Response
    {
        return $this->render('municipality/show.html.twig', [
            'municipality' => $municipality,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_municipality_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Municipality $municipality, MunicipalityRepository $municipalityRepository): Response
    {
        $form = $this->createForm(MunicipalityType::class, $municipality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $municipalityRepository->add($municipality);
            return $this->redirectToRoute('app_municipality_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('municipality/edit.html.twig', [
            'municipality' => $municipality,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_municipality_delete", methods={"POST"})
     */
    public function delete(Request $request, Municipality $municipality, MunicipalityRepository $municipalityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$municipality->getId(), $request->request->get('_token'))) {
            $municipalityRepository->remove($municipality);
        }

        return $this->redirectToRoute('app_municipality_index', [], Response::HTTP_SEE_OTHER);
    }
}
