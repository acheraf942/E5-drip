<?php
session_start();

// Vérifiez si l'utilisateur est administrateur (ajustez cette partie selon votre logique d'autorisation)
if (!isset($_SESSION['ID_utilisateur']) || $_SESSION['type'] !== 'gerant') {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $ID_article = intval($_POST['ID_article']);
    $nouveau_stock = intval($_POST['nouveau_stock']);

    // Requête SQL pour mettre à jour le stock de l'article
    $sql = "UPDATE Articles SET Stock = ? WHERE ID_article = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $nouveau_stock, $ID_article);

    // Exécuter la requête
    if (mysqli_stmt_execute($stmt)) {
        // Stock mis à jour avec succès
        $message = "Stock mis à jour avec succès.";
        $message_class = "success";
    } else {
        // Erreur lors de la mise à jour du stock
        $message = "Erreur lors de la mise à jour du stock.";
        $message_class = "error";
    }

    // Fermer la connexion
    mysqli_stmt_close($stmt);
    mysqli_close($con);

    // Rediriger vers la page de gestion des stocks avec un message
    $_SESSION['message'] = $message;
    $_SESSION['message_class'] = $message_class;
    header("Location: gerer_stock.php");
    exit();
} else {
    // Rediriger vers la page de gestion des stocks si le formulaire n'a pas été soumis
    header("Location: gerer_stock.php");
    exit();
}
?>