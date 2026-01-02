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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>Document</title>
</head>
<body class="d-flex flex-column min-vh-100">

    <?php include 'header.php' ?>

    <main class="container my-5">

        <h2 class="mb-4">Trajets proposés</h2>
        <div class="table-responsive">

            <!-- Tableau des trajets -->
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Départ</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Places</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($trajets as $trajet) {
                    $dep = new DateTime($trajet['departure_date']);
                    $arr = new DateTime($trajet['arrival_date']);
                ?>
                    <tr>
                        <td><?= htmlspecialchars($trajet['start_city']) ?></td>
                        <td><?= $dep->format('d/m/Y') ?></td>
                        <td><?= $dep->format('H:i') ?></td>
                        <td><?= htmlspecialchars($trajet['end_city']) ?></td>
                        <td><?= $arr->format('d/m/Y') ?></td>
                        <td><?= $arr->format('H:i') ?></td>
                        <td><?= (int)$trajet['available_seats'] ?></td>

                        <td>
                            <div class="d-flex justify-content-center gap-3">

                                <!-- Affichage information du trajet (modale) -->
                                <a href="homepage.php?id=<?= $trajet['id'] ?>" class="text-dark">
                                    <i class="bi bi-eye fs-5"></i>
                                </a>

                                <?php if (isset($_SESSION['user_id'])) {
                                    $isAuthor = $trajetController->isAuthor($_SESSION['user_id'], $trajet['id']);
                                    if ($isAuthor) { ?>

                                    <!-- Modification du trajet -->
                                    <a href="edit_trajet.php?id=<?= $trajet['id'] ?>" class="text-dark">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </a>

                                    <!-- Suppression du trajet -->
                                    <form action="delete_trajet.php" method="POST" class="d-inline">
                                        <input type="hidden" name="trajet_id" value="<?= $trajet['id'] ?>">
                                        <button type="submit"
                                                class="btn p-0 text-dark"
                                                onclick="return confirm('Voulez-vous vraiment supprimer ce trajet ?')">
                                            <i class="bi bi-trash3 fs-5"></i>
                                        </button>
                                    </form>

                                <?php }} ?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>          
        

        <!-- Modale -->
        <?php if($showModal && $modalDetails){?>
            <div class="modal fade show" tabindex="-1" aria-modal="true" style="display:block">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <a href="homepage.php" class="btn-close"></a>
                        </div>
        
                        <div class="modal-body">
                            <p><strong>Auteur : </strong> <?php echo $modalDetails['first_name']?><?php echo $modalDetails['last_name']?></p>
                            <p><strong>Téléphone : </strong><?php echo $modalDetails['phone']?></p>
                            <p><strong>Email : </strong><?php echo $modalDetails['email']?></p>
                            <p><strong>Nombre total de places : </strong><?php echo $modalDetails['total_seats']?></p>
                        </div>
        
                        <div class="modal-footer">
                            <a href="homepage.php" class="btn btn-secondary">Fermer</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }?>
    </main>

    <?php include 'footer.php' ?>

</body>
</html>