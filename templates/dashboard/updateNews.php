<?php
session_start();

// Connexion à la base de données (assurez-vous d'inclure le fichier connexion.php)
require_once "connexion.php";

// Vérifier si l'ID de la news est passé dans l'URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Rediriger l'utilisateur vers une page d'erreur ou la liste des news, par exemple :
    header("Location: getAllNews.php");
    exit;
}

// Récupérer l'ID de la news depuis l'URL
$newsId = $_GET['id'];
/*-----------------------affichage des informations de la news dans les champs du formulaire----------------------------------*/
// Requête SQL pour récupérer les informations de la news depuis la base de données
try {
    $sql = "SELECT id, titre, abstract, auteur, rubrik, image FROM news WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id", $newsId);
    $stmt->execute();
    $news = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si la news avec l'ID spécifié existe
    if (!$news) {
        // Rediriger l'utilisateur vers une page d'erreur ou la liste des news, par exemple :
        header("Location: list_news.php");
        exit;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}

// Vérifier si le formulaire a été soumis pour mettre à jour la news
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $abstract = $_POST["abstract"];
    $rubrik = $_POST["rubrik"];
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = basename($destination);
    } else {
        $image = $news['image']; // Conservez l'image existante si aucune nouvelle image n'est téléchargée
    }
    // Vous pouvez ajouter d'autres champs ici

    // ...
        // Vérifier si une nouvelle image a été téléchargée
if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Récupérer le nom temporaire du fichier
    $tmpName = $_FILES['image']['tmp_name'];

    // Obtenir le nom d'origine du fichier
    $originalFileName = $_FILES['image']['name'];

    // Vérifier si une image avec le même nom existe déjà dans le dossier de destination
    $destination = './asset/images/' . $originalFileName;
    $counter = 1;
    while (file_exists($destination)) {
        // Si une image avec le même nom existe, ajouter un suffixe numérique pour rendre le nom unique
        $destination = './asset/images/' . pathinfo($originalFileName, PATHINFO_FILENAME) . '_' . $counter . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);
        $counter++;
    }

    // Déplacer le fichier téléchargé vers le dossier des images avec le nom unique
    if (move_uploaded_file($tmpName, $destination)) {
        // Mettre à jour le nom de l'image dans la base de données
        $image = basename($destination);
        $sqlUpdateImage = "UPDATE news SET image = :image WHERE id = :id";
        $stmtUpdateImage = $db->prepare($sqlUpdateImage);
        $stmtUpdateImage->bindParam(":image", basename($destination));
        $stmtUpdateImage->bindParam(":id", $newsId);
        $stmtUpdateImage->execute();
    } else {
        // Une erreur s'est produite lors du téléchargement de l'image
        echo "erreur lors du déplacement du fichier";
        // Vous pouvez gérer cette situation selon vos besoins
    }
}
    /*-----------------------------------mise à jour des informations de la news----------------------------------*/
    // Requête SQL pour mettre à jour les informations de la news dans la base de données
    $sqlUpdateNews = "UPDATE news SET titre = :titre, abstract = :abstract, rubrik = :rubrik, image = :image WHERE id = :id";
    $stmtUpdateNews = $db->prepare($sqlUpdateNews);
    $stmtUpdateNews->bindParam(":titre", $titre);
    $stmtUpdateNews->bindParam(":abstract", $abstract);
    $stmtUpdateNews->bindParam(":rubrik", $rubrik);
    $stmtUpdateNews->bindParam(":image", $image);
    // Ajouter d'autres bindParam pour les autres champs si nécessaire
    $stmtUpdateNews->bindParam(":id", $newsId);

    // Exécuter la requête
    try {
        $stmtUpdateNews->execute();
        // Rediriger l'utilisateur vers la page des news
        header("Location: getAllNews.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        exit;
    }
}

require_once '../../asset/base.php';
?>

<!-- Modifier un article -->
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form method="post" action="updateNews.php?id=<?php echo $newsId; ?>" id="article" class="d-flex flex-column p-3 mt-5" style="border: 2px solid black" method="POST" enctype="multipart/form-data">
                <h1>Modifier la news</h1>
                <!-- Titre -->
                <label for="titre">Titre</label>
                <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="titre" value="<?php echo $news['titre']; ?>" id="title" minlength="4" maxlength="255" required></input>
                <!-- Abstract -->
                <label for="article">Abstract</label>
                <textarea type="text" class="form-control-sm mb-2 d-flex flex-column" name="abstract" id="abstract" minlength="4" maxlength="100" required><?php echo $news['abstract']; ?></textarea>
                <!-- Auteur -->
                <label for="auteur">Auteur</label>
                <input type="text" class="form-control-sm mb-2 d-flex flex-column" name="auteur" value="<?php echo $news['auteur']; ?>" id="auteur" minlength="2" maxlength="100" required></input>
                <!-- Rubrik -->
                <label for="rubrik">Choisir une rubrique:</label>
                <select class="form-control" id="rubrik" name="rubrik" required>
                    <option value="">--Please choose an option--</option>
                    <option value="sports">Sports</option>
                    <option value="cuisine">Cuisine</option>
                    <option value="voyages">Voyage</option>
                    <option value="culture">Culture</option>
                    <option value="cinema">Cinema</option>
                </select><br>
                <!-- Image -->
                <label for="image">Image actuelle :</label><br>
                <img class="toto mb-4" src="<?php echo './asset/images/' . $news['image']; ?>" alt="Image" width="300" height="100">
                <label for="image">Choisir une image pour remplacer l'actuelle</label>
                <input type="file" class="form-control-sm mb-2 d-flex flex-column"  name="image" id="image" placeholder="image" accept="image/png, image/jpeg"></input>
                <!-- Submit -->
                <input aria-label="modifier un article" type="submit" id="modifier" class="btn btn-success" name="modifier" value="Modifier">
                <!-- Bouton annuler -->
                <a href="getAllNews.php" aria-label="annuler" type="button" id="annuler" class="btn btn-success mt-2" title="retour vers dashboard">Annuler</a>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
