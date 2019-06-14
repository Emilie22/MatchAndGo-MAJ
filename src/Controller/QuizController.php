<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\User;

class QuizController extends AbstractController
{
    /**
     * @Route("/quiz", name="quiz")
     */
    public function showQuiz(Request $request)
    {

    	// requête pour récupérer et pouvoir afficher toutes les questions du quiz
    	$repository = $this->getDoctrine()->getRepository(Question::class);
    	$questions = $repository->findAll();

    	// tableau pour pouvoir afficher les photos du quiz/carousel en random
    	$imgQuiz = [];
    	for ($i=1; $i<=23; $i++) {
    		$imgQuiz[] = 'carousel'.$i;
    	}


    	// traitement du formulaire du quiz
		$post = $request->request->all();

		if (!empty($post)) {

		// $user = moi
		$user = $this->getUser();

		// si j'ai déjà répondu au quiz, je supprime toutes mes anciennes réponses
		$oldAnswers = $user->getAnswers();
		foreach ($oldAnswers as $key => $value) {
			$user->removeAnswer($value);
		}
		
		// je crée un tableau $answerObj où je stocke les id des réponses récupérées du quiz
		// et je rajoute ces id dans le champ answers de ma table User		
    	$repositoryAnswer = $this->getDoctrine()->getRepository(Answer::class);
    	$answerObj = new Answer();
		$answerObj = [];
		foreach ($post as $key => $value){
			$answerObj[] = $repositoryAnswer->find($value);
			foreach ($answerObj as $key => $value) {
				$user->addAnswer($value);
			}
		}
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->flush();

		// je suis redirigée sur la page qui affiche mes match
		return $this->redirectToRoute('match');

		}

    return $this->render('quiz/index.html.twig', ['questions' => $questions, 'imgQuiz'=>$imgQuiz]);

    }



}

