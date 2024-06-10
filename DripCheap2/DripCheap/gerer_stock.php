<?php
session_start();

// Vérifiez si l'utilisateur est administrateur (ajustez cette partie selon votre logique d'autorisation)
if (!isset($_SESSION['ID_utilisateur']) || $_SESSION['type'] !== 'gerant') {
    header("Location: login.html");
    exit();
}

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Requête pour récupérer les articles
$sql_articles = "SELECT * FROM Articles";
$result_articles = mysqli_query($con, $sql_articles);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gestion des Stocks</title>
    <link rel="stylesheet" href="style.css">
    <?php include 'navbar2.php';?>
    <style>
        /* Vos styles CSS */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Gestion des Stocks</h1>
    <table>
        <thead>
            <tr>
                <th>ID Article</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result_articles)) { ?>
            <tr>
                <td><?php echo $row['ID_article']; ?></td>
                <td><?php echo $row['Nom_article']; ?></td>
                <td><?php echo $row['Description']; ?></td>
                <td><?php echo $row['Prix']; ?> €</td>
                <td><?php echo $row['Stock']; ?></td>
                <td>
                    <form method="post" action="modif_stock.php">
                        <input type="hidden" name="ID_article" value="<?php echo $row['ID_article']; ?>">
                        <input type="number" name="nouveau_stock" value="<?php echo $row['Stock']; ?>" min="0">
                        <button type="submit">Modifier</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
<?php
mysqli_close($con);
?>
