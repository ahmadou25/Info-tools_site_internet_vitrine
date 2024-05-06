<!doctype html>
<html >
  <head>
    <title>Page10</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
       
        .product-card img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(4, 2fr);
            gap: 20px;
            margin-bottom:40px;
        }

        .product-card {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: left;
            
        }
        form {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size:3em;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 16px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: rgb(250, 205, 6);
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
       

    </style>
    </head>
  <body>
  <?php
try {
    $mysqlConnection = new PDO(
        'mysql:host=localhost;dbname=infotool;charset=utf8',
        'root',
        'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Formulaire de recherche
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';
$queryFiltered = "SELECT * FROM product WHERE Product_Name LIKE :searchTerm";
$statementFiltered = $mysqlConnection->prepare($queryFiltered);
$statementFiltered->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
$statementFiltered->execute();
$productsFiltered = $statementFiltered->fetchAll(PDO::FETCH_ASSOC);

// Liste de tous les produits
$queryAll = "SELECT * FROM product";
$statementAll = $mysqlConnection->query($queryAll);
$productsAll = $statementAll->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Formulaire de recherche -->
<form action="" method="GET">
    <label for="search">Rechercher un produit dans  Info-Tools:</label>
    <input type="text" name="search" id="search" placeholder="Entrez le nom du produit">
    <button type="submit">Rechercher</button>
</form>

<!-- Produits filtrés -->
<?php if (count($productsFiltered) > 0) : ?>
    <div class="product-grid">
        <?php foreach ($productsFiltered as $product) : ?>
            <div class="product-card">
                <img class= "imgbdbd"src="imgdb/<?= $product['Image']; ?>" alt="<?= $product['Product_Name']; ?>">
                <h3><?= $product['Product_Name']; ?></h3>
                <p><?= $product['Description']; ?></p>
                <p>Prix: <?= $product['Price']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Tous les produits -->
<div class="product-grid">
    <?php foreach ($productsAll as $product) : ?>
        <div class="product-card">
            <img class= "imgbdbd" src="imgdb/<?= $product['Image']; ?>" alt="<?= $product['Product_Name']; ?>">
            <h3><?= $product['Product_Name']; ?></h3>
            <p><?= $product['Description']; ?></p>
            <p>Prix: <?= $product['Price']; ?></p>
        </div>
    <?php endforeach; ?>
</div>
