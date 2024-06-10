<?php
session_start();

try {
    // Connexion à la base de données
    $con = mysqli_connect("localhost", "root", "", "DRIP1");

    // Vérifier la connexion
    if ($con === false) {
        throw new Exception("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

// Vérifier si une commande a été marquée comme traitée
if (isset($_GET['mark_processed']) && $_GET['mark_processed'] == 'true' && isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    // Affichage temporaire pour débogage
    echo "mark_processed: " . $_GET['mark_processed'] . "<br>";
    echo "order_id: " . $_GET['order_id'] . "<br>";
    $sql_mark_processed = "UPDATE commandes SET Statut_commande = 'traitée' WHERE ID_commande = $order_id";
    if (!mysqli_query($con, $sql_mark_processed)) {
        throw new Exception("Erreur lors du marquage de la commande comme traitée : " . mysqli_error($con));
    }
    echo "La commande a été marquée comme traitée avec succès.";
}

// Vérifier si une commande doit être supprimée
if (isset($_GET['delete_order']) && $_GET['delete_order'] == 'true' && isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);
    // Affichage temporaire pour débogage
    echo "delete_order: " . $_GET['delete_order'] . "<br>";
    echo "order_id: " . $_GET['order_id'] . "<br>";

    // Supprimer d'abord les détails de la commande
    $sql_delete_order_details = "DELETE FROM détails_commande WHERE ID_commande = $order_id";
    if (!mysqli_query($con, $sql_delete_order_details)) {
        throw new Exception("Erreur lors de la suppression des détails de la commande : " . mysqli_error($con));
    }

    // Ensuite, supprimer la commande
    $sql_delete_order = "DELETE FROM commandes WHERE ID_commande = $order_id";
    if (!mysqli_query($con, $sql_delete_order)) {
        throw new Exception("Erreur lors de la suppression de la commande : " . mysqli_error($con));
    }
    echo "La commande a été supprimée avec succès.";
}


    // Récupérer toutes les commandes
    $sql_get_orders = "SELECT commandes.*, Utilisateurs.Nom, Utilisateurs.Prénom 
                       FROM commandes 
                       INNER JOIN Utilisateurs ON commandes.ID_utilisateur = Utilisateurs.ID_utilisateur";
    $result = mysqli_query($con, $sql_get_orders);

    // Vérifier s'il y a des commandes
    if (mysqli_num_rows($result) > 0) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Gérer les Commandes</title>
            <?php include 'navbar2.php'; ?>
            <link rel="stylesheet" href="style.css">
            <!-- Ajouter vos styles CSS ici -->
            <style>
                /* Vos styles CSS */
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

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }

                th {
                    background-color: #f2f2f2;
                }

                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }

                tr:hover {
                    background-color: #ddd;
                }

                .processed {
                    color: green;
                }
            </style>
        </head>
        <body>
        <div class="container">
            <h1>Gérer les Commandes</h1>
            <table>
                <tr>
                    <th>ID Commande</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Produits</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    // Récupérer les produits liés à cette commande
                    $order_id = $row['ID_commande'];
                    $sql_get_products = "SELECT articles.*, détails_commande.Quantité
                                         FROM détails_commande 
                                         INNER JOIN articles ON détails_commande.ID_article = articles.ID_article
                                         WHERE détails_commande.ID_commande = $order_id";
                    $products_result = mysqli_query($con, $sql_get_products);

                    // Initialiser le prix total
                    $total_price = 0;
                    $products_text = "";

                    // Parcourir les produits et calculer le prix total
                    while ($product_row = mysqli_fetch_assoc($products_result)) {
                        $product_total = $product_row['Prix'] * $product_row['Quantité'];
                        $total_price += $product_total;
                        $products_text .= $product_row['Nom_article'] . " (x" . $product_row['Quantité'] . "), ";
                    }

                    // Supprimer la virgule et l'espace en trop à la fin de la chaîne
                    $products_text = rtrim($products_text, ', ');

                    // Afficher les détails de la commande dans le tableau
                    echo "<tr>";
                    echo "<td>" . $row['ID_commande'] . "</td>";
                    echo "<td>" . $row['Nom'] . " " . $row['Prénom'] . "</td>";
                    echo "<td>" . $row['Date_commande'] . "</td>";
                    echo "<td>" . $products_text . "</td>";
                    echo "<td>" . $total_price . "</td>";
                    echo "<td" . ($row['Statut_commande'] == 'traitée' ? " class='processed'" : "") . ">" . ($row['Statut_commande'] == 'traitée' ? "Traitée" : "En attente") . "</td>";
                    echo "<td>";
                    echo "<a href='gerer_commande.php?mark_processed=true&order_id=" . $row['ID_commande'] . "'>Marquer comme traitée</a> | ";
                    echo "<a href='gerer_commande.php?delete_order=true&order_id=" . $row['ID_commande'] . "'>Supprimer</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        </body>
        </html>
        <?php
    } else {
        echo "Aucune commande trouvée.";
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

// Fermer la connexion à la base de données
if (isset($con)) {
    mysqli_close($con);
}
?>
