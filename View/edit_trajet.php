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

    if($result['success']){
        header('Location:index.php?updated=1');
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Modifier le trajet</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php include 'header.php'?>
    
    <main class="flex-fill d-flex align-items-center justify-content-center">

        <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
            <div class="card-body">
                <h3 class="card-title mb-4 text-center">
                    Modifier une agence
                </h3>

                <!-- Erreurs -->
                <?php if(isset($errors)){?>
                    <?php foreach ($errors as $error){?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php }} ?>

                <!-- Formulaire de modification du trajet -->
                <form method="POST">
                    <div class="mb-3">
                        <label>Agence de départ</label>
                        <select name="start_agency_id" required>
                            <?php foreach($agences as $agence){?>
                                <option value="<?php echo $agence['id']?>"
                                <?php echo ($agence['id'] == $trajetDetails['start_agency_id']) ? 'selected' : '';?>>
                                <?php echo $agence['city_name']?>
                                </option>
                            <?php }?>
                        </select>
                        <br>

                        <label>Agence d'arrivé</label>
                        <select name="end_agency_id" required>
                            <?php foreach($agences as $agence){?>
                                <option value="<?php echo $agence['id']?>"
                                <?php echo ($agence['id'] == $trajetDetails['end_agency_id']) ?'selected' : '';?>>
                                <?php echo $agence['city_name']?>
                                </option>
                            <?php }?>    
                        </select>
                        <br>

                        <label> Date et heure d'arrivé </label>
                        <input type="datetime-local" name="departure_date" value="<?php echo date('Y-m-d\TH:i',strtotime($trajetDetails['departure_date']))?>" required>
                            <br>
                            
                        <label> Date et heure d'arrivé </label>
                        <input type="datetime-local" name="arrival_date" value="<?php echo date('Y-m-d\TH:i',strtotime($trajetDetails['arrival_date']))?>" required>
                        <br>

                        <label>Nombre total des places</label>
                        <input type="number" name="total_seats" min="1" value="<?php echo $trajetDetails['total_seats']?>" required>
                        <br>

                        <label>Nombre des places disponibles</label>
                        <input type="number" name="available_seats" min="0" value="<?php echo $trajetDetails['available_seats']?>" required>
                        <br>

                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-dark">
                                Enregistrer les modifications
                            </button>

                            <a href="index.php"
                            class="btn btn-outline-secondary">
                                Annuler
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include "footer.php"; ?>
</body>
</html>