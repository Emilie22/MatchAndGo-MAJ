<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{

                            // FORMULAIRE DE CONTACT //
    /**
     * @Route("/contact", name="contact")
     */
     public function addContact(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){ 
            $profile = $form->getData();
            $entityManager->persist($profile);
            $entityManager->flush();

            $this->addFlash('warning', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('contact');
    }

        return $this->render('contact/index.html.twig', ['form' => $form->createView()]);
   }

   
}
