<?php
//1. appel du fichier config.php
require_once 'config.php';

//2. mise en place try et catch
try {
    //3. connexion a la bdd
    $db = new PDO("mysql:localhost=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOExeption $e) {
    die("erreur : " . $e->getMessage());
}
