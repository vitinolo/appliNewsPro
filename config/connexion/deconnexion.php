<?php
session_start();
//destruction de la session
session_destroy();
//redirection vers l'accueil
header("Location: ../../index.php");
exit();
