<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use App\Service\FileUploader;
use App\Form\ProfileType;
use App\Entity\ResetPassword;
use App\Entity\User;

class SecurityController extends AbstractController

                                 // CONNEXION //
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }



                    // AFFICHAGE DU PROFIL DE L'UTILISATEUR CONNECTE //

   /**
   * @Route("/login/infos", name="userInfo")
   */

    public function showConnectedUser(Request $request){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        $entityManager = $this->getDoctrine()->getManager();

        $imgBgProfile = [];
        for ($i=1; $i<=5; $i++) {
            $imgBgProfile[] = 'backgroundprofile'.$i;
        }

        $entityManager->flush();

    return $this->render('security/index.html.twig', ['user'=>$user, 'imgBgProfile'=>$imgBgProfile]);

    }


                    // MOT DE PASSE OUBLIE //
    /**
     * @Route("/reset/password", name="resetPassword")
     */
    public function showFormResetPassword(Request $request, \Swift_Mailer $mailer){
        if(isset($request)){
            $post = $request->request->all();
        }

            $errors = [];
        if(!empty($post)){
            if(empty($post['email']) || !filter_var($post['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = 'Email invalide';
            }
            if($post['email'] !== $post['verifEmail']){
                $errors[] = 'Les emails ne sont pas identiques';
            }
            if(empty($errors)){
                $repository = $this->getDoctrine()->getRepository(User::class);
                $users = $repository->findByEmail($post['email']);
                
                
                if(count($users)){
                    function random($var){
                        $string = "";
                        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
                        srand((double)microtime()*1000000);
                        for($i=0; $i<$var; $i++){
                            $string .= $chaine[rand()%strlen($chaine)];
                        }
                        return $string;
                    }
                        $token = random(25);
                        foreach ($users as $key=>$value) {
                            $users = $value;
                        }

                        $resetPassword = new ResetPassword();
                        $resetPassword ->setUser($users);
                        $resetPassword ->setToken($token);

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($resetPassword);
                        $entityManager->flush();
                        
                        $user = $users->getId();

                    $message = (new \Swift_Message('Mot de passe oublié'))
                        ->setFrom('matchandgowf3@gmail.com')
                        // ->setTo('$post['email'])
                        ->setBody("<a href='{{ url('valideToken', {'token': $token, 'id': $user }) }}'>Cliquez ici pour changez votre mot de passe </a>");


                                $mailer->send($message);

                                $this->addFlash('success', 'Veuillez regarder votre boite mail ');
                        return $this->redirectToRoute('home');
                    }
                }
            }
    return $this->render('security/resetPassword.html.twig', ['errors'=>$errors]);
    }

    /**
     * @Route ("/login/valideToken/{token}/{id}", name="valideToken", requirements={"id"="\d+", "token"="\w+"})
     */
    public function valideToken($token, $id){

        if(isset($token) && isset($id)){

            if(empty($id) && !is_numeric($id)){
                $errors[] = 'lien incorrect';
            }

            if(empty($token)){
                $errors[]= 'lien token incorrect';
            }

            $repository = $this->getDoctrine()->getRepository(ResetPassword::class);

            $users = $repository->myfindByToken($token);
            
            if(count($users) > 1){
                return $this->redirectToRoute('formPassword', ['id'=>$id, 'token'=>$token]);
            }
        } else{
                $this->addFlash('warning', 'Votre token est invalide !');
            return $this->redirectToRoute('home');
        }
    }
    /**
     * @Route ("/login/formPassword/{id}/{token}", name="formPassword", requirements={"id"="\d+", "token"="\w+"})
     */
        public function changePassword(Request $request, $id, $token){
            $post = $request->request->all();

            if(!empty($post)){

                if(($post['password'] === $post['verifPassword']) && strlen($post['password']) > 4 && strlen($_POST['password']) < 10 ){
            
                    $newMdp = password_hash(trim(strip_tags($post['password']), PASSWORD_DEFAULT));

                        $repository = $this->getDoctrine()->getRepository(ResetPassword::class);
                        $tokens = $repository->findByToken($token);

                        if(!empty($tokens)){
                            $repository = $this->getDoctrine()->getRepository(User::class);
                            $UserPassword = $repository->changePassword($newMdp, $id);

                            $this->addFlash('success', 'Mot de passe changé !');
                            return $this->redirectToRoute('app_login');

                        }
                    }
                }
                $this->addFlash('warning', 'Une erreur est survenue !');
            return $this->render('security/formPassword.html.twig');
        }
}


