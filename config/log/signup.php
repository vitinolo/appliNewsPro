<?php session_start();
//appel des fichiers
require_once("../connexion/connexion.php");
require_once("../../src/controllers/UserController.php");

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password'])) {
    // Comparaison de l'email du formulaire avec l'email de la base de données 
    $email = $_POST['email'];
    //on crée un tableau pour recevoir les emails dans la table users
    $emailUsers = array();
    $sql = "SELECT email FROM users";
    try {
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $emailUsers = $stmt->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    //avec la fonction in_array() on vérifie si la valeur du premier paramètre ($email)
    // se trouve dans le tableau ($emailUsers) et si la réponse est oui alors on affiche "email utilisé"
    if (in_array($email, $emailUsers, TRUE)) {
        //on envoie un message d'erreur via la variable de session
        $_SESSION['erreur_message'] = "Email déjà utilisé, veuillez recommencer !";
        //on redirige vers l'accueil
        header("Location: ../../index.php");
        exit();
    } else {
        //sinon 
        //variable de session n'affiche pas le message d'erreur
        $_SESSION['erreur_message'] = "";
        //1. les données du formulaire à insérer dans la table users de la bdd
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //1.1 hachage du mot de passe avec sha256.
        $hashed_password = hash('sha256', $password);

        // 2.requete d'insertion des données dans la table users
        $sql = "INSERT INTO users( nom, prenom, email, password)
                VALUES(:nom, :prenom, :email, :password)";
        try {
            //3.hydrater les données( technique de sécurisation des requêtes SQL,
            //cela permet de séparer le code SQL de ses données.)
            $stmt = $db->prepare($sql);
            //lier les valeurs de variables aux paramètres dans requête préparée. 
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

            $stmt->execute();
            //5. afficher le message si tout se passe bien
            header("Location: ../../index.php");
            exit();
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
} else {
    echo 'Nom, prénom, email ou mot de passe invalide!';
}
