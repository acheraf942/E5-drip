<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drip Cheap - Boutique</title>
    <style>
        /* Styles CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
        }
        h1 {
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }
        .product {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .product img {
            max-width: 100%;
            height: 200px;
            margin-bottom: 10px;
        }
        .product h2 {
            margin-top: 0;
        }
        .product p {
            margin: 10px 0;
        }
        .product button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .product button:hover {
            background-color: #555;
        }
        .pagination {
            margin-top: 20px;
            text-align: center;
        }
        .pagination a {
            display: inline-block;
            padding: 5px 10px;
            margin: 0 5px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .pagination a:hover {
            background-color: #555;
        }
    </style>
    <script src="script.js" defer></script> <!-- Inclusion du script JavaScript -->
</head>
<body>
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drip Cheap - Boutique</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Drip Cheap - Boutique</h1>
        <?php include 'navbar.php'; ?> <!-- Inclure la barre de navigation -->
    </header>
    <div class="container">
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
        $sql = "SELECT * FROM Articles WHERE Stock > 0 LIMIT $debut, $articles_par_page";

        $result = mysqli_query($con, $sql);

        // Afficher les produits
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<h2>" . $row['Nom_article'] . "</h2>";
                echo "<img src='" . $row['Image'] . "' alt='" . $row['Nom_article'] . "'>";
                echo "<p>" . $row['Description'] . "</p>";
                echo "<p>Prix : " . $row['Prix'] . " €</p>";
                if (isset($_SESSION['ID_utilisateur'])) {
                    // Si l'utilisateur est connecté, afficher le formulaire d'ajout au panier
                    echo "<form class='add-to-cart-form' method='post' action='ajouter_au_panier.php'>";
                    echo "<input type='hidden' name='ID_article' value='" . $row['ID_article'] . "'>";
                    echo "<label for='quantite'>Quantité :</label>";
                    echo "<input type='number' name='quantite' id='quantite' value='1' min='1'>";
                    echo "<button type='submit' name='add_to_cart'>Ajouter au panier</button>";
                    echo "</form>";
                } else {
                    // Si l'utilisateur n'est pas connecté, afficher un message
                    echo "<p>Connectez-vous pour ajouter au panier</p>";
                }
                echo "</div>";
            }
        } else {
            echo "Aucun produit trouvé.";
        }

        // Pagination
        $sql_total = "SELECT COUNT(*) AS total FROM Articles";
        $result_total = mysqli_query($con, $sql_total);
        $row_total = mysqli_fetch_assoc($result_total);
        $total_articles = $row_total['total'];
        $total_pages = ceil($total_articles / $articles_par_page);

        echo "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $formatted_page = str_pad($i, 2, '0', STR_PAD_LEFT); // Ajouter un zéro devant chaque chiffre
            echo "<a href='boutique.php?page=$i'>$formatted_page</a>";
        }
        echo "</div>";

        // Fermer la connexion
        mysqli_close($con);
        ?>
    </div>
</body>
</html>
