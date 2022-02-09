<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Entity\User;
use App\Entity\Staff;
use App\Entity\Fonction;
use App\Entity\Planification;
use App\Entity\Salle;
use App\Entity\TypeCours;

class AdminController extends Controller
{
//
// PARTIE DES CLIENTS 
//
    /* 
        Formulaire de modification d'un usager par son ID
    */
    public function ModifyUser(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur.
        $monUser = $this->em->getRepository(User::class)->queryGetUserById($args['id']);

        // 2) On appelle la vue d'affichage et on lui passe les infos de l'utilisateur
        return $this->render($response, 'user/show.twig', ['user' => $monUser, 'action' => 'Modifier']);
    }
    /* 
        Formulaire pour supprimmer d'un usager par son ID
    */
    public function DeleteUser(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur
        $monUser = $this->em->getRepository(User::class)->queryGetUserById($args['id']);
        $this->em->remove($monUser);
        $this->em->flush();

         // On redirige vers la route de la liste des users (code http 302 = redirection http)
         return $response->withHeader('Location', $this->container->get("router")->urlFor("showusers"))->withStatus(302);
    }

    /*
        -> Fiche utilisateur à partir de non nom
    */
    public function CreateUser(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'user/show.twig', ['user' => null, 'action' => 'Créer']);
    }

    /* 
        Formulaire de modification d'un usager par son ID
    */
    public function SaveUser(RequestInterface $request, ResponseInterface $response)
    {
        // 1) On récupère les données de saisie...
        $dataPost = $request->getParsedBody();
        // 2) On regarde si on est en création ou en modification
        if ($dataPost['id']) { // en Modification
            $monUser = $this->em->getRepository(User::class)->queryGetUserById($dataPost['id']);
            $monUser->setNomClient($dataPost['NomClient']);
            $monUser->setPrenomClient($dataPost['PrenomClient']);
            $monUser->setAdresseClient($dataPost['AdresseClient']);
            $monUser->setTelClient($dataPost['TelClient']);
            $monUser->setMailClient($dataPost['MailClient']);
            $monUser->setLogin($dataPost['Login']);
            $monUser->setPassword($dataPost['Password']);

        } else { // en Création
            
            //prepare hash
            $options = ['cost' => 12,];
            $hashpass= password_hash($dataPost['Password'], PASSWORD_BCRYPT, $options);             
            //insert data into database
            $monUser = new User($dataPost['NomClient'],$dataPost['PrenomClient'],$dataPost['AdresseClient'],$dataPost['TelClient'],$dataPost['MailClient'],$dataPost['Login'],$hashpass);        
        }
        $this->em->persist($monUser);
        $this->em->flush();
         // On redirige vers la route de la liste des clients (code http 302 = redirection http)
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showusers"))->withStatus(302);
    }

    /*
        -> Liste des utilisateurs sur la base d'une partie de leur nom
    */
    public function showUsers(RequestInterface $request, ResponseInterface $response, $args)
    {
        $nomfourni = @$args['NomClient'];
        if (isset($nomfourni))
            return $this->render($response, 'pages/showusers.twig', ['users' => $this->em->getRepository(User::class)->queryGetUsersByPartialNomClient($nomfourni)]);
        else
            return $this->render($response, 'pages/showusers.twig', ['users' => $this->em->getRepository(User::class)->queryGetUsers()]);
    }
