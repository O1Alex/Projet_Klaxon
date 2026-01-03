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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Créer un trajet</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php include 'header.php'?>
   
    <main class="flex-fill d-flex align-items-center justify-content-center">

        <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h3 class="card-title mb-4 text-center">
                    Proposer un trajet
                </h3>
                <!-- Erreurs -->
                <?php if(isset($errors)){?>
                    <?php foreach ($errors as $error){?>
                        <?php echo $error ?>
                    <?php }}?>

                <!-- Informations non modifiable -->
                <div class="mb-3">
                    <h4>Vos informations de  contact</h4>
                    <p><strong>Nom : </strong> <?php echo $_SESSION['user_name'] ?>
                    <p><strong>Email : </strong> <?php echo $_SESSION['user_email'] ?>
                    <p><strong>Numéro de téléphone : </strong> <?php echo $_SESSION['user_phone'] ?>
                </div>
                <!-- Fomulaire de création -->
                <form method="POST">
                    <div class="mb-3">
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
                    </div> 
                                   
                    <div class="d-flex justify-content-between mt-4">
                        <button type="submit" class="btn btn-dark">
                            Enregistrer le trajet
                        </button>

                        <a href="index.php"
                        class="btn btn-outline-secondary">
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include "footer.php" ?>

</body>
</html>