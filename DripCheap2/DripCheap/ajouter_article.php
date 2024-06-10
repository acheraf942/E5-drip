<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID_utilisateur'])) {
    header("Location: login.html");
    exit();
}

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");

// Vérifier la connexion
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Traitement du formulaire d'ajout
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produit = $_POST['id_produit'];
    $nom_produit = $_POST['nom_produit'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $prix = $_POST['prix'];
    $tailles_disponibles = $_POST['tailles_disponibles'];
    $couleurs_disponibles = $_POST['couleurs_disponibles'];
    $image = $_POST['image'];

    $sql_insert = "INSERT INTO Articles (ID_article, Nom_article, Description, Catégorie, Prix, Tailles_disponibles, Couleurs_disponibles, Image) VALUES ('$id_produit', '$nom_produit', '$description', '$categorie', '$prix', '$tailles_disponibles', '$couleurs_disponibles', '$image')";

    if (mysqli_query($con, $sql_insert)) {
        header("Location: gerer_produit.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout du produit : " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Nouveau Produit</title>
    <?php include 'navbar2.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .add-product input[type=text], 
        .add-product input[type=number],
        .add-product textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .add-product button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .add-product button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ajouter un Nouveau Produit</h1>
        <form action="ajouter_article.php" method="post">
            <input type="text" name="id_produit" placeholder="ID du Produit" required>
            <input type="text" name="nom_produit" placeholder="Nom du Produit" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="text" name="categorie" placeholder="Catégorie" required>
            <input type="number" name="prix" placeholder="Prix" step="0.01" required>
            <input type="text" name="tailles_disponibles" placeholder="Tailles Disponibles" required>
            <input type="text" name="couleurs_disponibles" placeholder="Couleurs Disponibles" required>
            <input type="text" name="image" placeholder="URL de l'Image" required>
            <button type="submit">Ajouter Produit</button>
        </form>
    </div>
</body>
</html>
