<?php
namespace App\Controllers;

use App\Entity\Adhesion;
use App\Entity\UserRepository;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Entity\Planification;
use App\Entity\Salle;
use App\Entity\TypeCours;
use App\Entity\Staff;
use App\Entity\Fonction;
use App\Entity\Reservation;
use App\Entity\User;

class HomeController extends Controller
{
    public function pageAccueil(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'pages/accueil.twig', ['montitre' => 'NOS CLUBS SONT FERMÉS ! ']);
    }

    public function pageMusculation(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'pages/musculation.twig', ['montitre' => 'Salle de Musculation ']);
    }

    public function pageSquash(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'pages/squash.twig', ['montitre' => 'Salle de Squash']);
    }

    public function pageGymnastique(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'pages/gymnastique.twig', ['montitre' => 'Salle de Gymnastique']);
    }

    public function pageCoach(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'pages/coach.twig', ['montitre' => 'Notre équipe']);
    } 

    public function pageTarifs(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'pages/tarifs.twig', ['montitre' => 'Nos Tarifs']);
    }

    public function pageAccueil2(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }                  
        return $this->render($response, 'client/accueil.twig', ['montitre' => 'NOS CLUBS SONT FERMÉS ! ', 'nom' => $nom , 'prenom' => $prenom]);
    }

    public function pageMusculation2(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }   
        return $this->render($response, 'client/musculation.twig', ['montitre' => 'Salle de Musculation ', 'nom' => $nom , 'prenom' => $prenom]);
    }

    public function pageSquash2(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }   
        return $this->render($response, 'client/squash.twig', ['montitre' => 'Salle de Squash', 'nom' => $nom , 'prenom' => $prenom]);
    }

    public function pageGymnastique2(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }   
        return $this->render($response, 'client/gymnastique.twig', ['montitre' => 'Salle de Gymnastique', 'nom' => $nom , 'prenom' => $prenom]);
    }

    public function pageCoach2(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }   
        return $this->render($response, 'client/coach.twig', ['montitre' => 'Notre équipe', 'nom' => $nom , 'prenom' => $prenom]);
    }

    public function pageCoursCollectif2(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }   
        return $this->render($response, 'client/cours-collectifs.twig', ['montitre' => 'Nos Cours Collectifs', 'nom' => $nom , 'prenom' => $prenom]);
    }

    public function pageTarifs2(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }   
        return $this->render($response, 'client/tarifs.twig', ['montitre' => 'Nos Tarifs', 'nom' => $nom , 'prenom' => $prenom]);
    }
// affichage vue reservation coté client
    public function showPlanning(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            } 
        $planifications = $this->em->getRepository(Planification::class)->findAfterDateOfTheDay2();                
        return $this->render($response, 'client/showplanning.twig', ['montitre' => 'Plannings complet des réservations','planifications' => $planifications, 'nom' => $nom , 'prenom' => $prenom, 'NumClient' => $NumClient]);
    }  

// affichage vue reservation cours de squash coté client
    public function showPlanningSquash(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            } 
        $planifications = $this->em->getRepository(Planification::class)->findTypeCoursSquash();                
        return $this->render($response, 'client/showplanningsquash.twig', ['montitre' => 'Réservations Squash','planifications' => $planifications, 'nom' => $nom , 'prenom' => $prenom, 'NumClient' => $NumClient]);
    } 

// affichage vue reservation cours de gym coté client 
    public function showPlanningGym(RequestInterface $request, ResponseInterface $response, $args)
    {
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            } 
        $planifications = $this->em->getRepository(Planification::class)->findTypeCoursGym();                
        return $this->render($response, 'client/showplanninggym.twig', ['montitre' => 'Réservations Gymnastique','planifications' => $planifications, 'nom' => $nom , 'prenom' => $prenom, 'NumClient' => $NumClient]);
    }  
// affichage vue reservation cours collectif coté client    
    public function showPlanningCollectif(RequestInterface $request, ResponseInterface $response, $args)
    {
        //normalement toutes tes actions sont dans ce if car sinon pas de client pour faire le reste
        if (array_key_exists('NomClient', $_SESSION) ) {
            $nom=$_SESSION['NomClient'];
            $prenom=$_SESSION['PrenomClient'];
            $NumClient=$_SESSION['NumClient'];
            }

        //ne renvoyer que les planifications possibles donc celle ayant un typeCours qui soit dans le liste des id $typeCoursPossibles
        $planifications = $this->em->getRepository(Planification::class)->findTypeCoursCollectif();                
        return $this->render($response, 'client/showplanningcollectif.twig', ['montitre' => 'Réservation des Cours Collectifs','planifications' => $planifications, 'nom' => $nom , 'prenom' => $prenom, 'NumClient' => $NumClient]);
    }    
    
