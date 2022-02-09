<?php
namespace App\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response as Response;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Routing\RouteContext;

class AdminMiddleware implements Middleware
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
  
    public function process(Request $request, RequestHandler $handler): Response
    {
      /*if (!isset($_SESSION['prenom'])) {
        die("Vous n'êtes pas connecté...");
    } elseif ($_SESSION['prenom'] != 'loic')
        die("Vous n'êtes pas loïc, vous ne pouvez pas vous connecter...");*/

       $response = $handler->handle($request);
      // Teste si l'utilisateur s'est déjà identifié.
      if (!isset($_SESSION['estlogger'])) {
        //die($this->container->get("router")->urlFor('app_login'));
        //die("stop");
        $response = new Response();
        return $response->withHeader('Location', $this->container->get("router")->urlFor('admin'))->withStatus(302);
      } else
          return $response; 
    }
}
