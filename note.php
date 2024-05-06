http://172.31.200.2/contact.html

<table class="table">
    <thead>
        <tr>
            <th>Numero du produit</th>
            <th>Nom</th>
            <th>Description</th>                   
            <th>Prix</th>
            <th>Quantite disponible</th>
        </tr>
    </thead>

<?php
while($donnees = $reponse->fetch())
{
?>
    <tbody> 
        <tr>
            <td><?php echo $donnees['ID_Product']; ?></td>
            <td><?php echo $donnees['Product_Name']; ?></td>
            <td><?php echo $donnees['Description']; ?></td>
            <td><?php echo $donnees['Price']; ?></td>
            <td><?php echo $donnees['Stock_Quantity']; ?></td>
        </tr>
    </tbody> 
<?php
}

// Fermez le curseur
$reponse->closeCursor();
?>


table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

<!-- Formulaire de recherche -->
<form action="" method="GET">
    <label for="search">Rechercher par nom :</label>
    <input type="text" name="search" id="search" placeholder="Entrez le nom du produit">
    <button type="submit">Rechercher</button>
</form>

29/11/2023

<?php
try {
    $mysqlConnection = new PDO( 
        'mysql:host=localhost;dbname=infotool;charset=utf8',
        'root',
        'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// Utilisez $mysqlConnection au lieu de $bdd pour exécuter la requête SQL
$reponse = $mysqlConnection->query('SELECT * FROM product');
?>
<!-- Formulaire de recherche -->
<form action="" method="GET">
    <label for="search">Rechercher par nom :</label>
    <input type="text" name="search" id="search" placeholder="Entrez le nom du produit">
    <button type="submit">Rechercher</button>
</form>
<?php
    $query = "SELECT * FROM product WHERE Product_Name LIKE :searchTerm";
    $statement = $mysqlConnection->prepare($query);
    $statement->bindParam(':searchTerm', $searchTerm, PDO::PARAM_STR);
    $statement->execute();
    $reponse = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        // ...
    $reponse = $mysqlConnection->query($query);

    if ($reponse->rowCount() > 0) {
        while ($donnees = $reponse->fetch()) {
            // Affichage des résultats
        }
    } else {
        echo "Aucun résultat trouvé.";
    }
    ?>



<div class="product-grid">
    <?php
    while ($donnees = $reponse->fetch()) {
    ?>
        <div class="product-card">
            <img src="imgdb/<?= $donnees['Image']; ?>" alt="<?= $donnees['Product_Name']; ?>">
            <h3><?= $donnees['Product_Name']; ?></h3>
            <p><?= $donnees['Description']; ?></p>
            <p>Prix: <?= $donnees['Price']; ?></p>
        </div>
    <?php
    }
    ?>
</div>

<?php
// Fermez le curseur
$reponse->closeCursor();
?>
