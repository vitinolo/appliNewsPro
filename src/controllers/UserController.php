<?php
    //UserController.php

    class UserController{
            //1. on va créer une variable $db permettent la connexion avec le fichier connexion.php
            private $db;

            //2. on va mettre en place le constructeur pour notre Db
            public function __construct($db){
                $this->db = $db;
            }
            //3. methode permettant la lecture de toutes les news
            public function showAllUsers(){
            //4. instancier le model
            $usersModel = new UserModel($this->db);
            //5. recuperation de toutes les news
            $users = $usersModel->getAllUsers();
            //6. charger la vue avec la liste des articles
            include('templates/users/users.php');
            }

            //7. methode permettant la lecture d'une news via son id
            public function showSingleUser($userId){
                //8. instancier le modele
                $userModel = new UserModel($this->db);
                //9. recuperer la news par son id
                $user = $userModel->getUserById($userId);
                //10. charger la vue avec les details de la news
                include('templates/users/singleUser.php');
            }
    
    }
