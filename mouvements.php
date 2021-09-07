<?php 
     session_start();
     if(!$_SESSION['PROFILE']){
         header('Location:login.php');
     }
 
     if(!($_SESSION['PROFILE']['roles']=="admin")){
         header("location:".$_SERVER['HTTP_REFERER']);
     }
    require('config/mouvements/mouveReq.php'); 
    
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
    <title>Mouvements</title>
</head>
<body>
   
    <div class="d-flex" id="wrapper">
       
        <?php require('sidebar.php') ?>
        <!--Contenu de la page-->
            <div id="page-content-wrapper">
                <?php require('navbar.php') ?>
                <div class="container-fluid px-4">
                    
                    <h3 class="fs-4 mb-3">Gestion des mouvements</h3>
                       <div class="row g-3 my-2">
                           <div class="col-md-12">
                             <form  method="get"> 
                                   
                                        <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <div class="form-group col-md-4">
                                                    <input type="text" class="form-control mr-sm-2" aria-label="search" value="" 
                                                    placeholder=" Entrez le mot clé" name="motCle"> 
                                                    
                                            </div>
                                            <div class="form-group col-md-6">
                                                <select name="select" class="form-control">
                                                    <option value="">----critère----</option>
                                                    <option value="id_mouvement"> id mouvement</option>
                                                    <option value="id_article"> id article</option>
                                                    <option value="ref_article">référence article </option>
                                                    <option value="nom_article">nom article</option>
                                                    <option value="categorie">catégorie </option>
                                                    <option value="quantite">quantite</option>
                                                    <option value="montant">montant</option>
                                                    <option value="type">type</option>
                                                    <option value="mouvement_date">date</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-success my-2 my-sm-0" type="submit">Rechercher</button>
                                        </div>
                                    
                               
                            </div>
                            <div class="col-md-6">
                            <label for=""  >Date début</label>
                                <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                    
                                    <div class="input-group">

                                      <select name="anneed" id="">
                                      <option value="">Année</option>
                                            <?php  for($i=date('Y');$i>=1940;$i--) { ?>
                                                
                                                <option value="<?=$i?>"><?=$i?></option>

                                            <?php }     ?>
                                      </select>
                                      <select name="moisd" id=""> 
                                            <option value="">Mois</option>
                                            <option value="01">Janvier</option>
                                            <option value="02">Février</option>
                                            <option value="03">Mars</option>
                                            <option value="04">Avril</option>
                                            <option value="05">Mai</option>
                                            <option value="06">Juin</option>
                                            <option value="07">Juillet</option>
                                            <option value="08">Août</option>
                                            <option value="09">Septembre</option>
                                            <option value="10">Octobre</option>
                                            <option value="11">Novembre</option>
                                            <option value="12">Décembre</option>
                                      </select>

                                      <select class="form-control" name="jourd" id="">
                                            <option value="">Jour</option>
                                            <option value="01">1</option>
                                            <option value="02">2</option>
                                            <option value="03">3</option>
                                            <option value="04">4</option>
                                            <option value="05">5</option>
                                            <option value="06">6</option>
                                            <option value="07">7</option>
                                            <option value="08">8</option>
                                            <option value="09">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                          </select>
                                        </div>
                                  </div>
                           </div>

                           <div class="col-md-6">
                           <label for="" >Date fin</label>
                            <div class="p-3 bg-white shadown-sm d-flex justify-content-around align-items-center rounded">
                                <div class="input-group">
                                <select name="anneef" id="">
                                      <option value="">Année</option>
                                            <?php  for($i=date('Y');$i>=1940;$i--) { ?>
                                                
                                                 <option value="<?=$i?>"><?=$i?></option>

                                            <?php }     ?>
                                      </select>
                                      <select name="moisf" id="">
                                            <option value="">Mois</option>
                                            <option value="01">Janvier</option>
                                            <option value="02">Février</option>
                                            <option value="03">Mars</option>
                                            <option value="04">Avril</option>
                                            <option value="05">Mai</option>
                                            <option value="06">Juin</option>
                                            <option value="07">Juillet</option>
                                            <option value="08">Août</option>
                                            <option value="09">Septembre</option>
                                            <option value="10">Octobre</option>
                                            <option value="11">Novembre</option>
                                            <option value="12">Décembre</option>
                                      </select>
                                      <select class="form-control" name="jourf" id="">
                                            <option value="">Jour</option>
                                            <option value="01">1</option>
                                            <option value="02">2</option>
                                            <option value="03">3</option>
                                            <option value="04">4</option>
                                            <option value="05">5</option>
                                            <option value="06">6</option>
                                            <option value="07">7</option>
                                            <option value="08">8</option>
                                            <option value="09">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>


                                      </select>
                                </div>
                            </div>
                        </div>
                        </form>    
                    </div>
                   <div class="col">
                     <div style="overflow:auto;white-space: nowrap;" >
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">ref_article</th>
                                    <th scope="col">nom_article</th>
                                    <th scope="col">categorie</th>
                                    <th scope="col">quantite</th>
                                    <th scope="col">montant</th>
                                    <th scope="col">type</th>
                                    <th scope="col">Date</th>
                                                          
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($result as $result) : ?>
                                <tr>
                                    <th scope="row"> <?= $result['id_mouvement'] ?></th>
                                    <td><?= $result['ref_article'] ?></td>
                                    <td><?= $result['nom_article'] ?></td>
                                    <td><?= $result['categorie'] ?></td>
                                    <td><?= $result['quantite'] ?></td>
                                    <td><?= $result['montant'] ?></td>
                                    <td><?= $result['type'] ?></td>
                                    <td><?= $result['mouvement_date'] ?></td>
                                    
                                </tr>
                               <?php endforeach ?>
                            </tbody>
                        </table>
                        </div> 
                        <ul class="pagination pagination-sm">
                            <?php for($i=0;$i<$nbrePages;$i++) {?>
                                <li class="page-item <?php  echo(($i==$page)?'active':''); ?>" aria-current="page" style="margin-right:10px;" >
                                    <a  class="page-link " href="mouvements.php?page=<?php  echo($i) ?>&motCle=<?php  echo($mc) ?>"> <?php  echo($i) ?> </a>
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