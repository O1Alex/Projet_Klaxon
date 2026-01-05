<?php

require_once "../Controller/TrajetController.php";
require_once "../Controller/AgenceController.php";
require_once "../Model/Trajet.php";


session_start();

//Vérification connexion de l'utilisateur
if(!isset($_SESSION['user_id'])){
    header('Location:Connexion.php');
    exit();
}

$trajetController=new TrajetController();

$trajetId=$_GET['id'];
$trajetDetails=$trajetController->getDetailsTrajet($trajetId);

//Vérification existance du trajet
if(!$trajetDetails){
    header('Location:homepage.php');
    exit();
}

//Vérification appartenance du trajet de l'utilisateur
if(!$trajetController->isAuthor($_SESSION['user_id'],$trajetId) && $_SESSION['user_role']!='admin'){
    header('Location:index.php');
    exit();
}

//Récupération du trajet et modification
$agenceController=new AgenceController();
$agences=$agenceController->getAllAgences();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $trajet=new Trajet();
    $trajet->setStartAgencyId($_POST['start_agency_id']);
    $trajet->setEndAgencyId($_POST['end_agency_id']);
    $trajet->setDepartureDate($_POST['departure_date']);
    $trajet->setArrivalDate($_POST['arrival_date']);
    $trajet->setTotalSeats($_POST['total_seats']);
    $trajet->setAvailableSeats($_POST['available_seats']);
    $trajet->setPersonContactId($_SESSION['user_id']);
        
        
    $result= $trajetController->updateUserTrajet($trajet,$_SESSION['user_id'],$trajetId);

     if ($result['success']) {
    $_SESSION['flash_success'] = "Le trajet a été modifié avec succès";
    header('Location: homepage.php');
    exit();
}

    else{
     $errors=$result['errors']   ;
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
    <title>Modifier le trajet</title>
</head>

<body class="edit d-flex flex-column min-vh-100">
    <?php include 'header.php' ?>

    <main class="flex-fill container my-5">
        <h2 class="edit-title text-center mb-4">Modifier le trajet</h2>

        <!-- Erreurs -->
        <?php if (!empty($errors)) : ?>
            <?php foreach ($errors as $error) : ?>
                <div class="alert alert-warning">
                    <?= $error ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Formulaire -->
        <form method="POST" class="form-admin mx-auto">

            <!-- Agence de départ -->
            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Agence de départ</label>
                <div class="col-md-8">
                    <select name="start_agency_id" class="form-select" required>
                        <?php foreach ($agences as $agence) : ?>
                            <option value="<?= $agence['id'] ?>"
                                <?= $agence['id'] == $trajetDetails['start_agency_id'] ? 'selected' : '' ?>>
                                <?= $agence['city_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Agence d'arrivée -->
            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Agence d’arrivée</label>
                <div class="col-md-8">
                    <select name="end_agency_id" class="form-select" required>
                        <?php foreach ($agences as $agence) : ?>
                            <option value="<?= $agence['id'] ?>"
                                <?= $agence['id'] == $trajetDetails['end_agency_id'] ? 'selected' : '' ?>>
                                <?= $agence['city_name'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Date/Heure de Départ -->
            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Date et heure de départ</label>
                <div class="col-md-8">
                    <input type="datetime-local" class="form-control" name="departure_date"
                    value="<?= date('Y-m-d\TH:i', strtotime($trajetDetails['departure_date'])) ?>"required>
                </div>
            </div>

            <!-- Date/Heure d'Arrivée -->
            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Date et heure d’arrivée</label>
                <div class="col-md-8">
                    <input type="datetime-local" class="form-control" name="arrival_date"
                    value="<?= date('Y-m-d\TH:i', strtotime($trajetDetails['arrival_date'])) ?>" required>
                </div>
            </div>

            <!-- Places totale -->
            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Places totales</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="total_seats" min="1"
                           value="<?= $trajetDetails['total_seats'] ?>" required>
                </div>
            </div>

            <!-- Place disponible -->
            <div class="row align-items-center">
                <label class="col-md-4 col-form-label">Places disponibles</label>
                <div class="col-md-8">
                    <input type="number" class="form-control" name="available_seats" min="0"
                           value="<?= $trajetDetails['available_seats'] ?>" required>
                </div>
            </div>

            <!-- Boutons -->
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