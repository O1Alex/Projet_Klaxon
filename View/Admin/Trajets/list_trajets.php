<?php
require_once "../../Controller/TrajetController.php";
require_once "../../Model/Trajet.php";
require_once "../../Controller/AgenceController.php";

$trajetController=new TrajetController();
$trajets=$trajetController->getAllTrajets();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des trajets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
 <!-- Tableau des trajets -->
    <div class="container mt-5 justify-content-center">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">    
                <tr>
                    <th>Départ</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Places totales</th>
                    <th>Place disponible</th>
                    <th></th>
                </tr>
            </thead>

            <?php foreach($trajets as $trajet){
                $dep = new DateTime($trajet['departure_date']);
                $arr = new DateTime($trajet['arrival_date']);?>
                <tr>
                    <td><?php echo $trajet['start_city']?></td>
                    <td><?php echo $dep->format('Y-m-d')?></td>
                    <td><?php echo $dep->format('H:i')?></td>
                    <td><?php echo $trajet['end_city']?></td>
                    <td><?php echo $arr->format('Y-m-d')?></td>
                    <td><?php echo $arr->format('H:i')?></td>
                    <td><?php echo $trajet['total_seats']?></td>
                    <td><?php echo $trajet['available_seats']?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>