<?php


//message d'erreur formulaire 
if (isset($_SESSION['erreur_message'])) {
    $messageErreur = $_SESSION['erreur_message'];
} else {
    $messageErreur = ""; // Si le message n'existe pas, le message d'erreur sera une chaîne vide
}
// Effacer le message d'erreur de la session pour qu'il ne s'affiche qu'une seule fois
unset($_SESSION['erreur_message']);
?>
<!-- templates/news/news.php-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyNews</title>
</head>

<body>
    <div class="container ncontainer">
        <div class="row">
            <p style="color:red;margin-top:35px;"><?php echo $messageErreur; ?></p>
            <?php foreach ($articles as $a) : ?>
                <div class="col-md-4">
                    <div class="card mb-3 mt-3" style="height:550px;">
                        <h3 class="card-title mt-2 m-2">
                            <?php echo htmlspecialchars($a['titre']); ?>
                        </h3>
                        <?php if (htmlspecialchars($a['image'])) : ?>
                            <img class="card-img-top object-fit-cover" style='height:300px' src="asset/images/<?php echo htmlspecialchars($a['image']); ?>" alt="article image">
                        <?php else : ?>
                            <img class="card-img-top object-fit-contain" src="asset/images/default.jpg" alt="article image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h3 class="card-text text-truncate">
                                <?php echo htmlspecialchars($a['abstract']); ?>
                            </h3>
                            <?php if (isset($_SESSION['prenom']) && isset($_SESSION['nom']) && ($_SESSION['prenom']) === '' || ($_SESSION['nom']) === '') : ?>
                                <p style="color:red;">Connectez-vous pour voir le descriptif de cet article.</p>
                            <?php else : ?>
                                <a href="index.php?action=showSingleNews&id=<?php echo htmlspecialchars($a['id']); ?>" class="btn btn-success" title="lire la suite">lire la suite</a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>