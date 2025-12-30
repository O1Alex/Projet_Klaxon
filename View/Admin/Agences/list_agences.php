<?php
require_once "../../Controller/AgenceController.php";
require_once "../../Model/Agence.php";

$agenceController=new AgenceController();
$agences=$agenceController->getAllAgences();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des agences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">    
                <tr>
                    <th>Listes des différentes agences disponibles</th>
                </tr>
            </thead>

            <?php foreach($agences as $agence){?>
                <tr>
                    <td><?php echo $agence['city_name'] ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</body>
</html>