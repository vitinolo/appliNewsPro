<!--index.php-->
<?php session_start();
if (!isset($_SESSION["prenom"])) {
    $_SESSION["prenom"] = '';
}
if (!isset($_SESSION["nom"])) {
    $_SESSION["nom"] = '';
}
if (!isset($_SESSION["role"])) {
    $_SESSION["role"] = '';
}

//0. appel du fichier base.php
require_once 'asset/base.php';

//1. inclure le fichier de connexion a la base de donnée
require_once 'config/connexion/connexion.php';
//require_once 'config/connexion/deconnexion.php';

//2. inclure les classes controllers
require_once 'src/controllers/NewsController.php';

//3. inclure les classes models
require_once 'src/models/NewsModel.php';

//4. instancier le ou les différents controllers
$newsController = new NewsController($db);

//4.1 incorporer le header
require_once 'templates/elements/header.php';

//5. verification de l'action dans l'url
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'showAllNews'; //action par defaut
}

//6. execution des actions
switch ($action) {
    case 'showAllNews':
        $newsController->showAllNews();
        break;
    case 'showSingleNews':
        if (isset($_GET['id'])) {
            $newsId = $_GET['id'];
            $newsController->showSingleNews($newsId);
        } else {
            //rediriger ou afficher un message d'erreur
            echo "erreur lors de l'affichage ";
        }
        break;
    case 'showAllSportNews':
        $newsController->showAllSportNews();
        break;
    case 'showAllCuisineNews':
        $newsController->showAllCuisineNews();
        break;
    case 'showAllVoyageNews':
        $newsController->showAllVoyageNews();
        break;
    case 'showAllCultureNews':
        $newsController->showAllCultureNews();
        break;
    case 'showAllCinemaNews':
        $newsController->showAllCinemaNews();
        break;
    default:
        break;
}
//6.1 incorporer le footer
require_once 'templates/elements/footer.php';
