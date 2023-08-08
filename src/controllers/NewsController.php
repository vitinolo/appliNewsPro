<?php
//NewsController.php

class NewsController
{
    //1. on va créer une variable $db permettent la connexion avec le fichier connexion.php
    private $db;

    //2. on va mettre en place le constructeur pour notre Db
    public function __construct($db)
    {
        $this->db = $db;
    }
    //3. methode permettant la lecture de toutes les news
    public function showAllNews()
    {
        //4. instancier le model
        $newsModel = new NewsModel($this->db);
        //5. recuperation de toutes les news
        $articles = $newsModel->getAllNews();
        //6. charger la vue avec la liste des articles
        include('templates/news/news.php');
    }

    //7. methode permettant la lecture d'une news via son id
    public function showSingleNews($newsId)
    {
        //8. instancier le modele
        $newsModel = new NewsModel($this->db);
        //9. recuperer la news par son id
        $article = $newsModel->getNewsById($newsId);
        //10. charger la vue avec les details de la news

        include('templates/news/singleNews.php');
    }

    //11. methode permettant la lecture de toutes les news de sport
    public function showAllSportNews()
    {
        //12. instancier le model
        $SportNewsModel = new NewsModel($this->db);
        //13. recuperation de toutes les news
        $articles = $SportNewsModel->getAllSportNews();
        //14. charger la vue avec la liste des articles

        include('templates/news/news.php');
    }

    //12. methode permettant la lecture de toutes les news de cuisine
    public function showAllCuisineNews()
    {
        //12. instancier le model
        $CuisineNewsModel = new NewsModel($this->db);
        //13. recuperation de toutes les news
        $articles = $CuisineNewsModel->getAllCuisineNews();
        //14. charger la vue avec la liste des articles

        include('templates/news/news.php');
    }

    //12. methode permettant la lecture de toutes les news de voyage
    public function showAllVoyageNews()
    {
        //12. instancier le model
        $VoyageNewsModel = new NewsModel($this->db);
        //13. recuperation de toutes les news
        $articles = $VoyageNewsModel->getAllVoyageNews();
        //14. charger la vue avec la liste des articles

        include('templates/news/news.php');
    }

    //12. methode permettant la lecture de toutes les news de culture
    public function showAllCultureNews()
    {
        //12. instancier le model
        $CultureNewsModel = new NewsModel($this->db);
        //13. recuperation de toutes les news
        $articles = $CultureNewsModel->getAllCultureNews();
        //14. charger la vue avec la liste des articles

        include('templates/news/news.php');
    }

    //12. methode permettant la lecture de toutes les news de cinéma
    public function showAllCinemaNews()
    {
        //12. instancier le model
        $CinemaNewsModel = new NewsModel($this->db);
        //13. recuperation de toutes les news
        $articles = $CinemaNewsModel->getAllCinemaNews();
        //14. charger la vue avec la liste des articles

        include('templates/news/news.php');
    }
}
