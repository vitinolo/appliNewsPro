<!--index.php-->
<?php session_start();


//0. appel du fichier base.php (link)
require_once 'asset/base.php';

//1. inclure le fichier de connexion a la base de donnée
require_once 'config/connexion/connexion.php';

//5. verification de l'action dans l'url
if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'showAllNews'; //action par defaut
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Dashboard News Application</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <?php if ($_SESSION['role'] === 'editor') : ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>News</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">MySql Components:</h6>
                            <a class="collapse-item" href="getAllNews.php">Voir tous les articles</a>
                            <a class="collapse-item" data-bs-toggle="modal" data-bs-target="#exampleModal3">Ajouter un article</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <?php if ($_SESSION['role'] === 'admin') : ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>News</span>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">MySql Components:</h6>
                            <a class="collapse-item" href="getAllNews.php">Voir tous les articles</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Users</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">MySql Components:</h6>
                            <a class="collapse-item" href="getAllUsers.php">Voir tous les utilisateurs</a>
                        </div>
                    </div>
                </li>
            <?php endif; ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <div class="row">
                    <!--bouton de retour accueil-->
                    <div class="col-md-4 mt-1 d-flex justify-content-center d-flex align-items-center" title="Retour accueil">
                        <a href="../../index.php" aria-label="retour accueil">
                            <i class="fa-solid fa-house fa-xl" style="color:black;"></i>
                        </a>
                    </div>
                    <!--titre-->
                    <div class="col-md-4 titreAp">
                        <h1 class="mb-2 d-flex justify-content-center" title="Home"><a href="index.php" style="color:red;text-decoration:none;" aria-label="retour vers accueil">Dashboard</a></h1>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="row identiteUser mt-2" style="color:black;justify-content:center;">
                            Bonjour <?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?> !
                        </div>
                    </div>
                </div>
                <?php if (isset($_SESSION['id'])) : ?>
                    <?php if ($_SESSION['role'] === 'editor') : ?>
                        <!-- Content Row1 -->
                        <div class="row">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tables news</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Titre</th>
                                                    <th>Abstract</th>
                                                    <th>Image</th>
                                                    <th>Rubrik</th>
                                                    <th>Auteur</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Code PHP pour récupérer les 5 dernières news depuis la base de données
                                                try {
                                                    $sql = "SELECT id, titre, abstract, auteur, rubrik, image, date FROM news  ORDER BY date DESC LIMIT 5";
                                                    $stmt = $db->query($sql);
                                                    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($articles as $article) {
                                                        echo '<tr>';
                                                        echo '<td>' . $article['id'] . '</td>';
                                                        echo '<td>' . $article['titre'] . '</td>';
                                                        echo '<td class="abstract-cell" style="text-align:justify;">' . $article['abstract'] . '</td>';
                                                        echo '<td><div><img src="../../asset/images/' . $article['image'] . '" alt="Image" width="100" height="60"></div><div>' . $article['image'] . '</div></td>';
                                                        echo '<td>' . $article['rubrik'] . '</td>';
                                                        echo '<td>' . $article['auteur'] . '</td>';
                                                        echo '<td>' . $article['date'] . '</td>';              
                                                        echo '</tr>';
                                                    }
                                                } catch (PDOException $e) {
                                                    echo "Erreur : " . $e->getMessage();
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal pour ajouter un article-->
                        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un article</h1>

                                    </div>
                                    <div class="modal-body">
                                        <!----------------ajouter un article------------------------------->
                                        <form id="adArticle" class="adArticle mt-0 hide show" method="POST" action="createArticle.php">
                                            <!----------titre-------->
                                            <label for="titre">Titre</label>
                                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="titre" id="title" placeholder="titre" minlength="4" maxlength="200" required></textarea>
                                            <!--abstract-->
                                            <label for="article">Article</label>
                                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="abstract" id="abstract" placeholder="article" minlength="4" maxlength="400" required></textarea>
                                            <!--auteur-->
                                            <label for="auteur">Auteur</label>
                                            <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="auteur" id="auteur" placeholder="auteur" minlength="2" maxlength="50" required></input>
                                            <!--rubrik-->
                                            <label for="rubrik">Choisir une rubrique:</label>
                                            <select class="form-control" id="rubrik" name="rubrik" required>
                                                <option value="">--Please choose an option--</option>
                                                <option value="sports">Sports</option>
                                                <option value="cuisine">Cuisine</option>
                                                <option value="voyages">Voyage</option>
                                                <option value="culture">Culture</option>
                                                <option value="cinema">Cinema</option>
                                            </select><br>
                                            <!--------image------->
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control-sm mb-2 d-flex flex-column" name="image" id="image" placeholder="image" accept="image/png, image/jpeg" required>
                                            <!---------submit--------->
                                            <input aria-label="ajouter un article" type="submit" id="ajouter" class="btn btn-success" name="ajouter" value="Ajouter">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($_SESSION['role'] === 'admin') : ?>
                        <!-- Content Row -->
                        <div class="row">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tables news</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>id</th>
                                                    <th>Titre</th>
                                                    <th>Abstract</th>
                                                    <th>Image</th>
                                                    <th>Rubrik</th>
                                                    <th>Auteur</th>
                                                    <th>Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Code PHP pour récupérer les 5 dernières news depuis la base de données
                                                try {
                                                    $sql = "SELECT id, titre, abstract, auteur, rubrik, image, date FROM news  ORDER BY date DESC LIMIT 5";
                                                    $stmt = $db->query($sql);
                                                    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                    foreach ($articles as $article) {
                                                        echo '<tr>';
                                                        echo '<td>' . $article['id'] . '</td>';
                                                        echo '<td>' . $article['titre'] . '</td>';
                                                        echo '<td class="abstract-cell" style="text-align:justify;">' . $article['abstract'] . '</td>';
                                                        echo '<td><div><img src="../../asset/images/' . $article['image'] . '" alt="Image" width="100" height="60"></div><div>' . $article['image'] . '</div></td>';
                                                        echo '<td>' . $article['rubrik'] . '</td>';
                                                        echo '<td>' . $article['auteur'] . '</td>';
                                                        echo '<td>' . $article['date'] . '</td>';
                                                        echo '</tr>';
                                                    }
                                                } catch (PDOException $e) {
                                                    echo "Erreur : " . $e->getMessage();
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal pour modifier un article-->
                        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier un article</h1>

                                    </div>
                                    <div class="modal-body">
                                        <!----------------modifier un article------------------------------->
                                        <form id="adArticle" class="adArticle mt-0 hide show" method="POST" action="./updateArticle.php">
                                            <!----------titre-------->
                                            <label for="titre">Titre</label>
                                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="titre" id="title" placeholder="titre" minlength="4" maxlength="200" required></textarea>
                                            <!--abstract-->
                                            <label for="article">Article</label>
                                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="abstract" id="abstract" placeholder="article" minlength="4" maxlength="400" required></textarea>
                                            <!--auteur-->
                                            <label for="auteur">Auteur</label>
                                            <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="auteur" id="auteur" placeholder="auteur" minlength="2" maxlength="50" required></input>
                                            <!--rubrik-->
                                            <label for="rubrik">Choisir une rubrique:</label>
                                            <select class="form-control" id="rubrik" name="rubrik" required>
                                                <option value="">--Please choose an option--</option>
                                                <option value="sports">Sports</option>
                                                <option value="cuisine">Cuisine</option>
                                                <option value="voyages">Voyage</option>
                                                <option value="culture">Culture</option>
                                                <option value="cinema">Cinema</option>
                                            </select><br>
                                            <!--------image------->
                                            <label for="image">Image</label>
                                            <input type="file" class="form-control-sm mb-2 d-flex flex-column" name="image" id="image" placeholder="image" accept="image/png, image/jpeg" required>
                                            <!---------submit--------->
                                            <input aria-label="ajouter un article" type="submit" id="ajouter" class="btn btn-success" name="ajouter" value="Ajouter">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal pour supprimer un article-->
                        <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Etes-vous sùr de supprimer l'article ?</h1>
                                    </div>
                                    <div class="modal-body">
                                        <!----------------supprimer un article------------------------------->
                                        <a href="deleteArticle.php"><button type="button" aria-label="supprimer l'article" id="supprimer" class="btn btn-danger" name="Supprimer" value="Supprimer">Supprimer</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- End of Main Content -->


    </div>
    <!-- End of Content Wrapper -->

    <!-- Footer -->
    <footer class="row sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2021</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>