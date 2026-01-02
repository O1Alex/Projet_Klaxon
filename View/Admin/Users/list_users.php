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
    <title>Liste des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <main class="container my-5">

        <h2 class="mb-4">Liste des utilisateurs</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">    
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                
                <tbody>
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