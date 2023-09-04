<?php session_start();
//valeur $_SESSION ='' lorsque déconnecté
if (!isset($_SESSION["prenom"])) {
    $_SESSION["prenom"] = '';
}
if (!isset($_SESSION["nom"])) {
    $_SESSION["nom"] = '';
}
if (!isset($_SESSION["role"])) {
    $_SESSION["role"] = '';
} ?>
<!--templates/elements/header-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application</title>
</head>

<body>
    <div id="header">
        <div class="row">
            <!-------si aucun utilisteur est connecté affiche l'icone de connexion----->
            <?php if (!isset($_SESSION['id'])) : ?>
                <!--bouton de connexion-->
                <div class="col-md-4"></div>
                <div class="col-md-4 titreAp">
                    <h1 class="mb-2 d-flex justify-content-center" title="Home"><a href="index.php" style="color:red;text-decoration:none;" aria-label="retour vers accueil">News Application</a></h1>
                </div>
                <div class="col-md-4 mt-4 d-flex justify-content-center d-flex align-items-center">
                    <div class="row">
                        <div class="row d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <div class="col-md-6 d-flex justify-content-center d-flex align-items-center">
                                <i class="fa-solid fa-user-circle fa-xl m-2" style="color:white" title="s'identifier" arai-label="s'identifier"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <!-------si un utilisteur est connecté affiche l'icone de déconnexion et le stylet----->
            <?php else : ?>
                <!--bouton de deconnexion-->
                <div class="col-md-4 mt-5 d-flex justify-content-center d-flex align-items-center" title="Déconnexion">
                    <a href="./config/connexion/deconnexion.php" aria-label="déconnexion">
                        <i class="fa-solid fa-power-off fa-xl" style="color:white;"></i>
                    </a>
                </div>
                <div class="col-md-4 titreAp">
                    <h1 class="mb-2 d-flex justify-content-center" title="Home"><a href="index.php" style="color:red;text-decoration:none;" aria-label="retour vers accueil">News Application</a></h1>
                </div>
                <!--apparition du stylo pour ajouter un article en fonction du role du user-->
                <?php if (isset($_SESSION['id'])) : ?>
                    <!--affichage de l'identité du user-->
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <div class="row identiteUser p-1" style="color:white;justify-content:center;">
                            Bonjour <?php echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']; ?> !
                        </div>
                        <?php if ($_SESSION['role'] === 'editor') : ?>
                            <div id="pen" class="col-md-4 d-flex justify-content-center d-flex align-items-center mb-2" title="ajouter un article" aria-label="ajouter un article">
                                <a href="./templates/dashboard/index.php"><i class="fa-solid fa-pen fa-lg" style="color:white;justify-content:center;"></i></a>
                            </div>
                        <?php elseif ($_SESSION['role'] === 'admin') : ?>
                            <div id="pen" class="col-md-4 d-flex justify-content-center d-flex align-items-center mb-2" title="ajouter un article" aria-label="ajouter un article">
                                <a href="./templates/dashboard/index.php"><i class="fa-solid fa-pen fa-lg" style="color:white;justify-content:center;"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
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
                        <form id="loginForm" class="loginForm mt-0 hide show" method="POST" action="./config/log/compare.php" aria-label="formulaire de connexion">
                            <!----------email-------->
                            <label for="email">Email</label>
                            <input type="email" class="form-control-sm mb-2 d-flex flex-column" name="lemail" id="lemail" placeholder="Email" aria-label="email" required>
                            <!--------password------->
                            <label for="password">Password</label>
                            <input type="password" class="form-control-sm mb-2 d-flex flex-column" name="lpassword" id="lpassword" minlength="4" maxlength="8" placeholder="Password" aria-label="password" required>
                            <!---------submit--------->
                            <input aria-label="envoyer" type="submit" id="lenvoyer" class="btn btn-success" name="lenvoyer" value="login">
                            <button aria-label="s'enregistrer" id="signUp" title="Pas encore enregistré" data-bs-toggle="modal" data-bs-target="#exampleModal2">S'enregistrer</button>
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
                        <form id="signUpForm" class="signUpForm mt-0 hide show" method="POST" action="./config/log/signup.php" aria-label="formulaire d'inscription">
                            <!-----------nom--------->
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="nom" id="nom" placeholder="Nom" aria-label="nom" required>
                            <!-----------prénom--------->
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="prenom" id="prenom" placeholder="Prenom" aria-label="prenom" required>
                            <!----------email-------->
                            <label for="email">Email</label>
                            <input type="email" class="form-control-sm mb-2 d-flex flex-column" name="email" id="email" placeholder="Email" required>
                            <!--------password------->
                            <label for="password">Password</label>
                            <input type="password" class="form-control-sm mb-2 d-flex flex-column" name="password" id="password" minlength="4" maxlength="8" placeholder="Password" required>
                            <!--------checkbox-------->
                            <label for="rgpd" aria-label="check rgpd">Rgpd</label>
                            <input type="checkbox" aria-label="check rgpd">
                            <!---------submit--------->
                            <input aria-label="envoyer" type="submit" class="btn btn-success " name="envoyer" value="signup" />
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
                        <a class="nav-link fs-5" href="index.php" title="Home" aria-label="lien vers accueil">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllSportNews" title="Sports" aria-label="lien vers sport">Sport</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllCuisineNews" title="Cuisine" aria-label="lien vers cuisine">Cuisine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllVoyageNews" title="Voyage" aria-label="lien vers voyage">Voyage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllCultureNews" title="Culture" aria-label="lien vers culture">Culture</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="index.php?action=showAllCinemaNews" title="Cinéma" aria-label="lien vers cinéma">Cinema</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</body>

</html>