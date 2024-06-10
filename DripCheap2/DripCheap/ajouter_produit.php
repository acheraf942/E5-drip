<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID_utilisateur'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.html");
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si toutes les données du formulaire sont présentes
    if (isset($_POST['id_produit'], $_POST['nom_produit'], $_POST['description'], $_POST['categorie'], $_POST['prix'], $_POST['tailles_disponibles'], $_POST['couleurs_disponibles'], $_POST['image'])) {
        // Récupérer les données du formulaire
        $id_produit = $_POST['id_produit'];
        $nom_produit = $_POST['nom_produit'];
        $description = $_POST['description'];
        $categorie = $_POST['categorie'];
        $prix = $_POST['prix'];
        $tailles_disponibles = $_POST['tailles_disponibles'];
        $couleurs_disponibles = $_POST['couleurs_disponibles'];
        $image = $_POST['image']; // L'image est stockée en tant qu'URL

        // Connexion à la base de données
        $con = mysqli_connect("localhost", "root", "", "DRIP1");

        // Vérifier la connexion
        if ($con === false) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }

        // Préparer la requête d'insertion
        $sql = "INSERT INTO Articles (ID_article, Nom_article, Description, Catégorie, Prix, Tailles_disponibles, Couleurs_disponibles, Image) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);

        // Vérifier si la requête est prête
        if ($stmt) {
            // Liaison des paramètres
            mysqli_stmt_bind_param($stmt, "isssdsss", $id_produit, $nom_produit, $description, $categorie, $prix, $tailles_disponibles, $couleurs_disponibles, $image);

            // Exécution de la requête
            if (mysqli_stmt_execute($stmt)) {
                // Redirection vers la page de gestion des produits avec un message de succès
                header("Location: gerer_produits.php?success=1");
                exit();
            } else {
                // Redirection vers la page de gestion des produits avec un message d'erreur spécifique
                echo "Erreur lors de l'exécution de la requête : " . mysqli_error($con);
                exit();
            }
        } else {
            // Redirection vers la page de gestion des produits avec un message d'erreur spécifique
            echo "Erreur lors de la préparation de la requête : " . mysqli_error($con);
            exit();
        }

        // Fermer la connexion
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    } else {
        // Redirection vers la page de gestion des produits avec un message d'erreur si des données sont manquantes dans le formulaire
        header("Location: gerer_produits.php?error=2");
        exit();
    }
} else {
    // Redirection vers la page de gestion des produits si le formulaire n'a pas été soumis
    header("Location: gerer_produits.php");
    exit();
}
?>
