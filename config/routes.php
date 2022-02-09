<?php

use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\UserController;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\LoginMiddleware;
use App\Controllers\TypeSalleController;
use App\Controllers\SalleController;
use App\Controllers\PlanificationController;
use App\Controllers\AdhesionController;
use App\Controllers\ReservationController;

// login et création Clients
    $app->get('/signup',                UserController::class. ':signUp')               ->setName('signup');
    $app->get('/login',                 UserController::class. ':login')                ->setName('app_login');
    $app->get('/logout',                UserController::class. ':Logout')               ->setName('app_logout');
    $app->post('/auth',                 UserController::class. ':Auth')                 ->setName('app_auth');
    $app->post('/clientsave',           UserController::class. ':SaveClient')           ->setName('saveclient');

// admin login Personnel
    $app->get('/admin',                 AdminController::class. ':admin')               ->setName('admin');
    $app->get('/admin-logger',          AdminController::class. ':adminLogger')         ->setName('admin_logger');
    $app->get('/admin-logout',          AdminController::class. ':adminLogout')         ->setName('admin_logout');
    $app->post('/admin-auth',           AdminController::class. ':adminAuth')           ->setName('admin_auth');

// Redirige vers acceuil
    $app->get('/',                      HomeController::class. ':getHome')              ->setName('home');

// Route du Pojet 
    $app->get('/accueil',               HomeController::class. ':pageAccueil')          ->setName('pageAccueil'); 
    $app->get('/musculation',           HomeController::class. ':pageMusculation')      ->setName('pageMusculation'); 
    $app->get('/squash',                HomeController::class. ':pageSquash')           ->setName('pageSquash'); 
    $app->get('/gymnastique',           HomeController::class. ':pageGymnastique')      ->setName('pageGymnastique'); 
    $app->get('/coach',                 HomeController::class. ':pageCoach')            ->setName('pageCoach');  
    $app->get('/tarifs',                HomeController::class. ':pageTarifs')           ->setName('pageTarifs'); 

// Route pour les client connecter
$app->group('', function (Slim\Routing\RouteCollectorProxy $group) {
    $group->get('/accueil-client',                      HomeController::class. ':pageAccueil2')                 ->setName('pageaccueil2'); 
    $group->get('/musculation-client',                  HomeController::class. ':pageMusculation2')             ->setName('pagemusculation2'); 
    $group->get('/squash-client',                       HomeController::class. ':pageSquash2')                  ->setName('pagesquash2'); 
    $group->get('/gymnastique-client',                  HomeController::class. ':pageGymnastique2')             ->setName('pagegymnastique2'); 
    $group->get('/coach-client',                        HomeController::class. ':pageCoach2')                   ->setName('pagecoach2'); 
    $group->get('/cours-collectifs-client',             HomeController::class. ':pageCoursCollectif2')          ->setName('pagecourscollectif2'); 
    $group->get('/tarifs-client',                       HomeController::class. ':pageTarifs2')                  ->setName('pagetarifs2');
    $group->get('/showplanning',                        HomeController::class. ':showPlanning')                 ->setName('showplanning');
    $group->get('/showplanningcollectif',               HomeController::class. ':showPlanningCollectif')        ->setName('showplanningcollectif');
    $group->get('/showplanningsquash',                  HomeController::class. ':showPlanningSquash')           ->setName('showplanningsquash');
    $group->get('/showplanninggym',                     HomeController::class. ':showPlanningGym')              ->setName('showplanninggym');
    $group->get('/savereservation/{idPlanification}',   HomeController::class.':saveReservation')            ->setName('savereservation');
})->add(new loginMiddleware($container));

