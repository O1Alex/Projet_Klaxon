<?php
session_start();
require_once "../Controller/TrajetController.php";
require_once "../Model/Trajet.php";
require_once "../Controller/AgenceController.php";

//Vérification connexion de l'utilisateur
if(!isset($_SESSION['user_id'])){
    header('Location:Connexion.php');
    exit();
}

$trajetController=new TrajetController();

$agenceController=new AgenceController();
$agences=$agenceController->getAllAgences();


//Création trajet
if($_SERVER['REQUEST_METHOD']=='POST'){
    $trajet=new Trajet();
    $trajet->setStartAgencyId($_POST['start_agency_id']);
    $trajet->setEndAgencyId($_POST['end_agency_id']);
    $trajet->setDepartureDate($_POST['departure_date']);
    $trajet->setArrivalDate($_POST['arrival_date']);
    $trajet->setTotalSeats($_POST['total_seats']);
    $trajet->setAvailableSeats($_POST['available_seats']);
    $trajet->setPersonContactId($_SESSION['user_id']);

    $result=$trajetController->createTrajet($trajet);

    if($result['success']){
        header('Location:index.php?created=1');
        exit();
    }
    else{
        $errors=$result['errors'];
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un trajet</title>
</head>
<body>
    <?php include 'header.php'?>
    <h2>Proposer un trajet</h2>
    
    <!-- Erreurs -->
    <?php if(isset($errors)){?>
        <?php foreach ($errors as $error){?>
            <?php echo $error ?>
        <?php }}?>

    <!-- Informations non modifiable -->
    <h3>Vos informations de  contact</h3>
    <p><strong>Nom : </strong> <?php echo $_SESSION['user_name'] ?>
    <p><strong>Email : </strong> <?php echo $_SESSION['user_email'] ?>
    <p><strong>Numéro de téléphone : </strong> <?php echo $_SESSION['user_phone'] ?>
    
    <!-- Fomulaire de création -->
    <form method="POST">
        <label>Agence de départ :</label>
        <select name="start_agency_id">
            <option value="">Sélectionnez une agence </option>
            <?php foreach($agences as $agence){?>
                <option value="<?php echo $agence['id']?>">
                <?php echo $agence['city_name']?></option>
            <?php } ?>
        </select>
        <br>

        <label>Agence d'arrivé :</label>
        <select name="end_agency_id">
            <option value="">Sélectionnez une agence </option>
            <?php foreach($agences as $agence){?>
                <option value="<?php echo $agence['id']?>">
                <?php echo $agence['city_name']?></option>
            <?php } ?>
        </select>
        <br>

        <label>Date de départ </label>
        <input type="datetime-local" name="departure_date" required>
        <br>

        <label>Date d'arrivé </label>
        <input type="datetime-local" name="arrival_date" required>       
        <br>

        <label>Nombre total des places :</label>
        <input type="number" name="total_seats" required>
        <br>

        <label>Nombre de places disponibles:</label>
        <input type="number" name="available_seats" required>
        <br>

        <button type="submit">Créer le trajet</button>
        <a href="index.php"><button>Annuler</button></a>       
    </form>
</body>
</html>