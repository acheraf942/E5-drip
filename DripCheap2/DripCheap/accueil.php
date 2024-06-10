<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Mon Site</title>
    <style>
        /* Reset des styles par défaut */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* En-tête */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            text-align: center;
        }

        nav ul li {
            display: inline;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
        }

        /* Hero section */
        .hero {
            background-image: url('background.jpg');
            background-size: cover;
            text-align: center;
            padding: 100px 0;
            color: #000000;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #555;
        }

        /* Features section */
        .features {
            padding: 50px 0;
            text-align: center;
        }

        .features h2 {
            margin-bottom: 30px;
        }

        .feature {
            margin-bottom: 30px;
        }

        .feature img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
            <li><a href="accueil.php">Accueil</a></li>
                <li><a href="boutique.php">Boutique</a></li>
                <li><a href="panier.php">Panier</a></li>
                <li><a href="recup_commande.php">Mes commandes</a></li>
                <?php if (isset($_SESSION['ID_utilisateur'])): ?>
                    <li>Bonjour, <?php echo htmlspecialchars($_SESSION['Prénom']); ?></li>
                <?php else: ?>
                    <li><a href="login.html">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <h1>Bienvenue sur Drip cheap</h1>
        <p>Découvrez notre sélection de produits de qualité.</p>
        <a href="boutique.php" class="btn">Explorer</a>
    </section>
    <section class="features">
        <h2>Nos avantages</h2>
        <div class="feature">
            <img src="img1.jpeg" alt="Avantage 1">
            <h3>Livraison gratuite</h3>
            <p>Profitez de la livraison gratuite sur toutes les commandes.</p>
        </div>
        <div class="feature">
            <img src="img2.jpeg" alt="Avantage 2">
            <h3>Produits de qualité</h3>
            <p>Nous proposons des produits de haute qualité.</p>
        </div>
        <div class="feature">
            <img src="img3.png" alt="Avantage 3">
            <h3>Service clientèle</h3>
            <p>Notre équipe est à votre disposition pour répondre à vos questions.</p>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Mon Site. Tous droits réservés.</p>
    </footer>
</body>
</html>
