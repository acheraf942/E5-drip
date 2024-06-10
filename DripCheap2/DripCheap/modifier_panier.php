<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier_panier'])) {
    if (isset($_POST['ID_panier']) && isset($_POST['nouv_quantite'])) {
        // Connexion à la base de données
        $con = mysqli_connect("localhost", "root", "", "DRIP1");

        // Vérifier la connexion
        if ($con === false) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION['ID_utilisateur'])) {
            $ID_utilisateur = $_SESSION['ID_utilisateur'];
            $ID_panier = $_POST['ID_panier'];
            $nouv_quantite = $_POST['nouv_quantite'];

            // Requête SQL pour mettre à jour la quantité de l'article dans le panier
            $sql = "UPDATE Panier SET Quantité = ? WHERE ID_utilisateur = ? AND ID_panier = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "iii", $nouv_quantite, $ID_utilisateur, $ID_panier);
            mysqli_stmt_execute($stmt);

            // Rediriger l'utilisateur vers la page du panier après la modification
            header("Location: panier.php");
            exit();
        } else {
            echo "Utilisateur non connecté.";
        }
    } else {
        echo "Données manquantes pour modifier le panier.";
    }
} else {
    echo "Méthode de requête non autorisée ou formulaire non soumis.";
}
?>
