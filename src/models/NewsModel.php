<?php
//NewsModel.php
class NewsModel
{
    //1. on va creer une variable $db permettant la connexion avec le db
    private $db;

    //2. on va mettre en place le constructeur pour notre db
    public function __construct($db)
    {
        $this->db = $db;
    }

    //methode permettant la recuperation des news-----------------------
    public function getAllNews()
    {
        //requete sql
        $query = "SELECT * from news ORDER BY date_creation DESC LIMIT 20";
        //protection de la requete contre les injections sql(xss)
        $stmt = $this->db->prepare($query);
        //3. on execute la requete
        $stmt->execute();
        //4. retourne les données
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //methode permettant la recuperation d'une news------------------------
    public function getNewsById($newsId)
    {
        //requete sql
        $query = "SELECT * FROM news WHERE id = :news_id";
        //protection de la requete contre les injections sql(xss)
        $stmt = $this->db->prepare($query);
        //5. on hydrate les donnees 
        $stmt->bindParam(':news_id', $newsId, PDO::PARAM_INT);
        //6. on execute
        $stmt->execute();
        //7. on retourne les données
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //methode permettant la recuperation des sport news--------------------
    public function getAllSportNews()
    {
        //requete sql
        $query = "SELECT * from news WHERE rubrik = 'sports' ORDER BY date_creation DESC LIMIT 20";
        //protection de la requete contre les injections sql(xss)
        $stmt = $this->db->prepare($query);
        //3. on execute la requete
        $stmt->execute();
        //4. retourne les données
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //methode permettant la recuperation des news de cuisine-----------------
    public function getAllCuisineNews()
    {
        //requete sql
        $query = "SELECT * from news WHERE rubrik = 'cuisine' ORDER BY date_creation DESC LIMIT 20";
        //protection de la requete contre les injections sql(xss)
        $stmt = $this->db->prepare($query);
        //3. on execute la requete
        $stmt->execute();
        //4. retourne les données
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //methode permettant la recuperation des news de voyage-------------------
    public function getAllVoyageNews()
    {
        //requete sql.
        $query = "SELECT * from news WHERE rubrik = 'voyages' ORDER BY date_creation DESC LIMIT 20";
        //protection de la requete contre les injections sql(xss).
        $stmt = $this->db->prepare($query);
        //3. on execute la requete.
        $stmt->execute();
        //4. retourne les données.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //methode permettant la recuperation des news de culture.-------------------
    public function getAllCultureNews()
    {
        //requete sql.
        $query = "SELECT * from news WHERE rubrik = 'culture' ORDER BY date_creation DESC LIMIT 20";
        //protection de la requete contre les injections sql(xss).
        $stmt = $this->db->prepare($query);
        //3. on execute la requete.
        $stmt->execute();
        //4. retourne les données.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //methode permettant la recuperation des news de cinéma.------------------------
    public function getAllCinemaNews()
    {
        //requete sql
        $query = "SELECT * from news WHERE rubrik = 'cinema' ORDER BY date_creation DESC LIMIT 20";
        //protection de la requete contre les injections sql(xss).
        $stmt = $this->db->prepare($query);
        //3. on execute la requete.
        $stmt->execute();
        //4. retourne les données.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
