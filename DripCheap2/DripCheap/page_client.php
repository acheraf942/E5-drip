<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Drop Cheap - Espace Client</title>
  <style>
    /* Styles CSS */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
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
      max-width: 800px;
      margin: 20px auto;
      padding: 0 20px;
    }
    .btn {
      display: inline-block;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s;
      margin-right: 10px;
    }
    .btn:hover {
      background-color: #555;
    }
    .product {
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 20px;
    }
    .product img {
      max-width: 100%;
      height: auto;
      margin-bottom: 10px;
    }
    .logout {
      position: absolute;
      top: 10px;
      right: 10px;
    }
    .logout a {
  color: #fff;
  background-color: #f00; /* Rouge */
  padding: 5px 10px;
  border-radius: 5px;
  text-decoration: none;
}

.logout a:hover {
  background-color: #d00; /* Rouge plus foncé au survol */
}
  </style>
</head>
<body>
  <header>
    <h1>Espace Client</h1>
    <div class="logout">
      <a href="deconnexion.php">Déconnexion</a>
    </div>
  </header>
  <div class="container">
    <h2>Produits recommandés</h2>
    <div class="product">
      <img src="image_produit1.jpg" alt="Produit 1">
      <h3>Nom du produit 1</h3>
      <p>Description du produit 1</p>
      <p>Prix : 20 €</p>
      <a href="#" class="btn">Ajouter au panier</a>
    </div>
    <div class="product">
      <img src="image_produit2.jpg" alt="Produit 2">
      <h3>Nom du produit 2</h3>
      <p>Description du produit 2</p>
      <p>Prix : 25 €</p>
      <a href="#" class="btn">Ajouter au panier</a>
    </div>
    <!-- Ajoutez d'autres produits recommandés -->
  </div>
</body>
</html>
