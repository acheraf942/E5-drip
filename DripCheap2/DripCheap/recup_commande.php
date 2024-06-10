<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID_utilisateur'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.html");
    exit();
}

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");

// Vérifier la connexion
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Sélectionner toutes les commandes de l'utilisateur
$sql_commandes = "SELECT * FROM Commandes WHERE ID_utilisateur = " . $_SESSION['ID_utilisateur'];
$result_commandes = mysqli_query($con, $sql_commandes);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes commandes</title>
    <?php include 'navbar.php'; ?>
    <link rel="stylesheet" href="style.css">

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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
    text-align: left;
}

th {
    background-color: #333;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr {
    margin-bottom: 10px; /* Ajoute une marge inférieure de 10 pixels à chaque ligne */
}
</style>
</head>
<body>
    <div class="container">
        <h1>Mes commandes</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Commande</th>
                    <th>Date Commande</th>
                    <th>Adresse Livraison</th>
                    <th>Statut Commande</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Afficher les commandes dans un tableau
                while ($row_commande = mysqli_fetch_assoc($result_commandes)) {
                    echo "<tr>";
                    echo "<td>" . $row_commande['ID_commande'] . "</td>";
                    echo "<td>" . $row_commande['Date_commande'] . "</td>";
                    echo "<td>" . $row_commande['Adresse_livraison'] . "</td>";
                    echo "<td>" . $row_commande['Statut_commande'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>

<?php
// Fermer la connexion
mysqli_close($con);
?>