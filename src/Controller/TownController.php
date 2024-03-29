<?php

namespace App\Controller;

use App\Entity\Town;
use App\Form\TownType;
use App\Repository\TownRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/towns")
 */
class TownController extends AbstractController
{
    /**
     * @Route("/", name="app_town_index", methods={"GET"})
     */
    public function index(TownRepository $townRepository): Response
    {

        $currentPage=1;
        if(array_key_exists("currentPage",$_GET)){
            $currentPage=intVal($_GET["currentPage"]);
        }
        $thisPage = $currentPage;
        $limit = 180;
        $paginator= $townRepository->getAllTowns($currentPage,$limit);
       
        $maxPages = ceil($paginator->count() / $limit);

        return $this->render('town/index.html.twig', [
            'towns' => $townRepository->findAll(),
            'towns' => $paginator,
            'thisPage' => $thisPage,
            'maxPages' => $maxPages,
            'currentPage' => $currentPage ,
            
        ]);
      
    }

    /**
     * @Route("/new", name="app_town_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
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
     * @IsGranted("ROLE_USER")
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Town $town, TownRepository $townRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$town->getId(), $request->request->get('_token'))) {
            $townRepository->remove($town);
        }

        return $this->redirectToRoute('app_town_index', [], Response::HTTP_SEE_OTHER);
    }
}
