
<?php
session_start();
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID_utilisateur'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: login.html");
    exit();
}

// Vérifier si l'ID de commande est passé en paramètre dans l'URL
if (!isset($_GET['ID_commande'])) {
    // Rediriger l'utilisateur vers une autre page s'il n'y a pas d'ID de commande
    header("Location: boutique.php");
    exit();
}

// Récupérer l'ID de commande depuis l'URL
$ID_commande = $_GET['ID_commande'];

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");

// Vérifier la connexion
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Requête SQL pour récupérer les détails de la commande à partir de son ID
$sql_commande = "SELECT * FROM Commandes WHERE ID_commande = $ID_commande";
$result_commande = mysqli_query($con, $sql_commande);

// Vérifier si la commande existe
if (mysqli_num_rows($result_commande) > 0) {
    // Récupérer les informations de la commande
    $row_commande = mysqli_fetch_assoc($result_commande);
    $date_commande = $row_commande['Date_commande'];
    $adresse_livraison = $row_commande['Adresse_livraison'];
    $statut_commande = $row_commande['Statut_commande'];

    // Afficher les détails de la commande
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Drip cheap</title>
        <?php include 'navbar.php';?>
        <link rel="stylesheet" href="style.css">
        <!-- Ajoutez vos styles CSS ici -->
    </head>
    
    <body>
        <div class="container">
            <h1>Confirmation de commande</h1>
            <p>Numéro de commande : <?php echo $ID_commande; ?></p>
            <p>Date de commande : <?php echo $date_commande; ?></p>
            <p>Adresse de livraison : <?php echo $adresse_livraison; ?></p>
            <p>Statut de commande : <?php echo $statut_commande; ?></p>
            <!-- Autres détails de la commande ici -->
        </div>
    </body>
    </html>
    <?php
} else {
    // Afficher un message si la commande n'existe pas
    echo "Commande introuvable.";
}

// Fermer la connexion
mysqli_close($con);
?>
