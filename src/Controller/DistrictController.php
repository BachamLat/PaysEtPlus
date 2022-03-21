<?php

namespace App\Controller;

use App\Entity\District;
use App\Form\DistrictType;
use App\Repository\DistrictRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/district")
 */
class DistrictController extends AbstractController
{
    /**
     * @Route("/", name="app_district_index", methods={"GET"})
     */
    public function index(DistrictRepository $districtRepository): Response
    {
        return $this->render('district/index.html.twig', [
            'districts' => $districtRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_district_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DistrictRepository $districtRepository): Response
    {
        $district = new District();
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $districtRepository->add($district);
            return $this->redirectToRoute('app_district_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('district/new.html.twig', [
            'district' => $district,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_district_show", methods={"GET"})
     */
    public function show(District $district): Response
    {
        return $this->render('district/show.html.twig', [
            'district' => $district,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_district_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, District $district, DistrictRepository $districtRepository): Response
    {
        $form = $this->createForm(DistrictType::class, $district);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $districtRepository->add($district);
            return $this->redirectToRoute('app_district_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('district/edit.html.twig', [
            'district' => $district,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_district_delete", methods={"POST"})
     */
    public function delete(Request $request, District $district, DistrictRepository $districtRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$district->getId(), $request->request->get('_token'))) {
            $districtRepository->remove($district);
        }

        return $this->redirectToRoute('app_district_index', [], Response::HTTP_SEE_OTHER);
    }
}
