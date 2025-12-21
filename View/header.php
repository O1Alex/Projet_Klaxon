<?php
session_start();
?>
<header>
    <!-- header à gauche -->
    <div style="float:left">
        <!-- Administrateur -->
        <?php 
        if(isset($_SESSION['user_id']) && $_SESSION['user_role']=='admin'){ ?>
            <h1><a href="admin_dashboard.php">KLAXON</a></h1>
        <?php } else { ?>
            <h1>KLAXON</h1>
        <?php } ?>
    </div>

    <!-- header à droite -->
    <div style="float:right">
        
        <!-- Utilisateur connecté -->
        <?php if(isset($_SESSION['user_id'])){ ?>

            <!-- Administrateur -->
            <?php if($_SESSION['user_role']=='admin'){ ?>
                <nav>
                    <a href="admin_dashboard.php?section=users">Utilisateurs</a>
                    <a href="admin_dashboard.php?section=agences">Agences</a>
                    <a href="admin_dashboard.php?section=trajets">Trajets</a>
                    <a href="Deconnexion.php">Déconnexion</a>
                </nav>

            <!-- Utilisateur normal -->
            <?php } else { ?>
                <div style="margin:0 20px">
                    <form style="display:inline" action="create_trajet.php">
                        <button type="submit">Proposer un trajet</button>
                    </form>
                    <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                    <a href="Deconnexion.php">Déconnexion</a>
                </div>
            <?php } ?>

        <!-- Utilisateur non connecté -->
        <?php } else { ?>
            <form action="Connexion.php">
                <button type="submit">Formulaire de Connexion</button>
            </form>
        <?php } ?>
    </div>
</header>