// Route groupée traitements administrateurs
$app->group('/admin', function (Slim\Routing\RouteCollectorProxy $group) {
     // gestion utilisateur
    $group->get('/showusers[/{NomClient}]',        AdminController::class.':showUsers')                     ->setName('showusers');
    $group->get('/usermodify/{id}',                AdminController::class.':ModifyUser')                    ->setName('modifyuser');
    $group->get('/userdelete/{id}',                AdminController::class.':DeleteUser')                    ->setName('deleteuser');
    $group->get('/usercreate',                     AdminController::class.':CreateUser')                    ->setName('createuser');
    $group->post('/usersave',                      AdminController::class.':SaveUser')                      ->setName('saveuser'); 
    // gestion Staff   
    $group->get('/showstaff[/{NomPerso}]',         AdminController::class.':showStaff')                     ->setName('showstaff');
    $group->get('/staffmodify/{id}',               AdminController::class.':ModifyStaff')                   ->setName('modifystaff');
    $group->get('/staffdelete/{id}',               AdminController::class.':DeleteStaff')                   ->setName('deletestaff');
    $group->get('/staffcreate',                    AdminController::class.':CreateStaff')                   ->setName('createstaff');
    $group->post('/staffsave',                     AdminController::class.':SaveStaff')                     ->setName('savestaff'); 
    // gestion des Types de salle
    $group->get('/showtypesalle',                  TypeSalleController::class.':showTypeSalle')             ->setName('showtypesalle');
    $group->get('/createtypesalle',                TypeSalleController::class.':createTypeSalle')           ->setName('createtypesalle');
    $group->get('/modifytypesalle/{id}',           TypeSalleController::class.':modifyTypeSalle')           ->setName('modifytypesalle');
    $group->get('/deletetypesalle/{id}',           TypeSalleController::class.':deleteTypeSalle')           ->setName('deletetypesalle');
    $group->post('/savetypesalle',                 TypeSalleController::class.':saveTypeSalle')             ->setName('savetypesalle');
    //gestion des salles
    $group->get('/showsalle',                      SalleController::class.':showSalle')                     ->setName('showsalle');
    $group->get('/createsalle',                    SalleController::class.':createSalle')                   ->setName('createsalle');
    $group->get('/modifysalle/{id}',               SalleController::class.':modifySalle')                   ->setName('modifysalle');
    $group->get('/deletesalle/{id}',               SalleController::class.':deleteSalle')                   ->setName('deletesalle');
    $group->post('/savesalle',                     SalleController::class.':saveSalle')                     ->setName('savesalle');
    //gestion Planification
    $group->get('/showplanification',              PlanificationController::class.':showPlanification')     ->setName('showplanification');
    $group->get('/createplanification',            PlanificationController::class.':createPlanification')   ->setName('createplanification');
    $group->get('/modifyplanification/{id}',       PlanificationController::class.':modifyPlanification')   ->setName('modifyplanification');
    $group->get('/deleteplanification/{id}',       PlanificationController::class.':deletePlanification')   ->setName('deleteplanification');
    $group->post('/saveplanification',             PlanificationController::class.':savePlanification')     ->setName('saveplanification'); 
    $group->get('/planificationapi/{datePlanification}', AdminController::class.':apiDatePlanning')         ->setName('planificationapi');
    // gestion des adhesions
    $group->get('/showadhesion',                   AdhesionController::class.':showAdhesion')               ->setName('showadhesion');
    $group->get('/createadhesion',                 AdhesionController::class.':createAdhesion')             ->setName('createadhesion');
    $group->get('/modifyadhesion/{id}',            AdhesionController::class.':modifyAdhesion')             ->setName('modifyadhesion');
    $group->get('/deleteadhesion/{id}',            AdhesionController::class.':deleteAdhesion')             ->setName('deleteadhesion');
    $group->post('/saveadhesion',                  AdhesionController::class.':saveAdhesion')               ->setName('saveadhesion');
    //gestion des reservations
    $group->get('/showreservation',                ReservationController::class.':showReservation')         ->setName('showreservation');    
    $group->get('/historiqueResa',                 ReservationController::class.':historiqueResa')           ->setName('historiqueResa');
  //  $group->get('/modifyreservation/{id}',         ReservationController::class.':modifyReservation')       ->setName('modifyreservation');
    $group->get('/deletereservation/{id}',         ReservationController::class.':deleteReservation')       ->setName('deletereservation');
    $group->post('/saveresa/{idPlanification}',    ReservationController::class.':saveResa')                ->setName('saveresa');
})->add(new AdminMiddleware($container));




// Route concernant la partie users
$app->get('/apiusers/{name}',       UserController::class.':apiUsers')          ->setName('apiusers');

// Accès à une image ou toute autre ressource hors de public via un contrôleur
$app->get('/accesspr/{name}',       UserController::class.':PrivateAccess')     ->setName('privateaccess');

// carousel
$app->get('/carousel[/{name}]',     UserController::class.':Carousel')          ->setName('carousel');

