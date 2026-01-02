<?php
require_once __DIR__."/../../../Controller/AgenceController.php";
require_once __DIR__."/../../../Model/Agence.php";

$agenceController=new AgenceController();
$agences=$agenceController->getAllAgences();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <title>Liste des agences</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <main class="container my-5">

        <h2 class="mb-4 text-center">Liste des agences</h2>
        <!-- Bouton créer agence -->
        <div class="text-center mb-4">
            <a href="Agences/create_agence.php" class="btn btn-dark btn-lg px-5"> Créer une agence </a>
        </div>

        <!-- Tableau des agences -->
         <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Agences</th>
                        <th>Actions</th>
                    </tr>
                </thead>

            <?php foreach($agences as $agence){?>
                <tr>
                    <td><?php echo $agence['city_name'] ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-3 mt-3">
                            <a href="Agences/edit_agence.php?id=<?php echo $agence['id']?>" class="text-dark">
                                <i class="bi bi-pencil-square fs-5"></i>
                            </a>
                        
                            <form action="Agences/delete_agence.php" method="POST" class="d-inline" >
                                <input type="hidden" name="id" value="<?php echo $agence['id']?>">
                                <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer cette ville ?')" class="btn p-0 text-dark">
                                    <i class="bi bi-trash3 fs-5"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>

            </table>
        </div>
    </main>
</body>
</html>