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
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Créer un trajet</title>
</head>
<body class="create d-flex flex-column min-vh-100">
    <?php include 'header.php' ?>

    <main class="flex-fill container my-5">
        <h2 class="create-title text-center mb-4">Proposer un trajet</h2>

        <!-- Erreurs -->
        <?php if (!empty($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <div class="alert alert-warning">
                    <?= $error ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Informations utilisateur -->
        <div class="info-user mx-auto mb-4 px-3 py-1 text-center">
            <h4 class="create-title mb-3 ">Vos informations de contact</h4>
            <p><strong>Nom :</strong> <?= $_SESSION['user_name'] ?></p>
            <p><strong>Email :</strong> <?= $_SESSION['user_email'] ?></p>
            <p><strong>Téléphone :</strong> <?= $_SESSION['user_phone'] ?></p>
        </div>

        <!-- Formulaire -->
        <form method="POST" class="form-admin mx-auto">

            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Agence de départ</label>
                <div class="col-md-8">
                    <select name="start_agency_id" class="form-select" required>
                        <option value="">Sélectionnez une agence</option>
                        <?php foreach ($agences as $agence) : ?>
                            <option value="<?= $agence['id'] ?>">
                                <?= $agence['city_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Agence d’arrivée</label>
                <div class="col-md-8">
                    <select name="end_agency_id" class="form-select" required>
                        <option value="">Sélectionnez une agence</option>
                        <?php foreach ($agences as $agence) : ?>
                            <option value="<?= $agence['id'] ?>">
                                <?= $agence['city_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Date de départ</label>
                <div class="col-md-8">
                    <input type="datetime-local"
                           name="departure_date"
                           class="form-control"
                           required>
                </div>
            </div>

            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Date d’arrivée</label>
                <div class="col-md-8">
                    <input type="datetime-local"
                           name="arrival_date"
                           class="form-control"
                           required>
                </div>
            </div>

            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Places totales</label>
                <div class="col-md-8">
                    <input type="number" name="total_seats" class="form-control" min="1" required>
                </div>
            </div>

            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Places disponibles</label>
                <div class="col-md-8">
                    <input type="number" name="available_seats" class="form-control" min="0" required>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn-save py-2 px-4">
                    Enregistrer
                </button>

                <a href="index.php" class="btn-cancel py-2 px-4">
                    Annuler
                </a>
            </div>

        </form>
    
    </main>
    <?php include 'footer.php' ?>

</body>
</html>