<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Entity\Salle;
use App\Entity\TypeSalle;
class SalleController extends Controller { 

  public function showSalle(RequestInterface $request, ResponseInterface $response){
    $Salles=$this->em->getRepository(Salle::class)->findAll();
    return $this->render($response, 'admin/showsalle.twig', ['salles' => $Salles]); 
  }
   /* 
        Formulaire de modification d'un usager par son ID
    */
    public function modifySalle(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur.
        $monSalle = $this->em->getRepository(Salle::class)->find($args['id']);

        // 2) On appelle la vue d'affichage et on lui passe les infos de l'utilisateur
        return $this->render($response, 'admin/createsalle.twig', ['Salle' => $monSalle, 'action' => 'Modifier']);
    }
    /* 
        Formulaire pour supprimmer d'un usager par son ID
    */
    public function deleteSalle(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur
        $monSalle = $this->em->getRepository(Salle::class)->find($args['id']);
        $this->em->remove($monSalle);
        $this->em->flush();

         // On redirige vers la route de la liste des Salles (code http 302 = redirection http)
         return $response->withHeader('Location', $this->container->get("router")->urlFor("showsalle"))->withStatus(302);
    }

    /*
        -> Fiche utilisateur à partir de non nom
    */
    public function createSalle(RequestInterface $request, ResponseInterface $response, $args)
    {
      $typeSalles=$this->em->getRepository(TypeSalle::class)->findAll();
        return $this->render($response, 'admin/createsalle.twig', ['salle' => null,'typeSalles'=>$typeSalles, 'action' => 'Créer']);
    }

    /* 
        Formulaire de modification d'un usager par son ID
    */
    public function saveSalle(RequestInterface $request, ResponseInterface $response)
    {
        // 1) On récupère les données de saisie...
        $dataPost = $request->getParsedBody();
        $typeSalle = $this->em->getRepository(TypeSalle::class)->find($dataPost['typeSalleId']);
         // 2) On regarde si on est en création ou en modification
        if ($dataPost['id']) { // en Modification
            $monSalle = $this->em->getRepository(Salle::class)->find($dataPost['id']);
            $monSalle->setNomSalle($dataPost['nomSalle']);
            $monSalle->setTypeSalle($typeSalleId);
            

        } else { // en Création
            $monSalle = new Salle($dataPost['nomSalle'], $typeSalle);
        }
        
        $this->em->persist($monSalle);
        $this->em->flush();

        // On redirige vers la route de la liste des Salles (code http 302 = redirection http)
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showsalle"))->withStatus(302);
    }

  

 

  
}


