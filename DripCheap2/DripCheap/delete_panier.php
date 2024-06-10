<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['ID_utilisateur'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'ID du panier à supprimer a été envoyé
if (isset($_POST['ID_panier'])) {
    $ID_panier = intval($_POST['ID_panier']);

    // Connexion à la base de données
    $con = mysqli_connect("localhost", "root", "", "DRIP1");

    // Vérifier la connexion
    if ($con === false) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    // Requête SQL pour supprimer l'article du panier
    $sql = "DELETE FROM Panier WHERE ID_panier = ? AND ID_utilisateur = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $ID_panier, $_SESSION['ID_utilisateur']);
    mysqli_stmt_execute($stmt);

    // Vérifier si la suppression a réussi
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Suppression réussie, mise à jour de la session
        if (isset($_SESSION['panier'][$ID_panier])) {
            unset($_SESSION['panier'][$ID_panier]);
        }
        $_SESSION['message'] = "Article supprimé du panier avec succès.";
        $_SESSION['message_class'] = "success";
    } else {
        $_SESSION['message'] = "Erreur : Impossible de supprimer l'article du panier.";
        $_SESSION['message_class'] = "error";
    }

    // Fermer la connexion
    mysqli_stmt_close($stmt);
    mysqli_close($con);

    // Rediriger vers la page du panier avec un message de statut
    header("Location: panier.php");
    exit();
} else {
    $_SESSION['message'] = "Erreur : ID du panier manquant.";
    $_SESSION['message_class'] = "error";
    header("Location: panier.php");
    exit();
}
?>