// sauvegarde de la reservation
    public function saveReservation(RequestInterface $request, ResponseInterface $response, $param)
    {
        $isValidAdhesion = false;
        $isValidFormule = false;
        // 1) On récupère les données de saisie...
        $numClient = $_SESSION['NumClient'];
        $client=$this->em->getRepository(User::class)->find($numClient);
        $planification=$this->em->getRepository(Planification::class)->find($param['idPlanification']);

        //type cours présents dans les adhésions du client
        $typeCoursPossibles = $this->em->getRepository(User::class)->findTypeCoursUser($client->getId());

        //récupérer les adhésions pour le type de cours de la planification
        $adhesions = $this->em->getRepository(Adhesion::class)->findAdhesionsUserByTypeCours($client->getId(), $planification->getTypeCours()->getId());

        foreach ($typeCoursPossibles as $tcp)
        {
            //si le type de cours de la planification est égale à un type cours autorisé au client
            //alors on sort de la boucle
            if ($planification->getTypeCours()->getId() == $tcp['id']) {
                $isValidFormule = true;
                break;
            }
        }

        foreach ($adhesions as $adhesion)
        {
            //calcul de la fin d'adhésion
            $adhesion->setDateFinAdhesion();
            if ($adhesion->getDateFinAdhesion() >= $planification->getDatePlanification()) {
                //si la date de fin d'adhesion est supérieure à la date de planification
                //c'est ok on sort de la boucle
                $isValidAdhesion = true;
                break;
            }
        }

        //si c'est valide on peut faire la reservation
        if($isValidAdhesion && $isValidFormule) {
            $monReservation = new Reservation( $planification, $client );
            $this->em->persist($monReservation);
            $this->em->flush();
        } else {
            $this->alert(["Réservation impossible, vous n'avez pas souscrit d'adhesion pour ce type de cours. Venez souscrire votre adhésion au club Musquash et profiter de tarif préférentielle"], 'danger');
        }
        $route1 = $this->container->get("router")->urlFor("showplanningsquash");
        $route2 = $this->container->get("router")->urlFor("showplanninggym");
        $route3 = $this->container->get("router")->urlFor("showplanningcollectif");
        //todo envoyer peut être un commentaire pour dire si la resa a été refusé ?
        if($isValidAdhesion && $isValidFormule && $route1){
        // On redirige vers la route de la liste des Reservation (code http 302 = redirection http)
        return $response->withHeader('Location', $route1)->withStatus(302);
        } elseif ($isValidAdhesion && $isValidFormule && $route2) {
            
            // On redirige vers la route de la liste des Reservation (code http 302 = redirection http)
            return $response->withHeader('Location', $route2)->withStatus(302);
        } elseif ($isValidAdhesion && $isValidFormule && $route3) {
            
            // On redirige vers la route de la liste des Reservation (code http 302 = redirection http)
            return $response->withHeader('Location', $route3)->withStatus(302);
        }
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showplanning"))->withStatus(302);
    }


    public function getHome(RequestInterface $request, ResponseInterface $response)
    {
        
        return $response->withHeader('Location', $this->container->get("router")->urlFor("pageAccueil"))->withStatus(302);
    }

    public function postHome(RequestInterface $request, ResponseInterface $response)
    {
        return $this->redirect($response, 'pageAccueil');
    }

    public function postMusculation(RequestInterface $request, ResponseInterface $response)
    {
        return $this->redirect($response, 'pageMusculation');
    }

    public function postSquash(RequestInterface $request, ResponseInterface $response)
    {
        return $this->redirect($response, 'pageSquash');
    }

    public function postCoach(RequestInterface $request, ResponseInterface $response)
    {
        return $this->redirect($response, 'pageCoach');
    }

    public function postCoursParticuliers(RequestInterface $request, ResponseInterface $response)
    {
        return $this->redirect($response, 'pageCoursParticuliers');
    }

    public function postTarifs(RequestInterface $request, ResponseInterface $response)
    {
        return $this->redirect($response, 'pageTarifs');
    }

}
