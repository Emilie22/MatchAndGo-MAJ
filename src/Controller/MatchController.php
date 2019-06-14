<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\User;
use App\Entity\Answer;

class MatchController extends AbstractController
{
    /**
     * @Route("/match", name="match")
     */
    public function index()
    {
    	// requête pour récupérer les id des users qui ont répondu aux mêmes réponses que moi
    	$repository = $this->getDoctrine()->getRepository(User::class);

    	$users = $repository->myFindAll($this->getUser()->getId());

        // je crée un tableau avec les id users
    	$userAnswers = [];
    	foreach ($users as $user) {

    		$userAnswers[] = implode(" ", $user);
    	}
        // je compte combien de fois les id user sont dans le tableau
    	$test = array_count_values($userAnswers);

        // je crée un tableau qui récupère les users dont le nombre de réponses en commun avec moi
        // est supérieur à 14
    	$userMatch = [];
    	foreach ($test as $key=>$value) {
    		if ($value > 14) {
    			$userMatch[] = $repository->findById($key);
    		}
    	}

        // je crée un tableau qui récupère les villes de mes user match
        // et un tableau qui récupère les noms, lattitude et longitude (api google map)

        $cityTab = [];
        $userCoord = [];
        foreach ($userMatch as $userCity) {
            foreach ($userCity as $keyobj=>$obj) {
                $id = $obj->getId();
                $firstname = $obj->getFirstname();
                if ($keyobj = 'city') {
                    $cityTab[] = $obj->getCity();
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={".urlencode(strip_tags($obj->getCity()))."}&key=AIzaSyB0xJoi5c9MwYIYQlwIEfLqLh95hLtcaYA";
                    $resultat = json_decode(file_get_contents($url, false), true);

                    $lat = $resultat['results'][0]['geometry']['location']['lat'];
                    $lng = $resultat['results'][0]['geometry']['location']['lng'];
                    $userCoord[] = ['firstname'=>$firstname, 'id'=>$id, 'lat'=>$lat, 'lng'=>$lng];
                }
            }
        }

        $moi = $this->getUser();

        return $this->render('match/index.html.twig', [
            'users'=>$users, 'userAnswers'=>$userAnswers, 'userMatch'=>$userMatch, 'test'=>$test, 'moi'=>$moi,  'userCoord'=>$userCoord, 'cityTab'=>$cityTab,
        ]);

    }

}
