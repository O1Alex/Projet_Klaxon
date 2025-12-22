<?php

require_once "../Controller/TrajetController.php";

$trajetController=new TrajetController();
$trajets=$trajetController->getDisponibleTrajet();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Page d'accueil</title>
</head>
<body>
    <?php include 'header.php' ?>

     <!-- Tableau des trajets -->
    <table>
        <tr>
            <th>Ville de départ</th>
            <th>Date de départ</th>
            <th>Ville d'arrivée</th>
            <th>Date d'arrivée</th>
            <th>Places disponibles</th>
        </tr>


        <?php foreach($trajets as $trajet){?>
            <tr>
                <td><?php echo $trajet['start_city']?></td>
                <td><?php echo $trajet['departure_date']?></td>
                <td><?php echo $trajet['end_city']?></td>
                <td><?php echo $trajet['arrival_date']?></td>
                <td><?php echo $trajet['available_seats']?></td>
            </tr>
        <?php } ?>
   </table>

</body>
</html>