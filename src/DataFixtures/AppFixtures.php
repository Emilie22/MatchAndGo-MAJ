<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Question;
use App\Entity\User;
use App\Entity\Answer;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        {

            $user = new User();
            $user->setLastname('Dupond');
            $user->setFirstname('Emilie');
            $user->setCity('Montpellier');
            $user->setBirthday(new \DateTime('1980-07-24'));
            $user->setGender('Femme');
            $user->setPhone('062324510');
            $user->setPicture('totophoto');
            $user->setDescription('Je suis maman solo d’une petite fille de 8 ans, et aussi une baroudeuse aguerrie ! J’adore voyager à chaque fois que j’ai des vacances avec ma fille. Ma destination phare est l’Amérique du Sud. J\'ai un goût prononcé pour la randonnée et les visites culturelles. Mon plus beau souvenir de voyage était quand j’ai visité le Machu Picchu. Je suis fascinée par la culture latino-américaine, je prends des cours de salsa et j’apprends l’espagnol pour préparer mon prochain séjour dans ce merveilleux continent ! J’adorerais voyager avec d’autres parents et leurs enfants !');
            $user->setCountries('Pérou, Mexique, Argentine');
            $user->setEmail('Leroy.emilie@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Giaconi');
            $user->setFirstname('Jean');
            $user->setCity('Paris');
            $user->setBirthday(new \DateTime('1990-10-03'));
            $user->setGender('Homme');
            $user->setPhone('0745245803');
            $user->setPicture('jeanphoto');
            $user->setDescription('Je travaille comme coach sportif et j’adore les sensations fortes. Pour moi, chaque voyage est l’occasion de tester de nouveaux sports extrêmes. J’ai eu l’occasion de faire un road trip en Australie durant lequel j’ai aussi appris à surfer. Je suis avide de nouvelles expériences et je ne manque jamais d’énergie pour faire de nouvelles découvertes. Pour moi, voyager, c’est me lever aux aurores et profiter de chaque moment pour visiter le plus possible le pays où je me trouve.');
            $user->setCountries('USA, Australie, Chine');
            $user->setEmail('Giaconi.jean@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Vaugiraud');
            $user->setFirstname('Mélanie');
            $user->setCity('Lyon');
            $user->setBirthday(new \DateTime('1995-12-27'));
            $user->setGender('Femme');
            $user->setPhone('0630204706');
            $user->setPicture('melaniephoto');
            $user->setDescription('Je suis étudiante en histoire et je suis passionnée par les cultures étrangères. Quand je voyage, j’adore parler avec les gens, découvrir la façon de vivre des locaux, m’instruire… J’adore visiter des musées, mais aucun de mes amis ne partage cette passion. J’aimerais donc trouver des voyageurs qui, comme moi, sont axés voyages culturels !');
            $user->setCountries('Angleterre, Finlande, Suède');
            $user->setEmail('Vaugiraud.melanie@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Franchin');
            $user->setFirstname('Paul');
            $user->setCity('Nice');
            $user->setBirthday(new \DateTime('2000-01-17'));
            $user->setGender('Homme');
            $user->setPhone('0645248783');
            $user->setPicture('paulphoto');
            $user->setDescription('Je suis un véritable digital nomad ! Je travaille comme développeur web en freelance. Quand je ne suis pas en France pour rencontrer mes clients, je baroude à travers le monde. Je suis très fêtard de nature et j’adore découvrir les endroits tendances et branchés durant mes voyages. Mon meilleur souvenir de voyage était Santorin en Grèce, une destination qui m’a beaucoup marqué !');
            $user->setCountries('Italie, Turquie, Grèce');
            $user->setEmail('Franchin.paul@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Ramont');
            $user->setFirstname('Audrey');
            $user->setCity('Rennes');
            $user->setBirthday(new \DateTime('1988-03-14'));
            $user->setGender('Femme');
            $user->setPhone('0630145327');
            $user->setPicture('audreyphoto');
            $user->setDescription('Passionnée de photographie, mes voyages sont l’occasion de capturer des paysages atypiques et des scènes de vie authentiques. Je tiens aussi un blog de voyage sur lequel je publie mes photos que j’accompagne de quelques articles sur mes ressentis et mes bons plans. La Tunisie est une destination qui m’a beaucoup marquée, et j’aimerais beaucoup découvrir d’autres pays du Maghreb. Je ne pars jamais sans mon appareil photo et je m’arrête souvent lors de mes visites pour shooter tout ce que je vois. Dans l’idéal, j’aimerais voyager avec des gens qui partagent cette passion, et qui aiment voyager lentement comme moi !');
            $user->setCountries('Grèce, Tunisie, Portugal');
            $user->setEmail('Ramont.audrey@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Beric');
            $user->setFirstname('Robert');
            $user->setCity('Nantes');
            $user->setBirthday(new \DateTime('1983-12-30'));
            $user->setGender('Homme');
            $user->setPhone('0734255730');
            $user->setPicture('robertphoto');
            $user->setDescription('Passionné des cultures d’Orient, j’ai été subjugué par l’Asie que j’ai découverte au cours d’un voyage au Japon, en Thaïlande et en Chine. J’adore partager mes connaissances, mes expériences, et découvrir de nouvelles cultures. Je suis vraiment très curieux de nature. J’aimerais beaucoup découvrir de nouveaux pays, notamment l’Afrique subsaharienne, et je préfèrerais voyager avec d’autres personnes qui partagent ma philosophie du voyage.');
            $user->setCountries('Japon, Thaïlande, Chine');
            $user->setEmail('Beric.robert@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);


            $users[] = $user;
        }

         {

            $user = new User();
            $user->setLastname('Marks');
            $user->setFirstname('Laura');
            $user->setCity('Strasbourg');
            $user->setBirthday(new \DateTime('1987-06-11'));
            $user->setGender('Femme');
            $user->setPhone('0625232754');
            $user->setPicture('lauraphoto');
            $user->setDescription('Pour moi, voyage veut dire détente et plages de rêves ! Mes destinations favorites sont des pays ensoleillés. Je rêve de découvrir les Caraïbes. J’ai très peu de vacances car je travaille énormément toute l’année dans un cabinet d’avocat. Donc il est vraiment vital pour moi de voyager de manière détendue, sans avoir à m’occuper de rien !');
            $user->setCountries('Afrique du Sud, Réunion, Martinique');
            $user->setEmail('Beriol.laura@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Prudhomme');
            $user->setFirstname('David');
            $user->setCity('Toulouse');
            $user->setBirthday(new \DateTime('1988-07-12'));
            $user->setGender('Homme');
            $user->setPhone('0740357862');
            $user->setPicture('davidphoto');
            $user->setDescription('Je travaille comme paysagiste et je suis ce qu’on peut appeler un voyageur écolo ! J’adore être en contact avec la nature, voyager de manière minimaliste, dormir dans des campings, en pleine nature. Je suis vegan et je cherche des voyageurs avec qui partager cette philosophie du voyage et cette passion pour la nature et l\'écologie');
            $user->setCountries('Brésil, Argentine, Colombie');
            $user->setEmail('Prudhomme.david@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Trapp');
            $user->setFirstname('Kevin');
            $user->setCity('Bordeaux');
            $user->setBirthday(new \DateTime('1986-02-01'));
            $user->setGender('Homme');
            $user->setPhone('0678423641');
            $user->setPicture('kevinphoto');
            $user->setDescription('Je travaille comme architecte et je suis vraiment passionné par la découverte des monuments, la visite d’églises, de cathédrales… J’adore effectuer de longues balades dans les villes que je visite et m’arrêter à chaque coin de rue pour admirer les détails architecturaux locaux. J’aimerais beaucoup partager cette passion avec des novices ou des passionnés comme moi !');
            $user->setCountries('Inde, Australie, Canada');
            $user->setEmail('Trapp.kevin@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Cardoso');
            $user->setFirstname('Sophie');
            $user->setCity('Marseille');
            $user->setBirthday(new \DateTime('1995-09-17'));
            $user->setGender('Femme');
            $user->setPhone('0660452010');
            $user->setPicture('sophiephoto');
            $user->setDescription('J’ai grandi en Polynésie Française et j’ai déménagé en France métropolitaine il y a deux ans. Depuis, je suis en manque de soleil et j’ai vraiment hâte de repartir en voyage. Quand je voyage, j’adore dormir dans des auberges de jeunesse pour rencontrer de jeunes voyageurs. Mais je n’ose pas partir seule, et je serais vraiment rassurée à l’idée de partir avec des gens de mon âge.');
            $user->setCountries('Nouvelle-Zélande, Polynésie Française, Réunion');
            $user->setEmail('Cardoso.sophie@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Austin');
            $user->setFirstname('Léa');
            $user->setCity('Nancy');
            $user->setBirthday(new \DateTime('1998-06-21'));
            $user->setGender('Femme');
            $user->setPhone('0625470105');
            $user->setPicture('leaphoto');
            $user->setDescription('Etudiante en relations internationales, j’ai réalisé un stage à Turin dans l’ambassade de France. Je suis tombée amoureuse de la culture, de la langue et de la nourriture ! Cette expatriation a déclenché mon goût du voyage et depuis mon retour en France, je n’ai qu’une envie, c’est de repartir ! J’adorerais voyager avec des gens de mon âge qui partage ma passion du voyage.');
            $user->setCountries('Espagne, Turquie, Italie');
            $user->setEmail('Austin.lea@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Ticot');
            $user->setFirstname('Iris');
            $user->setCity('Genève');
            $user->setBirthday(new \DateTime('2001-12-01'));
            $user->setGender('Femme');
            $user->setPhone('0789251078');
            $user->setPicture('irisphoto');
            $user->setDescription('Je suis ce qu’on peut appeler une voyageuse intrépide ! J’adore prendre des transports locaux, me perdre dans les rues d’une ville inconnue, parler à tout le monde… Je suis de nature très charismatique et j’aimerais beaucoup partir avec des filles de mon âge qui aiment, comme moi, s’ouvrir aux autres pendant leur voyage.');
            $user->setCountries('Equateur, Venezuela, Costa Rica');
            $user->setEmail('ticot.iris@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);


            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Vianello');
            $user->setFirstname('Thibault');
            $user->setCity('Madrid');
            $user->setBirthday(new \DateTime('1999-01-05'));
            $user->setGender('Homme');
            $user->setPhone('0620845394');
            $user->setPicture('photo');
            $user->setDescription('Passionné par l’Amérique du sud, j’aimerais beaucoup visiter le Pérou et le Brésil cette année. Actuellement en échange universitaire à Madrid, je suis très pris par mes études et je cherche des gens avec qui voyager d’une manière confortable, dans des hôtels et en prenant des transports rapides, en Europe et au Maghreb.');
            $user->setCountries('Equateur, Venezuela, Costa Rica');
            $user->setEmail('Vianello.thibault@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);


            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Da Silva');
            $user->setFirstname('Eva');
            $user->setCity('Lisbonne');
            $user->setBirthday(new \DateTime('1996-10-10'));
            $user->setGender('Femme');
            $user->setPhone('0610781256');
            $user->setPicture('evaphoto');
            $user->setDescription('Étudiante en éducation spécialisée, je suis partie à l’étranger il y a deux ans, pour effectuer une mission humanitaire au Brésil. J’ai été subjugué par ce pays à la culture si riche. Aujourd’hui, je souhaite multiplier mes expériences de voyage et créer de beaux souvenirs avec d’autres personnes.');
            $user->setCountries('Portugal, Brésil, Uruguay');
            $user->setEmail('Dasilva.eva@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);


            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Guion');
            $user->setFirstname('Stéphane');
            $user->setCity('Berlin');
            $user->setBirthday(new \DateTime('1991-05-23'));
            $user->setGender('Homme');
            $user->setPhone('0624451063');
            $user->setPicture('stephanephoto');
            $user->setDescription('L’année dernière, j’ai pris une année sabbatique dans mon job (je travaille comme conseiller en assurance), pour faire le tour du monde. Cette expérience enrichissante a marqué un vrai tournant dans ma vie. Depuis, je ne peux pas m’empêcher de prévoir mon prochain voyage ! J\'ai voyagé en solo pendant un an, j’aimerais cette fois partir avec des gens, qui souhaiteraient aussi voyager sur une longue durée (au moins 1 mois), dans une destination exotique !');
            $user->setCountries('France, Irlande, Suède');
            $user->setEmail('Guion.stephane@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);


            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Allois');
            $user->setLastName('Manon');
            $user->setCity('Londres');
            $user->setBirthday(new \DateTime('1992-11-02'));
            $user->setGender('Femme');
            $user->setPhone('0630783531');
            $user->setPicture('manonphoto');
            $user->setDescription('Etudiante en médecine, j’ai très peu de vacances. Mais le voyage est vraiment une passion que j’ai envie d’entretenir dès que j’en ai l’occasion. Les personnes de mon entourage n’étant pas très adeptes de voyage, je suis à la recherche de personnes qui souhaitent partir dans des destinations proches de la France, pour des séjours assez courts, voire des week-ends en Europe.');
            $user->setCountries('Japon, Russie, Maroc');
            $user->setEmail('Allois.manon@yahoo.fr');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Piralla');
            $user->setFirstname('Lana');
            $user->setCity('Athènes');
            $user->setBirthday(new \DateTime('1992-10-23'));
            $user->setGender('Femme');
            $user->setPhone('0720451723');
            $user->setPicture('photo');
            $user->setDescription('Je suis arrivée il y a un mois en Grèce pour travailler comme fille au pair. J’apprends le français à 3 enfants que je garde durant la semaine. Pendant mes week-ends, je souhaiterais voyager pour découvrir le pays. J’aimerais voyager avec des francophones car je ne parle pas grec et mon niveau d’anglais est très limité. Je suis très sociable et j’adore rencontrer de nouvelles personnes. Côté voyage, je préfère les activités reposantes et je préfère voyager dans de bonnes conditions, confortablement.');
            $user->setCountries('Algérie, Afrique du Sud, Bahamas');
            $user->setEmail('Piralla.lana@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Rodriguez');
            $user->setFirstname('Pedro');
            $user->setCity('Seville');
            $user->setBirthday(new \DateTime('1985-02-03'));
            $user->setGender('Homme');
            $user->setPhone('0623010523');
            $user->setPicture('pedrophoto');
            $user->setDescription('Je travaille comme reporter et grâce à mon métier, j’ai eu l’occasion de voyager dans de nombreux pays, et surtout en Afrique subsaharienne, où j’ai réalisé des documentaires sur des tribus locales. Pour moi, le voyage va de pair avec l’ouverture d’esprit, le partage, les rencontres avec les autres. Donc mon premier objectif quand je voyage est de m’intégrer dans la culture locale, de discuter avec les locaux, de faire les marchés, et des voyager dans des contrées reculées. Bref, le voyage hors des sentiers battus est mon objectif principal.');
            $user->setCountries('Namibie, Tanzanie, Swaziland');
            $user->setEmail('Rodriguez.predo@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Tevenot');
            $user->setFirstname('Michael');
            $user->setCity('Bordeaux');
            $user->setBirthday(new \DateTime('1980-11-14'));
            $user->setGender('Homme');
            $user->setPhone('0603255367');
            $user->setPicture('michaelphoto');
            $user->setDescription('Professeur d’anglais, je profite des vacances scolaires pour m’échapper aux quatre coins du monde. Ayant un budget limité, je privilégie les transports locaux et les destinations économiques. Mon objectif 2019 : voyager en Australie en auto-stop et dormir chez l’habitant ! Si vous avez comme moi, le goût de l’aventure et l’envie de voyager écolo, je serais ravi que l’on parte ensemble !');
            $user->setCountries('USA, Canada, Chine');
            $user->setEmail('Tevenot.michael@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('Vuckovic');
            $user->setFirstname('Andrea');
            $user->setCity('Moscou');
            $user->setBirthday(new \DateTime('1981-01-13'));
            $user->setGender('Femme');
            $user->setPhone('0610892536');
            $user->setPicture('andreaphoto');
            $user->setDescription('D’origine russe, j’ai baigné toute ma vie dans une double culture. Je travaille comme anthropologue et j’ai l’occasion d’effectuer de nombreux voyages à l’étranger grâce à ma profession. Je souhaiterais voyager dans des pays peu touristiques, en Afrique ou en Asie, avec des filles de mon âge.');
            $user->setCountries('Australie, Thaïlande, Hawaï');
            $user->setEmail('Vuckovic.andrea@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Dupont');
            $user->setLastName('Roger');
            $user->setCity('Tours');
            $user->setBirthday(new \DateTime('1964-07-05'));
            $user->setGender('Homme');
            $user->setPhone('0620895539');
            $user->setPicture('rogerphoto');
            $user->setDescription('Aujourd\'hui retraité, je souhaite profiter de mon temps libre pour voyager. Je suis veuf et ma femme rêvait de faire le tour du monde. J\'ai donc décidé de visiter un nouveau pays tous les 6 mois. J\'aimerais voyager avec d\'autres retraités, qui, comme moi, aime les voyages culturels. Ma prochaine destination de voyage est l\'Egypte et ses merveilleux trésors archéologiques.');
            $user->setCountries('Chine, Brésil, Turquie');
            $user->setEmail('Dupont.roger@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Bensaoud');
            $user->setLastName('Samia');
            $user->setCity('Tunis');
            $user->setBirthday(new \DateTime('1970-07-09'));
            $user->setGender('Femme');
            $user->setPhone('0660668834');
            $user->setPicture('samiaphoto');
            $user->setDescription('Je suis retraitée et j\'habite au Bardo, en Tunisie. Je vis seule, et j\'ai eu l\'occasion de découvrir le Maghreb avec ma famille. Aujourd\'hui j\'aimerais découvrir des destinations plus lointaines. Ce qui m\'intéresse dans le voyage, c\'est la dimension culturelle et l\'architecture.');
            $user->setCountries('Algérie, Egypte, Malte');
            $user->setEmail('Bensaoud.Samia@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setFirstname('Stéphanie');
            $user->setLastName('Lepage');
            $user->setCity('Brest');
            $user->setBirthday(new \DateTime('1982-02-25'));
            $user->setGender('Femme');
            $user->setPhone('0619758846');
            $user->setPicture('stephaniephoto');
            $user->setDescription('Maman solo de deux enfants, j\'aimerais trouver d\'autres mamans qui voyagent avec leurs enfants. J\'aime partir dans destinations exotiques, avec des plages paradisiaques. Mon objectif est vraiment de faire le plein d\'énergie et de soleil et d\'offrir à mes enfants de beaux souvenirs. Je suis pour les voyages clés en main, sans stress ni improvisation !' );
            $user->setCountries('Maldives, Thaïlande, Seychelles');
            $user->setEmail('Lepage.stephanie@gmail.com');
            $roles =['ROLE_USER'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);

            $users[] = $user;
        }

        {

            $user = new User();
            $user->setLastname('admin');
            $user->setFirstname('admin');
            $user->setCity('Bordeaux');
            $user->setBirthday(new \DateTime('1981-04-13'));
            $user->setGender('Homme');
            $user->setPhone('0610892536');
            $user->setPicture('adminphoto');
            $user->setDescription('Cela fait dix ans que je voyage autour du monde. J’ai exploré 50 pays, et je compte bien rallonger la liste ! Je suis adepte du voyage à sac à dos, minimaliste et hors des sentiers battus. J’espère trouver des voyageurs passionnés comme moi sur Match&Go !');
            $user->setCountries('Australie, Népal, Hawaï');
            $user->setEmail('admin@admin.com');
            $roles =['ROLE_USER', 'ROLE_ADMIN'];
            $user->setRoles($roles);
            $plainPassword = 'toto';
            $mdpencoded = $this->encoder->encodePassword($user, $plainPassword);
            $user->setPassword($mdpencoded);
            $manager->persist($user);


            $users[] = $user;
        }

        $manager->flush();
    }
}

