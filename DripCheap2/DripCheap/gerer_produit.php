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

// Traitement du formulaire de suppression
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $id_article = $_POST['id_article'];
    $sql_delete = "DELETE FROM Articles WHERE ID_article = $id_article";

    if (mysqli_query($con, $sql_delete)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erreur lors de la suppression du produit : " . mysqli_error($con);
    }
}

// Traitement du formulaire d'édition
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_product'])) {
    $id_article = $_POST['id_article'];
    $nom_produit = $_POST['nom_produit'];
    $description = $_POST['description'];
    $categorie = $_POST['categorie'];
    $prix = $_POST['prix'];
    $tailles_disponibles = $_POST['tailles_disponibles'];
    $couleurs_disponibles = $_POST['couleurs_disponibles'];
    $image = $_POST['image'];

    $sql_update = "UPDATE Articles SET Nom_article='$nom_produit', Description='$description', Catégorie='$categorie', Prix='$prix', Tailles_disponibles='$tailles_disponibles', Couleurs_disponibles='$couleurs_disponibles', Image='$image' WHERE ID_article=$id_article";

    if (mysqli_query($con, $sql_update)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Erreur lors de la mise à jour du produit : " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Produits</title>
    <?php include 'navbar2.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
            color: #555;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 4px;
        }
        form {
            display: inline-block;
            margin-right: 10px;
        }
        form input[type=text],
        form input[type=number],
        form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        form button {
            padding: 10px 15px;
            background-color: #5cb85c;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #4cae4c;
        }
        .delete-button {
            background-color: #d9534f;
        }
        .delete-button:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gérer les Produits</h1>
        <table>
            <tr>
                <th>ID Produit</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Tailles Disponibles</th>
                <th>Couleurs Disponibles</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
            <?php
        // Connexion à la base de données
        $con = mysqli_connect("localhost", "root", "", "DRIP1");

        // Vérifier la connexion
        if ($con === false) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }

        // Nombre d'articles par page
        $articles_par_page = 10;

        // Récupérer le numéro de page à partir de l'URL
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

        // Calculer le décalage pour la requête SQL
        $debut = ($page - 1) * $articles_par_page;

        // Requête SQL pour récupérer les articles pour la page actuelle
        $sql = "SELECT * FROM Articles LIMIT $debut, $articles_par_page";
        $result = mysqli_query($con, $sql);

        // Afficher les produits
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['ID_article'] . "</td>";
                echo "<td>" . $row['Nom_article'] . "</td>";
                echo "<td>" . $row['Description'] . "</td>";
                echo "<td>" . $row['Catégorie'] . "</td>";
                echo "<td>" . $row['Prix'] . "</td>";
                echo "<td>" . $row['Tailles_disponibles'] . "</td>";
                echo "<td>" . $row['Couleurs_disponibles'] . "</td>";
                echo "<td><img src='" . $row['Image'] . "' alt='Image Produit'></td>";
                echo "<td>";
                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
                echo "<input type='hidden' name='id_article' value='" . $row['ID_article'] . "'>";
                echo "<input type='text' name='nom_produit' value='" . $row['Nom_article'] . "' required>";
                echo "<textarea name='description' required>" . $row['Description'] . "</textarea>";
                echo "<input type='text' name='categorie' value='" . $row['Catégorie'] . "' required>";
                echo "<input type='number' name='prix' value='" . $row['Prix'] . "' step='0.01' required>";
                echo "<input type='text' name='tailles_disponibles' value='" . $row['Tailles_disponibles'] . "' required>";
                echo "<input type='text' name='couleurs_disponibles' value='" . $row['Couleurs_disponibles'] . "' required>";
                echo "<input type='text' name='image' value='" . $row['Image'] . "' required>";
                echo "<button type='submit' name='edit_product'>Soumettre</button>";
                echo "</form>";
                echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
                echo "<input type='hidden' name='id_article' value='" . $row['ID_article'] . "'>";
                echo "<button type='submit' name='delete_product' class='delete-button'>Supprimer</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>Aucun produit trouvé.</td></tr>";
        }

        // Pagination
        $sql_total = "SELECT COUNT(*) AS total FROM Articles";
        $result_total = mysqli_query($con, $sql_total);
        $row_total = mysqli_fetch_assoc($result_total);
        $total_articles = $row_total['total'];
        $total_pages = ceil($total_articles / $articles_par_page);

        echo "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $formatted_page = str_pad($i, 2, ' ', STR_PAD_LEFT); // Ajouter un espace avant chaque chiffre
            echo "<a href='gerer_produit.php?page=$i'>$formatted_page</a>";
        }
        echo "</div>";

        // Fermer la connexion
        mysqli_close($con);
        ?>
            
        </table>
    </div>
</body>
</html>