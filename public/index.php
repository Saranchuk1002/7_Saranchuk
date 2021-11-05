<?php 
require_once '../vendor/autoload.php';
require_once "../controllers/MainController.php";
require_once "../controllers/CatController.php";
require_once "../controllers/CatImageController.php";
require_once "../controllers/CatInfoController.php";
require_once "../controllers/KidController.php";
require_once "../controllers/KidImageController.php";
require_once "../controllers/KidInfoController.php";
require_once "../controllers/Controller404.php";


$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader);
$url = $_SERVER["REQUEST_URI"];


$title ="";
$template = "";


$contex = [];
$controller = new Controller404($twig); // теперь 404 будут нашем контроллером по умолчанию





if ($url == "/"){

    $controller = new MainController($twig);
}   elseif (preg_match("#/cat#", $url)){

    $controller = new CatController($twig);


    if(preg_match("#^/cat/image#",$url)){
        $controller = new CatImageController($twig);


    } elseif (preg_match("#^/cat/info#",$url)){
      $controller = new CatInfoController($twig);
    }
}   elseif (preg_match("#/kid#",$url)) {
    $controller = new KidController($twig);

    if(preg_match("#^/kid/image#",$url)){
        $controller = new KidImageController($twig);


    } elseif (preg_match("#^/kid/info#",$url)){
      $controller = new KidInfoController($twig);
    }
}   

if($controller){
    $controller->get();
}