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
    <title>Liste des agences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
    <div class="container mt-3">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">    
                <tr>
                    <th>Listes des différentes agences</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <?php foreach($agences as $agence){?>
                <tr>
                    <td><?php echo $agence['city_name'] ?></td>
                    <td>
                        <a href="Agences/edit_agence.php?id=<?php echo $agence['id']?>">
                            <i class="fa-solid fa-pen" style="color:black"></i>
                        </a>
                     
                        <form action="Agences/delete_agence.php" method="POST" >
                            <input type="hidden" name="id" value="<?php echo $agence['id']?>">
                            <button type="submit" onclick="return confirm('Voulez vous vraiment supprimer cette ville ?')" style="border:none;background:none">
                                <i class="fa-solid fa-trash" style="color:black"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</body>
</html>