<?php
require_once "../../Controller/UserController.php";

$userController=new UserController();
$users=$userController->getUser();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Liste des utilisateurs</title>
    
</head>
<body class="list d-flex flex-column min-vh-100">

    <main class="container-list container my-5">

        <h2 class="title-list mb-4 text-center">Liste des utilisateurs</h2>
        <div class="table-responsive">

            <!-- Tableau liste des utilisateurs -->
            <table class="table-list align-middle text-center">
                <thead class="table-head">    
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                
                <tbody class="table-body">
                <?php foreach($users as $user){?>
                    <tr>
                        <td><?php echo $user['last_name'] ?></td>
                        <td><?php echo $user['first_name'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['phone'] ?></td>
                        <td><?php echo $user['role'] ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>