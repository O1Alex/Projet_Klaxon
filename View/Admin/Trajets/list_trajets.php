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
    <title>Liste des trajets ADMIN</title>

</head>
<body>
    <div class="container mt-5">
        <table class="table table-border table-striped">
            <thead class="table-dark">
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
                        <form action="Trajets/delete_trajet.php" method="POST" style="display:inline-block; margin:0;">
                            <input type="hidden" name="id" value="<?php echo $trajet['id']?>">
                            <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer ce trajet ?')" style="border:none;background:none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </button>
                        </form>
                    </td>

                </tr>
            <?php }?>
        </table>
    <div>
</body>
</html>