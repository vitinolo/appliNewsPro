<!--templates/news/singleNews.php-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single news</title>
</head>

<body>
    <div class="container ncontainer d-flex justify-content-center">
        <div class="row card-wrapper mt-5" style="width:70%;margin-bottom:60px;">
            <h1 class="row d-flex justify-content-center mt-5" style="margin-top:50px;"><?php echo htmlspecialchars($article['rubrik']); ?></h1>
            <div class="card d-flex justify-content-center mb-5 mt-3">
                <h5 class="card-title justify-content-center mt-3 m-3">
                    <?php echo htmlspecialchars($article['titre']); ?>
                </h5>
                <?php if (htmlspecialchars($article['image'])) : ?>
                    <img class="card-img-top" src="asset/images/<?php echo htmlspecialchars($article['image']); ?>" alt="article image">
                <?php else : ?>
                    <img class="card-img-top" src="asset/images/default.jpg" alt="default image">
                <?php endif; ?>
                <div class="card-body">
                    <h3 class="card-text">
                        <?php echo htmlspecialchars($article['abstract']); ?>
                    </h3>
                    <h3 class="card-text d-flex justify-content-center ">
                        <p>Auteur :&nbsp;</p>
                        <?php echo htmlspecialchars($article['auteur']); ?>
                    </h3>
                </div>
                <h3 class="dateArticle" style="height:50px;">
                    <?php echo htmlspecialchars($article['date']); ?>
                </h3>
            </div>
        </div>
    </div>
</body>

</html>