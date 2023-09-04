<!--index.php-->
<?php
//0. appel du fichier base.php (link)
require_once 'asset/base.php';
//1. inclure le fichier de connexion a la base de donnée
require_once 'config/connexion/connexion.php';
//2. inclure les classes controllers
require_once 'src/controllers/NewsController.php';
require_once 'src/controllers/UserController.php';
//3. inclure les classes models
require_once 'src/models/NewsModel.php';
require_once 'src/models/UserModel.php';
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
    case 'deleteNews':
        if (isset($_GET['id'])) {
            $newsId = $_GET['id'];
            $newsController->deleteNews($newsId);
        } else {
            //rediriger ou afficher un message d'erreur
            echo "impossible de supprimer la news ";
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
    case 'showAllUsers':
        $userController->showAllUsers();
        break;
    default:
        break;
}
//6.1 incorporer le footer
require_once 'templates/elements/footer.php';
