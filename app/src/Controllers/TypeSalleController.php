<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Entity\TypeSalle;

class TypeSalleController extends Controller { 

  public function showTypeSalle(RequestInterface $request, ResponseInterface $response){
    $typeSalles=$this->em->getRepository(TypeSalle::class)->findAll();
    return $this->render($response, 'admin/showtypesalle.twig', ['typeSalles' => $typeSalles]); 
  }
   /* 
        Formulaire de modification d'un usager par son ID
    */
    public function modifyTypeSalle(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur.
        $monTypeSalle = $this->em->getRepository(TypeSalle::class)->find($args['id']);

        // 2) On appelle la vue d'affichage et on lui passe les infos de l'utilisateur
        return $this->render($response, 'admin/createtypesalle.twig', ['typeSalle' => $monTypeSalle, 'action' => 'Modifier']);
    }
    /* 
        Formulaire pour supprimmer d'un usager par son ID
    */
    public function deleteTypeSalle(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur
        $monTypeSalle = $this->em->getRepository(TypeSalle::class)->find($args['id']);
        $this->em->remove($monTypeSalle);
        $this->em->flush();

         // On redirige vers la route de la liste des TypeSalles (code http 302 = redirection http)
         return $response->withHeader('Location', $this->container->get("router")->urlFor("showtypesalle"))->withStatus(302);
    }

    /*
        -> Fiche utilisateur à partir de non nom
    */
    public function createTypeSalle(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'admin/createtypesalle.twig', ['typeSalle' => null, 'action' => 'Créer']);
    }

    /* 
        Formulaire de modification d'un usager par son ID
    */
    public function saveTypeSalle(RequestInterface $request, ResponseInterface $response)
    {
        // 1) On récupère les données de saisie...
        $dataPost = $request->getParsedBody();
        
        // 2) On regarde si on est en création ou en modification
        if ($dataPost['id']) { // en Modification
            $monTypeSalle = $this->em->getRepository(TypeSalle::class)->find($dataPost['id']);
            $monTypeSalle->setNomTypeSalle($dataPost['nomTypeSalle']);
            

        } else { // en Création
            $monTypeSalle = new TypeSalle($dataPost['nomTypeSalle']);
        }
        
        $this->em->persist($monTypeSalle);
        $this->em->flush();

        // On redirige vers la route de la liste des TypeSalles (code http 302 = redirection http)
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showtypesalle"))->withStatus(302);
    }  
}
