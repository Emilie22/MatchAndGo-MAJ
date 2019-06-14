<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Blog;
use App\Entity\Concept;
use App\Entity\User;
use App\Form\BlogType;
use App\Form\ConceptType;
use App\Form\ProfileType;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController{

	/**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/blog/add", name="addBlogAdmin")
     */ 

    public function addBlog(Request $request, FileUploader $fileuploader){


    	$entityManager = $this->getDoctrine()->getManager();
    	
        $form = $this->createForm(BlogType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $blog = $form->getData();


            $file = $blog->getPictureBlog();

            $filename = $fileuploader->upload($file, $this->getParameter('article_image_directory'));


            $blog->setPictureBlog($filename);

    
            $blog->setDatePost(new \DateTime(date('Y-m-d H:i:s')));

            $entityManager->persist($blog);

            $entityManager->flush();

            $this->addFlash('warning', 'L\'article a bien été ajouté !');

            return $this->redirectToRoute('addBlogAdmin');

        }

    	return $this->render('admin/add.blog.html.twig', ['form' => $form->createView()]);

    }

    /**
    *@Route("admin/blog/delete/{slug}", name="deleteBlog", requirements={"slug"="[a-z0-9]+(?:-[a-z0-9]+)*"})
    */
    public function deleteBlog(Blog $blog){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');


       $entityManager = $this->getDoctrine()->getManager();

       $entityManager->remove($blog);

       $entityManager->flush();

       //génération d'un message flash
       $this->addFlash('warning', 'L\'article a bien été supprimé !');
       //redirection vers la liste des articles
       return $this->redirectToRoute('blog');
    }

    /**
    * @Route("admin/blog/update/{slug}", name="updateBlog", requirements={"slug"="[a-z0-9]+(?:-[a-z0-9]+)*"})
    */
    public function updateBlog(Request $request, Blog $blog, FileUploader $fileuploader){

    	 $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $filename = $blog->getPictureBlog();

        if ($blog->getPictureBlog()) {
            $blog->setPictureBlog(new File($this->getParameter('upload_directory') . $this->getParameter('article_image_directory') . '/' . $filename ));
        }

        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $blog = $form->getData();

            if ($blog->getPictureBlog()) { 

                $file = $blog->getPictureBlog();

            $filename = $fileuploader->upload($file, $this->getParameter('article_image_directory'), $filename);
            }

            $blog->setPictureBlog($filename);

            $entitymanager = $this->getDoctrine()->getManager();

            $entitymanager->flush();


            $this->addFlash('warning', 'Blog modifié');
        }
        return $this->render('admin/add.blog.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/concept/add", name="addConceptAdmin")
     */ 

    public function addConcept(Request $request, FileUploader $fileuploader){


        $entityManager = $this->getDoctrine()->getManager();
        
        $form = $this->createForm(ConceptType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $concept = $form->getData();

            $file = $concept->getPictureConcept();

            $filename = $fileuploader->upload($file, $this->getParameter('concept_image_directory'));

            $concept->setPictureConcept($filename);

            $entityManager->persist($concept);

            $entityManager->flush();

            $this->addFlash('success', 'texte ajouté');

            return $this->redirectToRoute('concept');

        }

        return $this->render('admin/add.concept.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/concept/delete/{id}", name="deleteConcept", requirements={"id"="\d+"})
     */ 

    public function deleteConcept(Concept $concept){

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

       $entityManager = $this->getDoctrine()->getManager();

       $entityManager->remove($concept);

       $entityManager->flush();

       $this->addFlash('warning', 'texte supprimé');

       return $this->redirectToRoute('concept');
    }

    /**
    * @Route("/admin/concept/update/{id}", name="updateConcept", requirements={"id"="\d+"})
    */
    public function updateConcept(Request $request, Concept $concept, FileUploader $fileuploader){

         $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $filename = $concept->getPictureConcept();

        if ($concept->getPictureConcept()) {
            $concept->setPictureConcept(new File($this->getParameter('upload_directory') . $this->getParameter('concept_image_directory') . '/' . $filename ));
        }

        $form = $this->createForm(ConceptType::class, $concept);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $concept = $form->getData();

            if ($concept->getPictureConcept()) { 

                $file = $concept->getPictureConcept();

            $filename = $fileuploader->upload($file, $this->getParameter('concept_image_directory'), $filename);
            }
    
            $concept->setPictureConcept($filename);

            $entitymanager = $this->getDoctrine()->getManager();

            $entitymanager->flush();

            $this->addFlash('warning', 'Texte modifié');

            return $this->redirectToRoute('concept');
        }
        return $this->render('admin/add.concept.html.twig', ['form' => $form->createView()]);
    }

    /**
    *@Route("admin/users", name="users")
    */
    public function showUser(){


        $repository = $this->getDoctrine()->getRepository(User::class);
        
        $users = $repository->findBy(array(), array('firstname' => 'ASC'));
        return $this->render('admin/show.user.html.twig', [ 'users' => $users ]);
    }

    /**
    *@Route("admin/user/delete/{id}", name="deleteUser", requirements={"id"="\d+"})
    */
    public function deleteUser(User $user){

       $entityManager = $this->getDoctrine()->getManager();

       $entityManager->remove($user);

       $entityManager->flush();

       //génération d'un message flash
       $this->addFlash('warning', 'Utilisateur supprimé');
       //redirection vers ....
       return $this->redirectToRoute('users');

    }

}