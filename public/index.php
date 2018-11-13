<?php
declare(strict_types=1);
session_start();

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = md5(uniqid((string)rand(), true));
}

require_once 'Model/functions.php';

if (isset($_GET['controller'])) {

    $home = false;

    $controllerDir = 'Controller/' . inputSanitizer($_GET['controller']) . '.php';
    $action = inputSanitizer($_GET['action']) . 'Action';

    if (file_exists($controllerDir)) {
        require_once $controllerDir;
        if (function_exists($action)) {
            $return = $action();
            $view =  ($return['dir'])? 'View/Page/' . $return['dir'] : 'View/Page/' . $return['view'] . '/' . $return['view'] . '.php';

            if(isset($return['redirect'])){
                header('Location: '. $return['redirect']);
            }
        } else {
            header('Location: /'); //todo: créer page '404 not found'
        }
    }
} else { // PAGE HOME
    $view = 'View/Page/home/home.php';
    require_once 'Controller/article.php';
    $return['params']['articles']= getArticles();
}

include 'view/template.php';
include 'view/Parts/toast.php';

//printer($return);


//TODO  :   ajouter auteur dans affichage d'un article
//TODO  :   convertir date des articles
//TODO  :   ajouter lien 'ajouter article'
//TODO  :   réparer toast de signin mauvais mot de passe
//TODO  :   upload image
//TODO  :   dynamiser les images
//TODO  :   pagination article