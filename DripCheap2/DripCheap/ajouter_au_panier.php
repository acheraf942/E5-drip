<?php
session_start();

// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");

// Vérifier la connexion
if ($con === false) {
    die(json_encode(['success' => false, 'message' => 'Erreur de connexion à la base de données']));
}

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['ID_utilisateur'])) {
    // Récupérer les données du formulaire
    $ID_article = intval($_POST['ID_article']);
    $quantite = intval($_POST['quantite']);

    // Ajouter l'article au panier
    $ID_utilisateur = $_SESSION['ID_utilisateur'];
    $sql = "INSERT INTO Panier (ID_utilisateur, ID_article, Quantité) VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE Quantité = Quantité + VALUES(Quantité)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $ID_utilisateur, $ID_article, $quantite);
    mysqli_stmt_execute($stmt);

    // Vérifier si l'ajout a réussi
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo json_encode(['success' => true, 'message' => 'Article ajouté au panier avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout au panier']);
    }

    // Fermer la connexion
    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
}
?>