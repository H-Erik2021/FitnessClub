<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Twi\Extensions\IntlDateFormatter;
use Twi\Extensions\DateExtension;
use Twi\Extensions\IntlExtension;
use App\Entity\Planification;
use App\Entity\Salle;
use App\Entity\TypeCours;
use App\Entity\Staff;
use App\Entity\Fonction;
use App\Entity\User;

use DateTime;

class PlanificationController extends Controller {

  public function showPlanification(RequestInterface $request, ResponseInterface $response){
    $planifications = $this->em->getRepository(Planification::class)->findBy(array(), array('datePlanification' => 'ASC'));
    return $this->render($response, 'admin/showplanification.twig', ['planifications' => $planifications]); 
  }
 
   /* 
        Formulaire de modification d'un planning par son ID
    */
    public function modifyPlanification(RequestInterface $request, ResponseInterface $response, $args)
    {
        $salles=$this->em->getRepository(Salle::class)->findAll();
        $typeCours=$this->em->getRepository(TypeCours::class)->findAll();
        $fonctions=$this->em->getRepository(Fonction::class)->findBy(['isProf'=>1]);
        $personnels=$this->em->getRepository(Staff::class)->findBy(['Fonction'=> $fonctions]);
        // 1) On récupère le planning.
        $monPlanification = $this->em->getRepository(Planification::class)->find($args['id']);
        //var_dump($monPlanification);die;
        // 2) On appelle la vue d'affichage et on lui passe les infos de l'utilisateur
        return $this->render($response, 'admin/createplanification.twig', ['planification' => $monPlanification, 'salles'=>$salles,'typeCours'=>$typeCours,'personnels'=>$personnels, 'action' => 'Modifier']);
    }
    /* 
        Formulaire pour supprimmer un Planning par son ID
    */
    public function deletePlanification(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur
        $monPlanification = $this->em->getRepository(Planification::class)->find($args['id']);
        $this->em->remove($monPlanification);
        $this->em->flush();

         // On redirige vers la route de la liste des planning (code http 302 = redirection http)
         return $response->withHeader('Location', $this->container->get("router")->urlFor("showplanification"))->withStatus(302);
    }

    /*
        -> Fiche planning à partir de non nom
    */
    public function createPlanification(RequestInterface $request, ResponseInterface $response, $args)
    {
        
        $salles=$this->em->getRepository(Salle::class)->findAll();
        $typeCours=$this->em->getRepository(TypeCours::class)->findAll();
        $fonctions=$this->em->getRepository(Fonction::class)->findBy(['isProf'=>1]);
        $personnels=$this->em->getRepository(Staff::class)->findBy(['Fonction'=> $fonctions]);
       //var_dump($personnel);die;
        return $this->render($response, 'admin/createplanification.twig', ['planification' =>null, 'salles'=>$salles,'typeCours'=>$typeCours,'personnels'=>$personnels, 'action' => 'Créer']);
    }

    /* 
        Formulaire de modification d'un planning par son ID
    */
    public function savePlanification(RequestInterface $request, ResponseInterface $response)
    {
        // 1) On récupère les données de saisie...
        $dataPost = $request->getParsedBody();
        $salle = $this->em->getRepository(Salle::class)->find($dataPost['nomSalleId']);
        $typeCours = $this->em->getRepository(TypeCours::class)->find($dataPost['typeCoursId']);
        $perso = $this->em->getRepository(Staff::class)->find($dataPost['persoId']);
       // var_dump($dataPost);die; 
        // 2) On regarde si on est en création ou en modification
        if ($dataPost['id']) { // en Modification
            $monPlanification = $this->em->getRepository(Planification::class)->find($dataPost['id']);
            $monPlanification->setDatePlanification(new \DateTime($dataPost['datePlanification']));           
            $monPlanification->setSalle($salle);           
            $monPlanification->setTypeCours($typeCours);
            $monPlanification->setPerso($perso);  
             

        } else { // en Création
            $datePlanification = new \DateTime($dataPost['datePlanification']);      
            //var_dump($datePlanification);die;      
            $monPlanification = new Planification($datePlanification, $salle, $typeCours, $perso );
           // var_dump($monPlanification);die;
        }
        $this->em->persist($monPlanification);
        $this->em->flush();
        // On redirige vers la route de la liste des PLnning (code http 302 = redirection http)
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showplanification"))->withStatus(302);
    }  
}
