<?php 
        session_start();
        if(!$_SESSION['PROFILE']){
        header('Location:login.php');
        }
    require('config/ventes/ventesReq.php'); 
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
    <title>Ventes</title>
</head>
<body>
   
    <div class="d-flex" id="wrapper">
       
        <?php require('sidebar.php') ?>
        <!--Contenu de la page-->
            <div id="page-content-wrapper">
                <?php require('navbar.php') ?>
                <div class="container-fluid px-4">
                    
                    <h3 class="fs-4 mb-3">Gestion des ventes</h3>
                    <div class="row g-3 my-2">
                       <form  method="get"> 
                                    <div class="col-md-12">
                                        <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <div class="form-group col-md-4">
                                                    <input type="text" class="form-control mr-sm-2" aria-label="search" value="" 
                                                    placeholder=" Entrez le mot clé" name="motCle"> 
                                                    
                                            </div>
                                            <div class="form-group col-md-6">
                                                <select name="select" class="form-control">
                                                    <option value="">----critère----</option>
                                                    <option value="id_vente"> id vente</option>
                                                    <option value="id_commande"> id commande</option>
                                                    <option value="nom_article">nom article</option>
                                                    <option value="quantite_vendue">quantité</option>
                                                    <option value="prix_de_vente">prix</option>
                                                    <option value="total_vente">total</option>
                                                    <option value="date">date</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-success my-2 my-sm-0" type="submit">Rechercher</button>
                                        </div>
                                    </div>
                            </form>
                             <div class="d-flex justify-content-end">
                        
                                     <!-- Button trigger modal -->
                                     <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Facturer un client
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Formulaire</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                 <?php require('config/ventes/facture.php') ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                             </div>
                             
                    </div>
                   <div class="col">
                     <div style="overflow:auto;white-space: nowrap;" >
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Id commande</th>
                                    <th scope="col">Nom article</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Prix de vente</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>                            
                                </tr>
                            </thead> 
                            <tbody>
                            <?php foreach ($result as $result) : ?>
                                <tr>
                                    <th scope="row"> <?= $result['id_vente'] ?></th>
                                    <td><?= $result['id_commande'] ?></td>
                                    <td><?= $result['nom_article'] ?></td>
                                    <td><?= $result['quantite_vendue'] ?></td>
                                    <td><?= $result['prix_de_vente'] ?></td>
                                    <td><?= $result['total_vente'] ?></td>
                                    <td><?= $result['date'] ?></td>
                                    <td>
                                        <a href="config/ventes/supprimer.php?id_vente=<?=$result['id_vente']?>" onclick="return confirm( 'ETES VOUS SUR DE VOULOIR SUPPRIMER CET ELEMENT?' )" style="text-decoration:none;color:red">Supprimer</a>
                                   </td>
                                </tr>
                               <?php endforeach ?>
                            </tbody>
                        </table>
                        </div> 
                        <ul class="pagination pagination-sm">
                            <?php for($i=0;$i<$nbrePages;$i++) {?>
                                <li class="page-item <?php  echo(($i==$page)?'active':''); ?>" aria-current="page" style="margin-right:10px;" >
                                    <a  class="page-link " href="ventes.php?page=<?php  echo($i) ?>&motCle=<?php  echo($mc) ?>"> <?php  echo($i) ?> </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div> 
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