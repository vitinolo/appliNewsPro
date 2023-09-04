<!-----------insertion d'un article------->
<?php
require_once("connexion.php");

//1. ---création d'une news ----------------

if (isset($_POST['titre']) && isset($_POST['abstract']) && isset($_POST['auteur']) && isset($_POST['rubrik']) && isset($_POST['image'])) {
    // Les données du formulaire sont présentes
    $titre = $_POST['titre'];
    $abstract = $_POST['abstract'];
    $auteur = $_POST['auteur'];
    $rubrik = $_POST['rubrik'];
    $image = $_POST['image'];

    // Requête d'insertion
    $query = "INSERT INTO news (titre, abstract, auteur, rubrik, image, date)
                VALUES (:titre, :abstract, :auteur, :rubrik, :image, '" . date('Y-m-d', time()) . "')";

    try {
        // Hydrater les données
        $stmt = $db->prepare($query);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':abstract', $abstract, PDO::PARAM_STR);
        $stmt->bindParam(':auteur', $auteur, PDO::PARAM_STR);
        $stmt->bindParam(':rubrik', $rubrik, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);


        // Exécuter la requête
        $stmt->execute();

        // Afficher un message si tout se passe bien 
        echo 'Entrée ajoutée dans la table';
        // Rediriger vers une page différente ou afficher un message de réussite
        header("Location: ../../index.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo 'Veuillez renseigner toutes les données!';
}
