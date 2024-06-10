<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID_utilisateur'])) {
    header("Location: login.html");
    exit();
}

// Vérifier si le panier existe dans la session et s'il n'est pas vide
if (!isset($_SESSION['panier']) || empty($_SESSION['panier'])) {
    header("Location: panier.php");
    exit();
}

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");

// Vérifier la connexion
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Vérifier si le formulaire de commande a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commander'])) {
    if (!empty($_POST['adresse_livraison'])) {
        $adresse_livraison = $_POST['adresse_livraison'];

        // Commencer une transaction
        mysqli_begin_transaction($con);

        try {
            // Insérer la commande
            $sql_commande = "INSERT INTO Commandes (ID_utilisateur, Date_commande, Adresse_livraison, Statut_commande) VALUES (?, NOW(), ?, 'En attente')";
            $stmt_commande = mysqli_prepare($con, $sql_commande);
            mysqli_stmt_bind_param($stmt_commande, "is", $_SESSION['ID_utilisateur'], $adresse_livraison);
            if (!mysqli_stmt_execute($stmt_commande)) {
                throw new Exception("Erreur lors de l'exécution de la requête de commande : " . mysqli_error($con));
            }

            $ID_commande = mysqli_insert_id($con);

            // Insérer les détails de la commande et mettre à jour le stock
            $sql_details_commande = "INSERT INTO détails_commande (ID_commande, ID_article, Quantité, Prix_unitaire) VALUES (?, ?, ?, ?)";
            $stmt_details_commande = mysqli_prepare($con, $sql_details_commande);

            foreach ($_SESSION['panier'] as $article) {
                $ID_article = $article['ID_article'];
                $quantite = $article['Quantité'];
                $prix_unitaire = $article['Prix'];

                // Vérifier le stock actuel
                $sql_stock = "SELECT Stock FROM Articles WHERE ID_article = $ID_article";
                $result_stock = mysqli_query($con, $sql_stock);
                $row_stock = mysqli_fetch_assoc($result_stock);
                $stock_actuel = $row_stock['Stock'];

                if ($stock_actuel < $quantite) {
                    throw new Exception("Stock insuffisant pour l'article ID: $ID_article");
                }

                // Déduire la quantité commandée du stock
                $nouveau_stock = $stock_actuel - $quantite;
                $sql_update_stock = "UPDATE Articles SET Stock = $nouveau_stock WHERE ID_article = $ID_article";
                if (!mysqli_query($con, $sql_update_stock)) {
                    throw new Exception("Erreur lors de la mise à jour du stock : " . mysqli_error($con));
                }

                // Insérer les détails de la commande
                mysqli_stmt_bind_param($stmt_details_commande, "iiid", $ID_commande, $ID_article, $quantite, $prix_unitaire);
                if (!mysqli_stmt_execute($stmt_details_commande)) {
                    throw new Exception("Erreur lors de l'exécution de la requête des détails de commande : " . mysqli_error($con));
                }
            }

            // Supprimer le panier de la base de données
            $sql_supprimer_panier = "DELETE FROM Panier WHERE ID_utilisateur = ?";
            $stmt_supprimer_panier = mysqli_prepare($con, $sql_supprimer_panier);
            mysqli_stmt_bind_param($stmt_supprimer_panier, "i", $_SESSION['ID_utilisateur']);
            if (!mysqli_stmt_execute($stmt_supprimer_panier)) {
                throw new Exception("Erreur lors de la suppression du panier : " . mysqli_error($con));
            }

            // Vider le panier
            unset($_SESSION['panier']);

            // Valider la transaction
            mysqli_commit($con);

            header("Location: confirmation_commande.php?ID_commande=$ID_commande");
            exit();
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            mysqli_rollback($con);
            $error_message = $e->getMessage();
        }
    } else {
        $error_message = "Veuillez saisir votre adresse de livraison.";
    }
}

// Fermer la connexion
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande</title>
    <link rel="stylesheet" href="style.css">
    <?php include "navbar.php";?>
    <style>
        /* Style de base pour le corps de la page */
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
        form {
            margin-top: 20px;
        }
        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Finaliser la commande</h1>
        <?php if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])): ?>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="adresse_livraison">Adresse de livraison :</label><br>
                <textarea id="adresse_livraison" name="adresse_livraison" rows="4" cols="50"></textarea><br><br>
                <button type="submit" name="commander">Commander</button>
            </form>
        <?php else: ?>
            <p>Votre panier est vide.</p>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <p><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
