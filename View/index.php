<?php

require_once "../Controller/TrajetController.php";
$trajetController=new TrajetController();
$trajets=$trajetController->getDisponibleTrajet();

//verifier que le bouton details est cliqué
$showModal=isset($_GET['id']);
$modalTrajetId=$_GET['id']?? 0;
$modalDetails=$trajetController->getDetailsTrajet($modalTrajetId)

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php' ?>

    <!-- Tableau des trajets -->
    <table>
        <tr>
            <th>Ville départ</th>
            <th>Ville d'arrivé</th>
            <th>Date départ</th>
            <th>Date d'arrivé</th>
            <th>Total des places</th>
            <th>Places disponibles</th>
            <th>Actions</th>
        </tr>


        <?php foreach($trajets as $trajet){?>
            <tr>
                <td><?php echo $trajet['start_city']?></td>
                <td><?php echo $trajet['end_city']?></td>
                <td><?php echo $trajet['departure_date']?></td>
                <td><?php echo $trajet['arrival_date']?></td>
                <td><?php echo $trajet['total_seats']?></td>
                <td><?php echo $trajet['available_seats']?></td>
                <td><a href="index.php?id=<?php echo $trajet['id']?>"><button>Details</button></a></td>

                <?php if(isset($_SESSION['user_id'])){?>
                    <?php $isAuthor=$trajetController->isAuthor($_SESSION['user_id'],$trajet['id']) ?>
                        <?php if ($isAuthor){?>
                            <td> <a href="edit_trajet.php?id=<?php echo $trajet['id']?>"><button>Modifier</button></a></td>
                            <td>
                                <form action="delete_trajet.php" method="POST">
                                    <input type="hidden" name="trajet_id" value="<?php echo $trajet['id']?>">
                                    <button type="submit" onclick="return confirm('supprimer?')">Supprimer</button>
                                </form>
                            </td>
                <?php }}?>
            </tr>
        <?php } ?>
    </table>
    
    <!-- Modale -->
    <?php if($showModal && $modalDetails){?>
        <div class="modal fade show" tabindex="-1" aria-modal="true" style="display:block">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <a href="index.php" class="btn-close"></a>
                    </div>
    
                    <div class="modal-body">
                        <p><strong>Contact : </strong> <?php echo $modalDetails['first_name']?><?php echo $modalDetails['last_name']?></p>
                        <p><strong> Téléphone : </strong><?php echo $modalDetails['phone']?></p>
                        <p><strong>Email : </strong><?php echo $modalDetails['email']?></p>
                        <p><strong>Nombre total de places : </strong><?php echo $modalDetails['total_seats']?></p>
                    </div>
    
                    <div class="modal-footer">
                        <a href="index.php" class="btn btn-secondary">Fermer</a>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
</body>
</html>