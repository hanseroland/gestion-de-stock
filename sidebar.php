<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="config/css/all.css"  /> 
  <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
      <!-- Bootstrap core CSS -->
    <link href="config/bootstrap/css/bootstrap.min.css" rel="stylesheet"  >
    <link rel="stylesheet" href="config/css/style.css">
    <title>Sidebar</title>
</head>
<body>
     <!--Début barre lattérale-->
             <div class="bg-secondary" id="sidebar-wrapper" >
                <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"  >
                        <i class="fa fa-desktop me-2" ></i> 
                        Gestion de stock
                </div>

                <div class="list-group list-group-flush my-3">
                    <a href="index.php" class="list-group-item  list-group-item-action second-text bg-transparent active">
                            <i class="fas fa-tachometer-alt me-2"></i> Tableau de bord
                    </a>
                    <a href="utilisateurs.php" class="list-group-item  list-group-item-action second-text bg-transparent fw-bold">
                            <i class="fa fa-users me-2"></i> Utilisateurs
                    </a>
                    <a href="categories.php" class="list-group-item  list-group-item-action second-text bg-transparent fw-bold">
                            <i class="fa fa-list-alt me-2"></i> Catégories
                    </a>
                    <a href="articles.php" class="list-group-item  list-group-item-action second-text bg-transparent fw-bold">
                            <i class="fas fa-box  me-2"></i> Articles
                    </a>
                    <a href="ventes.php" class="list-group-item  list-group-item-action second-text bg-transparent fw-bold">
                            <i class="fa fa-shopping-cart me-2"></i> Ventes
                    </a>
                    <a href="commandes.php" class="list-group-item  list-group-item-action second-text bg-transparent fw-bold">
                            <i class="fa fa-cart-arrow-down me-2"></i> Commandes
                    </a>
                    <a href="mouvements.php" class="list-group-item  list-group-item-action second-text bg-transparent fw-bold">
                            <i class="fa fa-percent me-2"></i> Mouvements
                    </a>
                    <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-white fw-bold"><i
                        class="fas fa-power-off me-2"></i>Déconnexion</a>

                </div>
            </div>
        <!--Fin barre lattérale-->
</body>
</html>