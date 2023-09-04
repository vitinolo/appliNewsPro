<!-----------insertion d'un article------->
<?php
require_once("../connexion/connexion.php");

//1. ---création d'une news ----------------

if (
    isset($_POST['titre']) && isset($_POST['abstract'])
    && isset($_POST['contenu1']) && isset($_POST['contenu2'])
    && isset($_POST['contenu3']) && isset($_POST['auteur'])
    && isset($_POST['rubrik']) && isset($_POST['types'])
    && isset($_POST['image']) && isset($_POST['date_creation'])
) {
    // Les données du formulaire sont présentes
    $titre = $_POST['titre'];
    $abstract = $_POST['abstract'];
    $contenu1 = $_POST['contenu1'];
    $contenu2 = $_POST['contenu2'];
    $contenu3 = $_POST['contenu3'];
    $auteur = $_POST['auteur'];
    $rubrik = $_POST['rubrik'];
    $types = $_POST['types'];
    $image = $_POST['image'];
    $date = $_POST['date_creation'];

    // Requête d'insertion
    $query = "INSERT INTO news (titre, abstract, contenu1, contenu2, contenu3, auteur, rubrik, types, image, date_creation)
            VALUES (:titre, :abstract, :contenu1, :contenu2, :contenu3, :auteur, :rubrik, :types, :image, :date_creation)";

    try {
        // Hydrater les données
        $stmt = $db->prepare($query);
        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':abstract', $abstract, PDO::PARAM_STR);
        $stmt->bindParam(':contenu1', $contenu1, PDO::PARAM_STR);
        $stmt->bindParam(':contenu2', $contenu2, PDO::PARAM_STR);
        $stmt->bindParam(':contenu3', $contenu3, PDO::PARAM_STR);
        $stmt->bindParam(':auteur', $auteur, PDO::PARAM_STR);
        $stmt->bindParam(':rubrik', $rubrik, PDO::PARAM_STR);
        $stmt->bindParam(':types', $types, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':date_creation', $date, PDO::PARAM_STR);

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
