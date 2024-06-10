<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav>
    <ul>
    <li><a href="page_gerant.php">Accueil gerant</a></li>
      <li><a href="gerer_produit.php">Gerer boutique</a></li>
      <li><a href="ajouter_article.php">Ajouter des articles</a></li>
      <li><a href="gerer_commande.php">Gerer commande</a></li>
      <li><a href="gerer_stock.php">Gerer le stock</a></li>
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
