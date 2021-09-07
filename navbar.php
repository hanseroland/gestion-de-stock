<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="config/css/all.css"  /> 
      <!-- Bootstrap core CSS -->
    <link href="config/bootstrap/css/bootstrap.min.css" rel="stylesheet"  >
    <link rel="stylesheet" href="config/css/style.css">
    <title>Navbar</title>
</head>
<body>
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                        <div class="d-flex align-items-center" id="menu-toggle"  >
                             <i  class="fas fa-align-left primary-text fs-5 me-3" > </i>
                        </div>

                        <button class="navbar-toggler bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
                            <span class="navabar-toggle-icon"></span>

                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item-dropdown">
                                    <a href="#" class="nav-link dropdown-toggle text-white second-text fw-bol" id="navbarDropdown" 
                                        role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                    >
                                        <i class="fas fa-user me-2"></i> 
                                        <?php  echo((isset($_SESSION['PROFILE']))?($_SESSION['PROFILE']['nom']):"") ?>
                                    </a>
                                    <ul class="dropdown-menu"  aria-labelledby="navbarDoprdown">
                                        <li><a href="#" class="dropdown-item">Historique</a></li>
                                        <li><a href="logout.php" class="dropdown-item">Déconnexion</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                </nav>
              
</body>
</html>