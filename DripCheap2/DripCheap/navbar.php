<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
</head>
<body>
  <nav>
    <ul>
    <li><a href="accueil.php">Accueil</a></li>
      <li><a href="boutique.php">Produits</a></li>
      <li><a href="panier.php">Panier</a></li>
      <li><a href="recup_commande.php">Mes commandes</a></li>
      <?php if (isset($_SESSION['ID_utilisateur'])): ?>
        <li><span class="welcome">Bonjour, <?php echo htmlspecialchars($_SESSION['Prénom']); ?></span></li>
        <span class="logout"><li><a href="deconnexion.php">Déconnexion</span></a></li>
      <?php else: ?>
        <li><a href="login.html">Connexion</a></li>
      <?php endif; ?>

    </ul>
  </nav>
</body>
</html>
