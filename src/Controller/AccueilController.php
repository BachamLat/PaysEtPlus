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
     * @Route("/accueil", name="app_accueil")
     */
    public function index(): Response
    {
        // $package = new EmptyVersionStrategy();
        // $package = new Package(new StaticVersionStrategy('v1'));

        // $path = $package->getUrl('assets/json/CountryCode.json');
        // $pathOne =  $package->getUrl('assets/json/BeninTerritorial.json') ;

        // $data = file_get_contents($path);
        // $dataOne = file_get_contents($pathOne);

        // $jsonData = json_decode($path,1);
        // $jsonDataOne = json_decode($pathOne,1);

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            
        ]);
    }
}
