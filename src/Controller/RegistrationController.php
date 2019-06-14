<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
                            // INSCRIPTION SUR LE SITE //
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator, ValidatorInterface $validator): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        $errors = $validator->validate($user);

        if(count($errors)>0){
            
                return $this->render('registration/register.html.twig', ['registrationForm' => $form->createView(), 'errors' => $errors]);
        }

        if($form->isSubmitted() && count($errors) === 0){

            /** @var User */
            $user = $form->getData();


            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->eraseCredentials();
            $user->setRoles(['ROLE_USER']);
            $user->setFirstname('');
            $user->setLastname('');
            $user->setCity('');
            $user->setBirthday(new \DateTime(date('')));
            $user->setGender('');
            $user->setPhone('');
            $user->setPicture('');
            $user->setDescription('');
            $user->setCountries('');

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main'
            );

            $this->addFlash('warning', 'Vous êtes maintenant inscrit sur Match&Go');

            return $this->redirectToRoute('addProfile');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
