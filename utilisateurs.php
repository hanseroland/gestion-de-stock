<?php 
    session_start();
    if(!$_SESSION['PROFILE']){
        header('Location:login.php');
    }

    if(!($_SESSION['PROFILE']['roles']=="admin")){
        header("location:".$_SERVER['HTTP_REFERER']);
    }
    require('config/utilisateurs/utilisateursReq.php'); 

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
    <title>Utilisateurs</title>
</head>
<script type="text/javascript" src="config/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
         
                $('#modal').on('hidden.bs.modal', function () { 
                       location.reload();
                       
                });
            
    </script>
<body>
   
    <div class="d-flex" id="wrapper">
       
        <?php require('sidebar.php') ?>
        <!--Contenu de la page-->
            <div id="page-content-wrapper">
                <?php require('navbar.php') ?>
                <div class="container-fluid px-4">
                    
                    <h3 class="fs-4 mb-3">Gestion des utilisateurs</h3>
                    <div class="row g-3 my-2">
                          <form  method="get"> 
                                    <div class="col-md-12">
                                        <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <div class="form-group col-md-4">
                                                    <input type="text" class="form-control mr-sm-2" aria-label="search" value="" 
                                                    placeholder=" Entrez le mot cl??" name="motCle"> 
                                                    
                                            </div>
                                            <div class="form-group col-md-6">
                                                <select name="select" class="form-control">
                                                    <option value="">----crit??re----</option>
                                                    <option value="id_utilisateur"> identifiant</option>
                                                    <option value="nom"> nom</option>
                                                    <option value="roles">roles </option>
                                                    
                                                </select>
                                            </div>
                                            <button class="btn btn-success my-2 my-sm-0" type="submit">Rechercher</button>
                                        </div>
                                    </div>
                            </form>
                             <div class="d-flex justify-content-end">
                                 <!-- Button trigger modal -->
                                    <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        Ajouter
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Formulaire</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                              <?php require('config/utilisateurs/ajouter.php') ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                             </div>
                    </div>
                   <div class="col">
                       <div  style="overflow:auto;white-space: nowrap;">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">nom</th>
                                    <th scope="col">email</th>
                                    <th scope="col">roles</th>
                                    <th scope="col">Acitions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $result) : ?>

                                    <tr>
                                        <th scope="row"> <?= $result['id_utilisateur'] ?></th>
                                        <td ><?= $result['nom']?></td>
                                        <td ><?= $result['email']?></td>
                                        <td ><?= $result['roles']?></td>
                                        <td>
                                            <a href="modifierUti.php?id_utilisateur=<?=$result['id_utilisateur']?>"   style="text-decoration:none" >Modifier</a> | 
                                             <a href="config/utilisateurs/supprimer.php?id_utilisateur=<?=$result['id_utilisateur']?>" onclick="return confirm( 'ETES VOUS SUR DE VOULOIR SUPPRIMER CET ELEMENT?' )" style="text-decoration:none;color:red">Supprimer</a>
                                        </td>
                                    </tr>   
                                    <?php endforeach ?> 
                                
                            </tbody>
                        </table>
                        </div>
                        <ul class="pagination pagination-sm">
                            <?php for($i=0;$i<$nbrePages;$i++) {?>
                                <li class="page-item <?php  echo(($i==$page)?'active':''); ?>" aria-current="page" style="margin-right:10px;" >
                                    <a  class="page-link " href="utilisateurs.php?page=<?php  echo($i) ?>&motCle=<?php  echo($mc) ?>"> <?php  echo($i) ?> </a>
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