<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;
use App\Form\BlogType;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentType;

class BlogController extends AbstractController
{                     // PAGE BLOG //

     /**
     * @Route("/blog", name="blog")
     */ 

      public function blog()    {

        $repository = $this->getDoctrine()->getRepository(Blog::class);
        
        $blogs = $repository->findAll();

        return $this->render('blog/index.html.twig', [
            'blogs' => $blogs,
        ]);
    }
                  // GENERATION DES SLUG POUR LES ARTICLES DE BLOG //

   /**
    * @Route("/blog/{slug}", name="showBlogWithSlug", requirements={"slug"="[a-z0-9]+(?:-[a-z0-9]+)*"})
    */
        public function showBlogWithSlug(Request $request, Blog $blog){

            if(!$blog){
            throw $this->createNotFoundException('No article found');
        }

        return $this->render('blog/blog.html.twig',
                                        ['blog' => $blog ]
        );

            
        }


}
