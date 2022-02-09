<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Twig\Extensions\IntlDateFormatter;
use Twig\Extensions\DateExtension;
use Twig\Extensions\IntlExtension;
use App\Entity\Planification;
use App\Entity\User;
use App\Entity\Reservation;
use App\Entity\TypeCours;
use App\Entity\Salle;
use App\Entity\Fonction;
use App\Entity\Staff; 
use Snilius\Twig\SortByFieldExtension;
use DateTime;

class ReservationController extends Controller {

  public function historiqueResa(RequestInterface $request, ResponseInterface $response)
  {
    $reservations = $this->em->getRepository(Reservation::class)->findAll();
    
    return $this->render($response, 'admin/historiqueResa.twig', ['reservations' => $reservations]); 
  }
 
   /* 
        Formulaire de modification d'une reservation par son ID
    */
    public function modifyReservation(RequestInterface $request, ResponseInterface $response, $args)
    {       
        $plannings=$this->em->getRepository(Reservation::class)->findAll();//var_dump($plannings);die;
        $client=$this->em->getRepository(User::class)->findAll();//var_dump($client);die;       
        // 1) On récupère la reservation
        $monReservation = $this->em->getRepository(Reservation::class)->find($args['id']);
        //var_dump($monReservation);die;
        // 2) On appelle la vue d'affichage et on lui passe les infos de l'utilisateur
        return $this->render($response, 'admin/createreservation.twig', ['Reservation' => $monReservation,'plannings'=>$plannings,'client'=>$client, 'action' => 'Modifier']);
    }
    /* 
        Formulaire pour supprimmer un Planning par son ID
    */
    public function deleteReservation(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur
        $monReservation = $this->em->getRepository(Reservation::class)->find($args['id']);
        $this->em->remove($monReservation);
        $this->em->flush();

         // On redirige vers la route de la liste des planning (code http 302 = redirection http)
         return $response->withHeader('Location', $this->container->get("router")->urlFor("showreservation"))->withStatus(302);
    }

    /*
        -> Fiche planning à partir de non nom
    */
    public function showReservation(RequestInterface $request, ResponseInterface $response, $args)
    {
        $clients=$this->em->getRepository(User::class)->findAll();
        $planifications = $this->em->getRepository(Planification::class)->findAfterDateOfTheDay2();
    return $this->render($response, 'admin/showreservation.twig', ['planifications' => $planifications,'clients'=>$clients, 'action' => 'Creation des réservations']); 
        
    }

    public function saveResa(RequestInterface $request, ResponseInterface $response, $param)
    {
       
        // 1) On récupère les données de saisie...
       // $id=intval($idPlanification[1]);
        $dataPost = $request->getParsedBody();//var_dump($dataPost);die;
        $dataGetclient = $dataPost['clientId'];
        $client=$this->em->getRepository(User::class)->find($dataGetclient);

        $planification=$this->em->getRepository(Planification::class)->find($param['idPlanification']);
        //var_dump($planification);die;
        $monReservation = new Reservation( $planification, $client );
        
        $this->em->persist($monReservation);
        $this->em->flush();
        // On redirige vers la route de la liste des Reservation (code http 302 = redirection http)
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showreservation"))->withStatus(302);
    }  

         
    

}
