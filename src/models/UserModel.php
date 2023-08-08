<?php
    //UserModel.php
    class UserModel{
        //1. on va creer une variable $db permettant la connexion avec le db
        private $db;

        //2. on va mettre en place le constructeur pour notre db
        public function __construct($db){
            $this->db = $db;
        }

        //methode permettant la recuperation des users
        public function getAllUsers(){
            //requete sql
            $query = "SELECT * from users ORDER BY date_creation DESC LIMIT 8";
            //protection de la requete contre les injections sql(xss)
            $stmt = $this->db->prepare($query);
        //3. on execute la requete
        $stmt->execute();
        //4. retourne les données
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //methode permettant la recuperation d'un user
        public function getUserById($userId){
            //requete sql
            $query = "SELECT * FROM users WHERE id = :users_id";
            //protection de la requete contre les injections sql(xss)
            $stmt = $this->db->prepare($query);
        //5. on hydrate les donnees 
        $stmt->bindParam(':news_id', $userId, PDO::PARAM_INT);
        //6. on execute
        $stmt->execute();
        //7. on retourne les données
        return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }