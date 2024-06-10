<?php
// Initialiser la session
session_start();

// Détruire toutes les données de la session
session_destroy();

// Rediriger l'utilisateur vers la page de connexion ou une autre page pertinente
header("Location: index.php");
exit();
?>