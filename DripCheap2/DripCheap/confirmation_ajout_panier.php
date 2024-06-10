<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation d'ajout au panier</title>
  <style>
    /* Styles CSS */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
    }
    p {
      text-align: center;
    }
    .btn {
      display: block;
      width: 100%;
      max-width: 200px;
      margin: 20px auto;
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      text-align: center;
      text-decoration: none;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Confirmation d'ajout au panier</h1>
    <p>L'article a été ajouté à votre panier avec succès !</p>
    <a href="panier.php" class="btn">Voir le panier</a>
  </div>
</body>
</html>