//
// PARTIE DU PERSONNEL 
//
    /* 
        Formulaire de modification d'un usager par son ID
    */
    public function ModifyStaff(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur.
        $listeRangs = $this->em->getRepository(Fonction::class)->queryGetFonctions();
        $monUser = $this->em->getRepository(Staff::class)->queryGetUserById($args['id']);

        // 2) On appelle la vue d'affichage et on lui passe les infos de l'utilisateur
        return $this->render($response, 'user/show2.twig', ['user' => $monUser, 'fonctions' => $listeRangs, 'action' => 'Modifier']);
    }
    /* 
        Formulaire pour supprimmer d'un usager par son ID
    */
    public function DeleteStaff(RequestInterface $request, ResponseInterface $response, $args)
    {
        // 1) On récupère l'utilisateur
        $monUser = $this->em->getRepository(Staff::class)->queryGetUserById($args['id']);
        $this->em->remove($monUser);
        $this->em->flush();

         // On redirige vers la route de la liste des users (code http 302 = redirection http)
         return $response->withHeader('Location', $this->container->get("router")->urlFor("showstaff"))->withStatus(302);
    }

    /*
        -> Fiche utilisateur à partir de non nom
    */
    public function CreateStaff(RequestInterface $request, ResponseInterface $response, $args)
    {
        $listeRangs = $this->em->getRepository(Fonction::class)->queryGetFonctions();
        return $this->render($response, 'user/show2.twig', ['user' => null, 'fonctions' => $listeRangs, 'action' => 'Créer']);
    }

    /* 
        Formulaire de modification d'un usager par son ID
    */
    public function SaveStaff(RequestInterface $request, ResponseInterface $response)
    {
        // 1) On récupère les données de saisie...
        $dataPost = $request->getParsedBody();
        // 2) On regarde si on est en création ou en modification
        if ($dataPost['id']) { // en Modification
            $monUser = $this->em->getRepository(Staff::class)->queryGetUserById($dataPost['id']);
            $monUser->setNomPerso($dataPost['NomPerso']);
            $monUser->setPrenomPerso($dataPost['PrenomPerso']);
            $monUser->setAdressePerso($dataPost['AdressePerso']);
            $monUser->setTelPerso($dataPost['TelPerso']);
            $monUser->setMailPerso($dataPost['MailPerso']);
            $monUser->setPassword($dataPost['Password']);
            $monUser->setFonction($this->em->getRepository(Fonction::class)->queryGetFonctionById($dataPost['IdFonction']));

        } else { // en Création
            //prepare hash
            $options = ['cost' => 12,];
            $hashpass= password_hash($dataPost['Password'], PASSWORD_BCRYPT, $options);      
            $monUser = new Staff($dataPost['NomPerso'],$dataPost['PrenomPerso'],$dataPost['AdressePerso'],$dataPost['TelPerso'],$dataPost['MailPerso'],$hashpass, $this->em->getRepository(Fonction::class)->queryGetFonctionById($dataPost['IdFonction']));
        }
        $this->em->persist($monUser);
        $this->em->flush();

        // On redirige vers la route de la liste du personnel (code http 302 = redirection http)
        return $response->withHeader('Location', $this->container->get("router")->urlFor("showstaff"))->withStatus(302);
    }

    /*
        -> Liste des utilisateurs sur la base d'une partie de leur nom
    */
    public function showStaff(RequestInterface $request, ResponseInterface $response, $args)
    {
        $nomfourni = @$args['NomPerso'];
        if (isset($nomfourni))
            return $this->render($response, 'pages/showstaff.twig', ['users' => $this->em->getRepository(Staff::class)->queryGetUsersByPartialNomPerso($nomfourni)]);
        else
            return $this->render($response, 'pages/showstaff.twig', ['users' => $this->em->getRepository(Staff::class)->queryGetUsers()]);
    }

    // PARTIE AUTHENTIFICATION //

    // Affichage page admin login
    public function admin(RequestInterface $request, ResponseInterface $response, $args)
     {
     return $this->render($response, 'admin_login.twig');
    }

    // Affichage page admin login logger
    public function adminLogger(RequestInterface $request, ResponseInterface $response, $args)
    {
        return $this->render($response, 'admin_logger.twig');
    }

  // Vérification authentification
  public function adminAuth(RequestInterface $request, ResponseInterface $response, $args)
  {
    $ver_log=$this->verif_auth($request->getParsedBody()['x_login'],$request->getParsedBody()['x_pword'], $this);
    $this->logger->info($ver_log. " --- ".$request->getParsedBody()['x_login']); // storage/logs/app.log
    if (!$ver_log) {
      $this->alert(["Usager inconnu ou mot de passe invalide..."], 'danger');
      $response = $response->withHeader('Location', "/admin");
    } else {
        // On renvoie vers la page interceptée par le Middleware
        if (array_key_exists('IdFonction', $_SESSION) ) {
        $vers=$_SESSION['IdFonction'];
        unset($_SESSION['IdFonction']);
        
	      if ($vers == "1") {
             $vers="/admin/showstaff";
          }else{
            $this->alert(["Attention vous n'avait pas les droits d'administrateur."], 'danger');
           $vers="/admin";
          }
      }

      $response = $response->withHeader('Location', $vers, 301);
    }
    return $response;
  }

  // // Fonction de contrôle de validité de l'authentification
  private function verif_auth($lg, $pw, $connexion)
  {
    // Récupération de la liste des utilisateurs
    $requete = $connexion->pdo->prepare("SELECT NumPerso, MailPerso, Password, IdFonction FROM personnel WHERE MailPerso = ?" );
    $requete->execute([$lg,]);
    $users = $requete->fetch();
    $Validation = password_verify($pw, $users['Password']);
      if (isset($users['Password']) && $pw==$users['Password'] || $Validation)
        {
        $_SESSION['estlogger']="1";
        $_SESSION['user']=$lg;
        $_SESSION['NumPerso']=$users['NumPerso'];
        $_SESSION['IdFonction']=$users['IdFonction'];
        return true;
        }
      else return false;
  }
  
  // Déconnexion
  public function adminLogout(RequestInterface $request, ResponseInterface $response, $args)
  {
    if (array_key_exists('estlogger', $_SESSION))
      {
      unset($_SESSION['estlogger']);
      $_SESSION['user']="";
      $_SESSION['NumPerso']="";
      }

    $response = $response->withHeader('Location', '/admin', 301);
    return $response;
  }

    /*
        -> Api renvoyant les utilisateurs sur la base d'une partie de leur nom
    */
    public function apiDatePlanning(RequestInterface $request, ResponseInterface $response, $args)
    {
        $date = $args['datePlanification'];
        $listeDates = $this->em->getRepository(Planification::class)->queryGetDatesByPartialDatePlanification($date);

        $tableau=[];
        foreach($listeDates as $date) {
            $tableau[] = [ 'id' => $date->getId(), 'datePlanification' => $date->getDatePlanification(), 'NomSalle' => $date->getSalle()->getNomSalle(), 'NomTypeCours' => $date->getTypeCours()->getNomTypeCours(),'DureeCours' => $date->getTypeCours()->getDureeCours(), 'NomPerso'=> $date->getPerso()->getNomPerso() ];
        }
        $response->getBody()->write(json_encode($tableau));
        
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
    
    /*
        -> Liste des utilisateurs dynamique en ajax via une api
    */
    public function showUsersApi(RequestInterface $request, ResponseInterface $response)
    {
        return $this->render($response, 'pages/showusersapi.twig');
    }
    /*
        -> Carousel des photos des utilisateurs filtrée éventuellement sur la base d'une partie de leur nom
    */
    public function Carousel(RequestInterface $request, ResponseInterface $response, $args)
    {
        $nomfourni = @$args['name'];
        if (isset($nomfourni))
            return $this->render($response, 'pages/musculation.twig', ['users' => $this->em->getRepository(User::class)->queryGetUsersByPartialNomClient($nomfourni)]);
        else
            return $this->render($response, 'pages/musculation.twig', ['users' => $this->em->getRepository(User::class)->queryGetUsers()]);
    }
}

