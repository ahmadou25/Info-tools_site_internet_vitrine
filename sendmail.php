<?php
try {
    $mysqlConnection = new PDO(
        'mysql:host=localhost;dbname=infotool;charset=utf8',
        'root',
        'root',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    // Récupérer les données du formulaire
    $lastname = isset($_POST['Nom']) ? $_POST['Nom'] : '';
    $firstname = isset($_POST['Prenom']) ? $_POST['Prenom'] : '';
    $email = isset($_POST['Email']) ? $_POST['Email'] : '';
    // Nouveaux champs pour l'adresse
    $street = isset($_POST['Numero_de_rue']) ? $_POST['Numero_de_rue'] : '';
    $postalCode = isset($_POST['Code_postal']) ? $_POST['Code_postal'] : '';
    $city = isset($_POST['Ville']) ? $_POST['Ville'] : '';
    $country = isset($_POST['Pays']) ? $_POST['Pays'] : '';
    $phone_number = isset($_POST['Numero_de_telephone']) ? $_POST['Numero_de_telephone'] : '';
    $message = isset($_POST['Message']) ? $_POST['Message'] : '';

    // Préparer la requête SQL
    $sql = "INSERT INTO prospect (Lastname, Firstname, Email, Street, PostalCode, City, Country, Phone_Number, message)
            VALUES (:lastname, :firstname, :email, :street, :postalCode, :city, :country, :phone_number,:message)";

    // Préparer la requête pour l'exécution
    $stmt = $mysqlConnection->prepare($sql);

    // Binder les paramètres
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':street', $street);
    $stmt->bindParam(':postalCode', $postalCode);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':phone_number', $phone_number);
    $stmt->bindParam(':message', $message);

    // Exécuter la requête
    $stmt->execute();

    // Redirection vers la page de confirmation
    header("Location: confirmation.html");
    exit();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
} finally {
    // Fermer la connexion
    $mysqlConnection = null;
}
?>



