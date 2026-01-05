<?php 

require_once __DIR__."/../../../Controller/TrajetController.php";


$trajetController=new TrajetController();
$trajets=$trajetController->getAllTrajetsAdmin();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Liste des trajets ADMIN</title>

</head>
<body class="list d-flex flex-column min-vh-100">

    <main class="container-list container my-5">

        <h2 class="title-list mb-4 text-center">Liste des trajets</h2>
        <div class="table-responsive">

        <!-- Tableau des trajets -->
            <table class="table-list align-middle text-center">
                <thead class="table-head">
                    <tr>
                        <th> Départ</th>
                        <th> Date</th>
                        <th> Heure</th>
                        <th> Destination</th>
                        <th> Date</th>
                        <th> Heure</th>
                        <th> Places total</th>
                        <th> Places disponibles</th>
                        <th> Personne à contacter</th>
                        <th>Email</th>
                        <th>Numéro de téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody class="table-body">
                    <?php foreach($trajets as $trajet){?>
                        <?php $dep=new DateTime($trajet['departure_date']);
                        $arr=new DateTime($trajet['arrival_date'])?>
                        <tr>
                            <td><?php echo $trajet['start_city']?></td>
                            <td><?php echo $dep->format('Y-m-d')?></td>
                            <td><?php echo $dep->format('H:i')?></td>
                            <td><?php echo $trajet['end_city']?></td>
                            <td><?php echo $arr->format('Y-m-d')?></td>
                            <td><?php echo $arr->format('H:i')?></td>
                            <td><?php echo $trajet['total_seats']?></td>
                            <td><?php echo $trajet['available_seats']?></td>
                            <td><?php echo $trajet['first_name']." ".$trajet['last_name']?></td>
                            <td><?php echo $trajet['email']?></td>
                            <td><?php echo $trajet['phone']?></td>
                        
                        <td>
                            <div class="d-flex justify-content-center">
                                <form action="Trajets/delete_trajet.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $trajet['id']?>">
                                    <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer ce trajet ?')" class="btn p-0 text-dark">
                                        <i class="bi bi-trash3 fs-5"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                        </tr>
                    <?php }?>
                </tbody>
            </table>
        <div>
    </main>
</body>
</html>