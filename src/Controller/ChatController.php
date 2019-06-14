<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Chat;
use App\Entity\Salon;

class ChatController extends AbstractController
{
    /**
     * Création d'un salon à partir de la page match
     * @Route("/chat/add/{idUser}", name="addChat", requirements={"idUser"="\d+"})
     */
    public function addChat($idUser)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()->getRepository(User::class);
        $user = $this->getUser();
        
        $invite = $repository->findById($idUser);

        foreach ($invite as $key=>$value) {
            $inviteId = $value;
        }
                
        $chat1 = new Chat();
        $chat1 ->setUser($this->getUser());
        $chat1 ->setMessage('Vous avez invité ' . $inviteId->getFirstname() . ' à parler');
        $chat1 ->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $salon1 = new Salon();
        $salon1->setName('Salon de discussion avec ' . $inviteId->getFirstname());

        $chat1 ->setSalon($salon1);

// Début de la liaison des users :

        $chat = new Chat();
        $chat ->setUser($inviteId);
        $chat ->setMessage('Vous avez été invité(e) à parler avec ' . $user->getFirstname());
        $chat ->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $chat ->setSalon($salon1);

        $entityManager->persist($chat1);
        $entityManager->persist($salon1);
        $entityManager->persist($chat);


            $entityManager->flush();

            $this->addFlash('warning', 'Salon créé');
        return $this->redirectToRoute('chat');
    }

    /**
     * @Route("/chat", name="chat")
     */
    public function index(Request $request) {

            	
    	$repository = $this->getDoctrine()->getRepository(User::class);
        $users = $repository->myFindAll($this->getUser()->getId());
        
    	$userAnswers = [];

        // dump($users);

    	foreach ($users as $user) {
            // dump($user);
    		$userAnswers[] = implode(" ", $user);
    	}

    	$test = array_count_values($userAnswers);

    	$userMatch = [];
    	foreach ($test as $key=>$value) {
    		if ($value > 15) {
    			$userMatch[] = $repository->findById($key);
    		}
    	}

        $repository = $this->getDoctrine()->getRepository(Chat::class);

        $user = $this->getUser();
        $userId = $user->getId();
        $chat = $repository->findWithChat($userId);
        return $this->render('chat/index.html.twig', ['chats'=>$chat, 'userMatch'=> $userMatch]);
    }


    // Requête Ajax :

    /**
     * @Route("/chat/changeSalon", name="changeSalon")
     */
    public function changeSalon(Request $request){

        $idSalon = $request->request->get('idSalon', null);
        $user = $this->getUser();
        $repository = $this->getDoctrine()->getRepository(Chat::class);
        $message = $repository->viewMessage($idSalon);
        dump($message);
        return $this->render('chat/message.html.twig', ['messages'=>$message, 'user'=>$user]);
    }

    /**
     * @Route("/chat/addMessage", name="addMessage")
     */
    public function addMessage(Request $request){
        $idSalon = $request->request->get('idSalon', null);
        $idUser = $request->request->get('idUser', null);
        $message = $request->request->get('message', null);

        $entityManager = $this->getDoctrine()->getManager();

        $repositorySalon = $this->getDoctrine()->getRepository(Salon::class);
        $idSalon = $repositorySalon->findById($idSalon);
        foreach ($idSalon as $key=>$value) {
            $idSalon = $value;
        }
        $repositoryUser = $this->getDoctrine()->getRepository(User::class);
        $idUser = $repositoryUser->findById($idUser);
        foreach ($idUser as $key=>$value) {
            $idUser = $value;
        }
        dump($idSalon);
        $chat = new Chat();
        $chat->setMessage($message);
        $chat->setSalon($idSalon);
        $chat->setUser($idUser);
        $chat->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $entityManager->persist($chat);
        $entityManager->flush();

        return $this->redirectToRoute('chat');
    }
    /**
     * @Route("/chat/addUserOnchat", name="UserOnChat")
     */
    public function addUserOnChat(Request $request){
        $idSalon = $request->request->get('idSalon', null);
        $idUserB = $request->request->get('idUserB', null);
        dump($idUserB);
        dump($idSalon);

        $entityManager = $this->getDoctrine()->getManager();

        $repositorySalon = $this->getDoctrine()->getRepository(Salon::class);

        $idSalon = $repositorySalon->findById($idSalon);
        foreach ($idSalon as $key=>$value) {
            $idSalon = $value;
        }

        $repositoryUser = $this->getDoctrine()->getRepository(User::class);

        $idUserB = $repositoryUser->findById($idUserB);
        foreach ($idUserB as $key=>$value) {
            $idUser = $value;
        }

        
        $chat = new Chat();
        $chat->setMessage('Vous avez invité ' . $idUser->getFirstname());
        $chat->setSalon($idSalon);
        $chat->setUser($idUser);
        $chat->setDateSend(new \DateTime(date('Y-m-d H:i:s')));

        $entityManager->persist($chat);
        $entityManager->flush();

        return $this->redirectToRoute('chat');
    }
}
