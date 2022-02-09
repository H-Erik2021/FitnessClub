<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use App\Entity\User;
use App\Entity\User2;
use App\Entity\Hash;

class UserController extends Controller
{  
  /*
      -> Formulaire de création de nouveau utilisateur.
  */
  public function signUp(RequestInterface $request, ResponseInterface $response, $args)
  {
      return $this->render($response, 'user/signup.twig', ['user' => null, 'action' => 'Création de compte']);    
  }

  /* 
      Formulaire création d'un client
  */
  public function SaveClient(RequestInterface $request, ResponseInterface $response)
  {
      // 1) On récupère les données de saisie...
      $dataPost = $request->getParsedBody();
      // 2) On Créer un nouvelle utilisateur
      if(!empty($dataPost['Login'] && !empty($dataPost['Password']) && !empty($dataPost['Password2']))) {
          if($dataPost['Password'] == $dataPost['Password2']) {            
            try {
              //prepare hash
              $options = ['cost' => 12,];
              $hashpass= password_hash($dataPost['Password'], PASSWORD_BCRYPT, $options);             
              // $pass = password_hash($dataPost['Password'], PASSWORD_DEFAULT);
          //insert data into database
              $monUser = new User2($dataPost['NomClient'],$dataPost['PrenomClient'],$dataPost['MailClient'],$dataPost['Login'], $hashpass);
              //$monUser = new User2($dataPost['NomClient'],$dataPost['PrenomClient'],$dataPost['MailClient'],$dataPost['Login'],$dataPost['Password']);
              $this->em->persist($monUser);
              $this->em->flush();
                  
          //redirige page login
            return $response->withHeader('Location', $this->container->get("router")->urlFor("app_login"))->withStatus(302);
            } catch (PDOException $e) {
                $this->logger->error($e->getMessage());
                $tplVars['message'] = 'Database error.';
                $tplVars['form'] = $dataPost;
            }
          } else {
              $tplVars['message'] = 'les mots de passe ne corresponde pas';
              $tplVars['form'] = $dataPost;
          }
      }
      return $this->view->render($response, 'layout.twig', $tplVars);
  }    

  // PARTIE AUTHENTIFICATION //

  // Affichage page login
  public function login(RequestInterface $request, ResponseInterface $response, $args)
  {
    return $this->render($response, 'login.twig');
  }

  // Vérification authentification
  public function Auth(RequestInterface $request, ResponseInterface $response, $args)
  {
    $ver_log=$this->verif_auth($request->getParsedBody()['x_login'],$request->getParsedBody()['x_pword'], $this);
    $this->logger->info($ver_log. " --- ".$request->getParsedBody()['x_login']);  // storage/logs/app.log
    if (!$ver_log) {
      $this->alert(["Usager inconnu ou mot de passe invalide..."], 'danger');
      $response = $response->withHeader("Location", "/login");
    } else {
            /*// On renvoie vers la page interceptée par le Middleware
            if (array_key_exists('estlogge', $_SESSION) ) {
            $vers=$_SESSION['provient'.getenv('CLEF_APP')];
            unset($_SESSION['provient'.getenv('CLEF_APP')]);
            die("Vers : ".$vers);
                if ($vers == "auth")
                $vers="";
            } else
                $vers="/accueil2";{*/                  
      $response = $response->withHeader('Location', '/accueil-client', 301);
    }
    
    return $response;
  }

  // // Fonction de contrôle de validité de l'authentification
  private function verif_auth($lg, $pw, $connexion)
  {
    // Récupération de la liste des utilisateurs
    $requete = $connexion->pdo->prepare("SELECT NumClient, NomClient, PrenomClient, Login, Password FROM client WHERE Login = ?");
    $requete->execute([$lg]);
    $users = $requete->fetch();
    $Validation = password_verify($pw, $users['Password']);
      if (isset($users['Password']) && $pw==$users['Password'] || $Validation)
        {
        $_SESSION['estlogge']="1";
        $_SESSION['user']=$lg;
        $_SESSION['NomClient']=$users['NomClient'];
        $_SESSION['PrenomClient']=$users['PrenomClient'];  
        $_SESSION['NumClient']=$users['NumClient'];
        return true;
        }
      else return false;
  }
  
  // Déconnexion
  public function Logout(RequestInterface $request, ResponseInterface $response, $args)
  {
    if (array_key_exists('estlogge', $_SESSION))
      {
      unset($_SESSION['estlogge']);
      $_SESSION['user']="";
      $_SESSION['NumClient']="";
      }

    $response = $response->withHeader('Location', '/', 301);
    return $response;
  }
}
