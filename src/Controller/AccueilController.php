<?php

namespace App\Controller;

use Symfony\Component\Asset\Package;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="app_accueil")
     */
    public function index(): Response
    { 
        // $this->denyAccessUnlessGranted('ROLE_USER');
        // or use in  the route to add 
        /*
            @IsGranted("ROLE_USER") 
         */

        return $this->render('accueil/home.html.twig', [
            'controller_name' => 'AccueilController',
            
        ]);
    }    
}
