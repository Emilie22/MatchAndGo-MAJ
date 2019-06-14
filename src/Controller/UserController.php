<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Service\FileUploader;
use App\Form\ProfileType;
use App\Entity\User;
use Symfony\Component\Validator\Constraints\DateTime;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

                    // FORMULAIRE DE CREATION DU PROFIL //


    /**
     * @Route("/user/add", name="addProfile")
     */


    public function addProfile(Request $request,FileUploader $fileuploader, ValidatorInterface $validator)
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();

        $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
        
        $errors = $validator->validate($user);

                    /* PROBLEME avec Serialization du fichier, validation du formulaire impossible */

        // if(count($errors)>0){
            
        //         return $this->render('user/add.html.twig', ['form' => $form->createView(), 'errors' => $errors]);
        // }
        // if($form->isSubmitted() && $form->isValid() && count($errors) === 0){

        if($form->isSubmitted()){

            
            $user = $form->getData();

            $file = $user->getPicture(); 

            $filename = $file ? $fileuploader->upload($file, $this->getParameter('user_image_directory')) : '';

            $user->setPicture($filename);
        

            $entityManager->flush();


            $this->addFlash('warning', 'Votre profil a bien été créé !');
            return $this->redirectToRoute('userInfo');
        }

        return $this->render('user/add.html.twig', ['form' => $form->createView()]);

        }


                        // FORMULAIRE DE MODIFICATION DU PROFIL //

    /**
    * @Route("/login/update", name="updateProfile")
    */
    public function updateProfile(Request $request, FileUploader $fileuploader, ValidatorInterface $validator){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();



        /* PROBLEME avec Serialization du fichier, validation impossible */

        // $filename = $user->getPicture();

        if ($user->getPicture()) {
            // $user->setPicture(new File($this->getParameter('upload_directory') . $this->getParameter('user_image_directory') . '/' . $filename ));
        }

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        $errors = $validator->validate($user);

        /* PROBLEME avec Serialization du fichier, validation impossible */

        // if(count($errors)>0){
            
        //         return $this->render('user/update.html.twig', ['form' => $form->createView(), 'errors' => $errors]);
        // }

        // if($form->isSubmitted() && $form->isValid() && count($errors) === 0)
        // {

         if($form->isSubmitted())
        {
            $user = $form->getData();

            if ($user->getPicture()) { 

                $file = $user->getPicture();

            $filename = $file ? $fileuploader->upload($file, $this->getParameter('user_image_directory')) : '';
            }

            $user->setPicture($filename);

            $entitymanager = $this->getDoctrine()->getManager();

            $entitymanager->flush();


            $this->addFlash('warning', 'Votre profil a bien été modifié');
            
            return $this->redirectToRoute('userInfo');
        }
        return $this->render('user/update.html.twig', ['user'=>$user, 'form' => $form->createView()]);
    }


                /* PAGE POUR VOIR LE PROFIL D'UN UTILISATEUR */

    /**
      * @Route ("/user/show/{slug}", name="showProfileWithSlug", requirements={"slug"="[a-z0-9]+(?:-[a-z0-9]+)*"})
      */
      public function showProfileWithSlug(User $user){

            $imgBgProfile = [];
            for ($i=1; $i<=6; $i++) {
                $imgBgProfile[] = 'backgroundprofile'.$i;
            }
        
           return $this->render('user/userInvite.html.twig', [ 'user' => $user, 'imgBgProfile'=>$imgBgProfile]);
      }

}