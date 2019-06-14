<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Concept;
use App\Form\ConceptType;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;


class ConceptController extends AbstractController
{
    /**
     * @Route("/concept", name="concept")
     */
    
    public function showConcept(){
    	$repository = $this->getDoctrine()->getRepository(Concept::class);
        $concepts = $repository->findAll();

        return $this->render('concept/concept.html.twig', [
            'concepts' => $concepts,
        ]);
    }

}


