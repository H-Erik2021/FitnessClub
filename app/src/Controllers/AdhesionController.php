<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Entity\Adhesion;
use App\Entity\Formule;
use App\Entity\User;
use App\Entity\Casier;
use DateTime;

class AdhesionController extends Controller { 

  public function showAdhesion(RequestInterface $request, ResponseInterface $response){
    $adhesions = $this->em->getRepository(Adhesion::class)->findAll();//var_dump($adhesions);die;
    return $this->render($response, 'admin/showadhesion.twig', ['adhesions' => $adhesions]); 
  }

   /* 
        Formulaire de modification d'une adhesion par son ID
    */
    public function modifyAdhesion(RequestInterface $request, ResponseInterface $response, $args)
    {
        $formules=$this->em->getRepository(Formule::class)->findAll();              
        $clients=$this->em->getRepository(User::class)->findAll();
        $casiers = $this->em->getRepository(Casier::class)->findAll();
        
        // 1) On récupère le planning.
        $monAdhesion = $this->em->getRepository(Adhesion::class)->find($args['id']);//var_dump($monAdhesion);die;
        
        // 2) On appelle la vue d'affichage et on lui passe les infos de l'utilisateur
        return $this->render($response, 'admin/createadhesion.twig', ['adhesion' => $monAdhesion, 'formules'=>$formules,'clients'=>$clients,'casiers'=>$casiers,  'action' => 'Modifier']);
    }
    
    /* 
        Formulaire pour supprimmer un Planning par son ID
    */
    public function deleteAdhesion(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur
        $monAdhesion = $this->em->getRepository(Adhesion::class)->find($args['id']);
        $this->em->remove($monAdhesion);
        $this->em->flush();

         // On redirige vers la route de la liste des planning (code http 302 = redirection http)
         return $response->withHeader('Location', $this->container->get("router")->urlFor("showadhesion"))->withStatus(302);
    }

    /*
        -> Fiche adhesion à partir de nom
    */
    public function createAdhesion(RequestInterface $request, ResponseInterface $response, $args)
    {        
        $formules=$this->em->getRepository(Formule::class)->findAll();       
        $clients=$this->em->getRepository(User::class)->findAll();
        $casiers=$this->em->getRepository(Casier::class)->findAll();
        
        //var_dump($casiers);die;
        return $this->render($response, 'admin/createadhesion.twig', ['adhesions' => null, 'formules'=>$formules, 'clients'=>$clients, 'casiers'=>$casiers,  'action' => 'Créer']);
    }

    /* 
        Formulaire de modification d'une adhesion par son ID
    */
    public function saveAdhesion(RequestInterface $request, ResponseInterface $response)
    {
        // 1) On récupère les données de saisie...
        $dataPost = $request->getParsedBody();//var_dump($dataPost);die;
        $formules = $this->em->getRepository(Formule::class)->find($dataPost['formuleId']);       
        $clients = $this->em->getRepository(User::class)->find($dataPost['clientId']);
        $casiers = $this->em->getRepository(Casier::class)->find($dataPost['casierId']);
     
       //var_dump($dataPost);die;
         
        // 2) On regarde si on est en création ou en modification
        if ($dataPost['id']) { // en Modification
            $monAdhesion = $this->em->getRepository(Adhesion::class)->find($dataPost['id']);
            $monAdhesion->setFormule($formules); 
            $monAdhesion->setDureeAdhesion($dataPost['dureeAdhesion']); 
            $monAdhesion->setDateAdhesion(new \DateTime($dataPost['dateAdhesion']));           
            $monAdhesion->setTarifAdhesion($dataPost['tarifAdhesion']);           
            $monAdhesion->setClient($clients);
            $monAdhesion->setCasier($casiers);  
             
           
        //var_dump($monAdhesion);die;
        } else { // en Création
            $dateAdhesions = new \DateTime($dataPost['dateAdhesion']);      
        //var_dump($dateAdhesions);die;      
            $monAdhesion = new Adhesion($formules, $dataPost['dureeAdhesion'], $dateAdhesions, $dataPost['tarifAdhesion'], $clients, $casiers);
        //var_dump($monAdhesion);die;
        }
        $this->em->persist($monAdhesion);
        $this->em->flush();
        // On redirige vers la route de la liste des adhesions (code http 302 = redirection http)
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showadhesion"))->withStatus(302);
    }  
}
