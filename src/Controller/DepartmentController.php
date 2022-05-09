<?php

namespace App\Controller;

use App\Entity\Department;
use App\Form\DepartmentType;
use App\Repository\DepartmentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/departments")
 */
class DepartmentController extends AbstractController
{
    /**
     * @Route("/", name="app_department_index", methods={"GET"})
     */
    public function index(DepartmentRepository $departmentRepository): Response
    { 

        $currentPage=1;
        if(array_key_exists("currentPage",$_GET)){
            $currentPage=intVal($_GET["currentPage"]);
        }
        $thisPage = $currentPage;
        $limit = 25;
        $paginator= $departmentRepository->getAllDepartments($currentPage,$limit);

       
        $maxPages = ceil($paginator->count() / $limit);

        return $this->render('department/index.html.twig', [
            'departments' => $departmentRepository->findAll(),
            'departments' => $paginator,
            'thisPage' => $thisPage,
            'maxPages' => $maxPages,
            'currentPage' => $currentPage ,
            
        ]);

    }

    /**
     * @Route("/new", name="app_department_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, DepartmentRepository $departmentRepository): Response
    {
        $department = new Department();
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->add($department);
            return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('department/new.html.twig', [
            'department' => $department,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}", name="app_department_show", methods={"GET"})
     */
    public function show(Department $department): Response
    {
        return $this->render('department/show.html.twig', [
            'department' => $department,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_department_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        $form = $this->createForm(DepartmentType::class, $department);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $departmentRepository->add($department);
            return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('department/edit.html.twig', [
            'department' => $department,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_department_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Department $department, DepartmentRepository $departmentRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$department->getId(), $request->request->get('_token'))) {
            $departmentRepository->remove($department);
        }

        return $this->redirectToRoute('app_department_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/Map/{id}", name="app_department_map", methods={"GET"})
     */
    public function searchMapOneDepartment()
    {
        return $this->render('accueil/home.html.twig', [
            'controller_name' => 'DepartmentController',
        ]);
    }
}
