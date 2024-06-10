<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID_utilisateur'])) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");

// Vérifier la connexion
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Requête SQL pour récupérer les articles dans le panier de l'utilisateur
$ID_utilisateur = $_SESSION['ID_utilisateur'];
$sql = "SELECT Panier.ID_panier, Articles.ID_article, Articles.Nom_article, Articles.Description, Articles.Prix, Panier.Quantité 
        FROM Panier 
        INNER JOIN Articles ON Panier.ID_article = Articles.ID_article 
        WHERE Panier.ID_utilisateur = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $ID_utilisateur);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$articles = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[] = $row;
    }
}

// Fermer la connexion
mysqli_stmt_close($stmt);
mysqli_close($con);

// Stocker les articles dans la session
$_SESSION['panier'] = $articles;

// Afficher les messages de session si présents
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$message_class = isset($_SESSION['message_class']) ? $_SESSION['message_class'] : '';

// Supprimer les messages de session pour la prochaine requête
unset($_SESSION['message'], $_SESSION['message_class']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drip Cheap - Panier</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Vos styles CSS */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .product {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .product h2 {
            margin: 0;
        }
        .product p {
            margin: 5px 0;
        }
        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #555;
        }
        .message.success {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .message.error {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        form {
            display: inline-block;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Drip Cheap - Panier</h1>
        <?php include 'navbar.php'; ?>
    </header>
    <div class="container">
        <h2>Votre Panier</h2>
        <?php if ($message): ?>
            <div class="message <?php echo $message_class; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <div class="panier">
            <?php if (count($articles) > 0): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="product">
                        <div class="product-details">
                            <h2><?php echo $article['Nom_article']; ?></h2>
                            <p>Prix : <?php echo $article['Prix']; ?> €</p>
                            <p>Quantité : <?php echo $article['Quantité']; ?></p>
                        </div>
                        <div class="product-actions">
                            <form method="post" action="modifier_panier.php">
                                <input type="hidden" name="ID_panier" value="<?php echo $article['ID_panier']; ?>">
                                <input type="hidden" name="ID_article" value="<?php echo $article['ID_article']; ?>">
                                <input type="number" name="nouv_quantite" value="<?php echo $article['Quantité']; ?>" min="1">
                                <button type="submit" name="modifier_panier">Modifier</button>
                            </form>
                            <form method="post" action="delete_panier.php">
                                <input type="hidden" name="ID_panier" value="<?php echo $article['ID_panier']; ?>">
                                <input type="hidden" name="ID_article" value="<?php echo $article['ID_article']; ?>">
                                <button type="submit" name="delete_cart">Supprimer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
                <form method="post" action="commande.php">
                    <button type="submit" name="commander">Commander</button>
                </form>
            <?php else: ?>
                <p>Le panier est vide.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
