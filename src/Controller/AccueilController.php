<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Asset\Package;
use Symfony\Component\Mailer\MailerInterface;
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
    public function index( MailerInterface $mailerInterface): Response
    { 
        // $this->denyAccessUnlessGranted('ROLE_USER');
        // or use in  the route to add 
        /*
            @IsGranted("ROLE_USER") 
         */

        $email = ( new Email() )
            ->from('iotcrewmanager@gmail.com')
            ->from(new Address('fabien@example.com', 'Fabien'))
            ->to('amirbabio40@gmail.com')
            ->cc('cc@example.com')
            ->bcc('bcc@example.com')
            ->replyTo('fabien@example.com')
            ->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('See Twig integration for better HTML integration !')
            ;

        $emailSecund = ( new Email() )
            ->from('amirbabio43@gmail.com')
            ->from(new Address('rodias@gmail.com', 'GOHOUE'))
            ->to('amirbabio40@gmail.com')
            ->cc('cc@example.com')
            ->bcc('bcc@example.com')
            ->replyTo('fabien@example.com')
            ->priority(Email::PRIORITY_LOWEST)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('See Twig integration for better HTML integration !')
            ;

        $mailerInterface->send($email);
        $mailerInterface->send($emailSecund);

        

        return $this->render('accueil/home.html.twig', [
            'controller_name' => 'AccueilController',
            
        ]);
    }    
}
