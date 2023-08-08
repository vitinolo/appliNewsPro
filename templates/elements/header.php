<? session_start(); ?>
<!--templates/elements/header-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
</head>

<body>
    <div id="header">
        <!------titre icone btn toogle----------->
        <div class="row">
            <!--bouton de deconnexion-->
            <div class="col-md-4 mt-5 d-flex justify-content-center d-flex align-items-center" title="Déconnexion">
                <a href="./config/connexion/deconnexion.php">
                    <i class="fa-solid fa-power-off fa-xl" style="color:white;"></i>
                </a>
            </div>
            <div class="col-md-4 titreAp">
                <h1 class="mb-2 d-flex justify-content-center" title="Home"><a href="index.php" style="color:red;text-decoration:none;">News Application</a></h1>
            </div>
            <div class="col-md-4 mt-4 d-flex justify-content-center d-flex align-items-center">
                <div class="row">
                    <div class="row d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <!--bouton de connexion-->
                        <div class="col-md-6 d-flex justify-content-center d-flex align-items-center">
                            <i class="fa-solid fa-user-circle fa-xl m-2" style="color:white" title="s'identifier"></i>
                        </div>
                        <!--apparition du stylo pour ajouter un article en fonction du role du user-->
                        <?php echo $_SESSION['role'] !== 'admin' ? 'hidden' : '<div id="pen" class="row d-flex justify-content-center d-flex align-items-center mb-2
                            " data-bs-toggle="modal" data-bs-target="#exampleModal3" title="ajouter un article">
                            <i class="fa-solid fa-pen fa-lg" style="color:white;justify-content:center;"></i>
                            </div>';
                        ?>
                    </div>
                    <!--affichage de l'identité du user-->
                    <div class="row identiteUser p-1" style="color:white;justify-content:center;">
                        Bonjour <?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?> !
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
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!----------------ajouter un article------------------------------->
                        <form id="adArticle" class="adArticle mt-0 hide show" method="POST" action="./config/log/insertArticle.php">
                            <!----------titre-------->
                            <label for="titre">Titre</label>
                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="titre" id="title" placeholder="titre" minlength="4" maxlength="200" required></textarea>
                            <!--abstract-->
                            <label for="article">Article</label>
                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="abstract" id="abstract" placeholder="article" minlength="4" maxlength="400" required></textarea>
                            <!--contenu1-->
                            <label for="article">Contenu1</label>
                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="contenu1" id="contenu1" placeholder="contenu1" minlength="4" maxlength="400"></textarea>
                            <!--contenu2-->
                            <label for="article">Contenu2</label>
                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="contenu2" id="contenu2" placeholder="contenu2" minlength="4" maxlength="400"></textarea>
                            <!--contenu3-->
                            <label for="article">Contenu3</label>
                            <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="contenu3" id="contenu3" placeholder="contenu3" minlength="4" maxlength="400"></textarea>
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
                            <!--types-->
                            <label for="rubrik">un type:</label>
                            <select class="form-control" id="types" name="types">
                                <option value="">--Please choose an option--</option>
                                <option value="zleft">left</option>
                                <option value="zright">right</option>
                                <option value="zcenter">center</option>
                            </select><br>
                            <!--------image------->
                            <label for="image">Image</label>
                            <input type="file" class="form-control-sm mb-2 d-flex flex-column" name="image" id="image" placeholder="image" accept="image/png, image/jpeg" required>
                            <!--------date--------->
                            <label for="date">Date</label>
                            <input type="date" class="form-control-sm mb-2 d-flex flex-column" name="date_creation" id="date" placeholder="date" required>
                            <!---------submit--------->
                            <input type="submit" id="ajouter" class="btn btn-success" name="ajouter" value="Ajouter">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal s'identifier-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">S'identifier</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!----------------login------------------------------->
                        <form id="loginForm" class="loginForm mt-0 hide show" method="POST" action="./config/log/compare.php">
                            <!----------email-------->
                            <label for="email">Email</label>
                            <input type="email" class="form-control-sm mb-2 d-flex flex-column" name="lemail" id="lemail" placeholder="Email" required>
                            <!--------password------->
                            <label for="password">Password</label>
                            <input type="password" class="form-control-sm mb-2 d-flex flex-column" name="lpassword" id="lpassword" minlength="4" maxlength="8" placeholder="Password" required>
                            <!---------submit--------->
                            <input type="submit" id="lenvoyer" class="btn btn-success" name="lenvoyer" value="login">
                            <button id="signUp" title="Pas encore enregistré" data-bs-toggle="modal" data-bs-target="#exampleModal2">S'enregistrer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal s'enregistrer-->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">S'inscrire</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!------------------------------signup----------------------------------->
                        <form id="signUpForm" class="signUpForm mt-0 hide show" method="POST" action="./config/log/signup.php">
                            <!-----------nom--------->
                            <label for="lastname">Nom</label>
                            <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="nom" id="nom" placeholder="Nom" required>
                            <!-----------prénom--------->
                            <label for="name">Prénom</label>
                            <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="prenom" id="prenom" placeholder="Prenom" required>
                            <!----------email-------->
                            <label for="email">Email</label>
                            <input type="email" class="form-control-sm mb-2 d-flex flex-column" name="email" id="email" placeholder="Email" required>
                            <!--------password------->
                            <label for="password">Password</label>
                            <input type="password" class="form-control-sm mb-2 d-flex flex-column" name="password" id="password" minlength="4" maxlength="8" placeholder="Password" required>
                            <!--------checkbox-------->
                            <label for="rgpd">Rgpd</label>
                            <input type="checkbox">
                            <!---------submit--------->
                            <input type="submit" class="btn btn-success " name="envoyer" value="signup" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--------------navigation----------->
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarTogglerDemo01">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php" title="Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllSportNews" title="Sports">Sport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllCuisineNews" title="Cuisine">Cuisine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllVoyageNews" title="Voyage">Voyage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllCultureNews" title="Culture">Culture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllCinemaNews" title="Cinéma">Cinema</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</body>

</html>