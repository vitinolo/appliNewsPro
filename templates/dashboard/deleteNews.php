
<?php
require_once 'connexion.php'; // Incluez le fichier de connexion à la base de données

$id = $_GET['id']; // Récupérez l'id de l'article à supprimer

if ($id) {
    deleteArticle($id); // Appelez la fonction de suppression d'article
    header("Location: getAllNews.php"); // Redirigez vers la liste des articles après la suppression
    exit;
}

function deleteArticle($id)
{
    global $db;
    // Supprimer l'article
    $sql = "DELETE FROM news WHERE id=:id";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}
