<?php 
    session_start();
    if(!$_SESSION['PROFILE']){
    header('Location:login.php');
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
      <!-- Bootstrap core CSS -->
    <link href="config/bootstrap/css/bootstrap.min.css" rel="stylesheet"  >
    <link rel="stylesheet" href="config/css/style.css">
    <title>Gestion de stock</title>
</head>
<body>
   
    <div class="d-flex" id="wrapper">
       
        <?php require('sidebar.php') ?>
        <!--Contenu de la page-->
            <div id="page-content-wrapper"> 
                <?php require('navbar.php') ?>
                <div class="container-fluid px-4">
                <?php require('compteurs.php') ?>
                    <h3 class="fs-4 mb-3">Tableau de bord</h3>
                    <div class="row g-3 my-2">
                        <div class="col-md-3">
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">
                                       <?=$nmbrArticle?>
                                    </h3>
                                    <p class="fs-5">Articles</p>
                                </div>
                                <i class="fas fa-box  fs-1 primary-text border rounded-full secondary-bg p-2"></i>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">
                                        <?=$nmbrCat?>
                                    </h3>
                                    <p class="fs-5">Catégories</p>
                                </div>
                                <i class="fa fa-list-alt fs-1 primary-text border rounded-full secondary-bg p-2"></i>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">
                                    <?=$nmbrEntree?>
                                    </h3>
                                    <p class="fs-5">Entrées du J</p>
                                </div>
                                <i class="fas fa-hand-holding fs-1 primary-text border rounded-full secondary-bg p-2"></i>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div>
                                    <h3 class="fs-2">
                                    <?=$nmbrSortie?>
                                    </h3>
                                    <p class="fs-5">Sorties du J</p>
                                </div>
                                <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-2"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <h5 class="text-white">Utilisateurs</h5>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div style="overflow:auto;white-space: nowrap;">
                                   
                                    <?php require('config/utilisateurs/userTable.php')   ?>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                        <h5 class="text-white">Catégories</h5>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div style="overflow:auto;white-space: nowrap;">
                                   
                                    <?php require('config/categorie/catTable.php')   ?>
                                </div>
                                
                            </div>
                        </div> 

                        <div class="col-md-6">
                        <h5 class="text-white">Montant total d'achat par mois</h5>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div >
                                   
                                    <?php require('config/mouvements/graphEntree.php')   ?>
                                </div>
                                
                            </div>
                        </div> 

                        <div class="col-md-6">
                        <h5 class="text-white">Quantite totale d'articles achetés par mois</h5>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div >
                                   
                                    <?php require('config/mouvements/graphQtE.php')   ?>
                                </div>
                                
                            </div>
                        </div> 
                        <div class="col-md-6">
                        <h5 class="text-white">Montant total de vente par mois</h5>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div >
                                   
                                    <?php require('config/mouvements/graphSortie.php')   ?>
                                </div>
                                
                            </div>
                        </div> 

                        <div class="col-md-6">
                        <h5 class="text-white">Quantite totale d'articles vendues par mois</h5>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div >
                                   
                                    <?php require('config/mouvements/graphQtS.php')   ?>
                                </div>
                                
                            </div>
                        </div> 

                        <div class="col-md-6">
                        <h5 class="text-white">Tous les articles</h5>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div >
                                   
                                    <?php require('config/articles/graphQte.php')   ?>
                                </div>
                                
                            </div>
                        </div> 


                    </div>
                 <!--  <div class="col">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Produits</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Television</td>
                                    <td>Jonny</td>
                                    <td>$1200</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Laptop</td>
                                    <td>Kenny</td>
                                    <td>$750</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Cell Phone</td>
                                    <td>Jenny</td>
                                    <td>$600</td>
                                </tr>
                                <tr>
                                    <th scope="row">4</th>
                                    <td>Fridge</td>
                                    <td>Killy</td>
                                    <td>$300</td>
                                </tr>
                                <tr>
                                    <th scope="row">5</th>
                                    <td>Books</td>
                                    <td>Filly</td>
                                    <td>$120</td>
                                </tr>
                                <tr>
                                    <th scope="row">6</th>
                                    <td>Gold</td>
                                    <td>Bumbo</td>
                                    <td>$1800</td>
                                </tr>
                                <tr>
                                    <th scope="row">7</th>
                                    <td>Pen</td>
                                    <td>Bilbo</td>
                                    <td>$75</td>
                                </tr>
                                <tr>
                                    <th scope="row">8</th>
                                    <td>Notebook</td>
                                    <td>Frodo</td>
                                    <td>$36</td>
                                </tr>
                                <tr>
                                    <th scope="row">9</th>
                                    <td>Dress</td>
                                    <td>Kimo</td>
                                    <td>$255</td>
                                </tr>
                                <tr>
                                    <th scope="row">10</th>
                                    <td>Paint</td>
                                    <td>Zico</td>
                                    <td>$434</td>
                                </tr>
                                <tr>
                                    <th scope="row">11</th>
                                    <td>Carpet</td>
                                    <td>Jeco</td>
                                    <td>$1236</td>
                                </tr>
                                <tr>
                                    <th scope="row">12</th>
                                    <td>Food</td>
                                    <td>Haso</td>
                                    <td>$422</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                </div>
            </div>
         <!--Contenu de la page-->
    </div>



    <script src="config/bootstrap/js/bootstrap.bundle.js"></script>
    <script defer src="config/js/all.js"></script> <!--load all styles -->
    <script>
          var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            toggleButton.onclick = function () {
                el.classList.toggle("toggled");
            };
    </script>
</body>
</html>