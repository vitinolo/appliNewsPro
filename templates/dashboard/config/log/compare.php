<?php
session_start();
//----------------vérification si il y a bien (identifiant + mot de pass) dans formulaire--------------> 
require_once("../connexion/connexion.php");

if (isset($_POST['lemail']) && isset($_POST['lpassword'])) {
    $email = $_POST['lemail'];
    $password = $_POST['lpassword'];

    // Requête pour récupérer le mot de passe haché associé à l'e-mail de l'utilisateur
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $hashed_password_from_db = $user['password'];

        // Comparer le mot de passe haché stocké dans la base de données avec le mot de passe fourni
        if (hash('sha256', $password) === $hashed_password_from_db) {
            // L'utilisateur est authentifié.
            // Vous pouvez récupérer les informations de l'utilisateur 
            // à partir de la base de données si nécessaire.
            $userNom = $user['nom'];
            $userPrenom = $user['prenom'];
            $userRole = $user['role'];
            $_SESSION['prenom'] = $userPrenom;
            $_SESSION['nom'] = $userNom;
            $_SESSION['role'] = $userRole;
            header("Location: ../../index.php");
            //cacher le formulaire.
            $userPrenom = '';
            $userNom = '';
            $userRole = '';
            exit();
        } else {
            // Les informations d'identification sont incorrectes.
            echo "Identifiant ou mot de passe incorrect!";
            header("Location: ../../index.php");
            //cacher le formulaire.
            $userPrenom = '';
            $userNom = '';
            $userRole = '';
            exit();
        }
    } else {
        // L'utilisateur n'existe pas.
        echo "Identifiant ou mot de passe incorrect!";
        header("Location: ../../index.php");
        //cacher le formulaire.
        $userPrenom = '';
        $userNom = '';
        $userRole = '';
        exit();
    }
}
