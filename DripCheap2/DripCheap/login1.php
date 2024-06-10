<?php
session_start(); 
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "DRIP1");

// Vérifier la connexion
if ($con === false) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $mail = $_POST["Adresse_email"]; 
    $mdp = $_POST["Mot_de_passe"];
    
    // Requête SQL pour vérifier les informations de connexion
    $sql = "SELECT ID_utilisateur, Prénom, type FROM Utilisateurs WHERE Adresse_email = '$mail' AND Mot_de_passe = '$mdp'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // L'utilisateur est connecté avec succès, définir les variables de session
        $row = mysqli_fetch_assoc($result);
        $_SESSION['ID_utilisateur'] = $row['ID_utilisateur'];
        $_SESSION['Prénom'] = $row['Prénom'];
        $_SESSION['type'] = $row['type'];

        // Redirection en fonction du type d'utilisateur
        if ($row['type'] == "gerant") {
            header("Location: page_gerant.php");
        } else {
            header("Location: boutique.php");
        }
        exit();
    } else {
        // Identifiants incorrects
        echo "Adresse e-mail ou mot de passe incorrect.";
    }

    mysqli_close($con);
}
?>

