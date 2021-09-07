<?php
    //connexion à la base de données
    require_once('config/bdd/bdd.php');
    if(isset($_GET['id_article']) AND !empty($_GET['id_article'])){
          
        $get_code = htmlspecialchars($_GET['id_article']);

        $req = $conn->prepare('SELECT * FROM categories');
        $req->execute();
        $res = $req->fetchAll(); 

        $results = $conn->prepare('SELECT * FROM articles  WHERE id_article = ?');
        $results->execute(array($get_code));
    
            if($results->rowCount() == 1 ){
    
                $results = $results->fetch();
            
            }else{
    
                die('Cet article n\'existe pas');
    
            }
    
    }else{
        die('Erreur');
    }
 
                           
    if(isset($_POST['ref_article'],$_POST['nom_article'],$_POST['categorie'],$_POST['prix_d_achat'],$_POST['prix_de_vente']) ) {

      if(!empty(htmlspecialchars($_POST['ref_article']))
          AND !empty(htmlspecialchars($_POST['nom_article']))
          AND !empty(htmlspecialchars($_POST['categorie']))
          AND !empty(htmlspecialchars($_POST['prix_d_achat']))
          AND !empty(htmlspecialchars($_POST['prix_de_vente']))
      ){
      
      
             
            $refA = $_POST['ref_article'];
            $nomA = $_POST['nom_article'];
            $catA = $_POST['categorie'];
            $prixA = $_POST['prix_d_achat'];
            $prixV = $_POST['prix_de_vente'];
             
            $ins = $conn->prepare('UPDATE articles SET ref_article = ?,nom_article = ?,categorie = ?,
            prix_d_achat = ?, prix_de_vente = ? WHERE id_article = ?');
            $params = array($refA,$nomA,$catA,$prixA,$prixV,$get_code);
            $ins->execute($params);
            $message="succès";

            header("Location:articles.php");

        }else {

        $message = 'Veuillez remplir tous les champs !';
        }
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
    <title>Modifier</title>
</head>
<body>
   
    <div class="d-flex" id="wrapper">
       
        <?php require('sidebar.php') ?>
        <!--Contenu de la page-->
            <div id="page-content-wrapper">
                <?php require('navbar.php') ?>
                <div class="container-fluid px-4">
                    
                    <h3 class="fs-4 mb-3">Modifier l'article  « <?= $results['nom_article'] ?>» </h3>
                    <div class="row g-3 my-2">
                          <form method="POST">

                                    <div class="row g-3 my-2 bg-secondary">

                                    <div class="col-md-6">
                                           
                                            <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <label  class="text-white" for="state">Référent de l'article</label> <br>
                                            <div class="form-group">
                                                    
                                                    <input class="form-control"  value="<?= $results['ref_article'] ?>" type="text" id="ref_article" name="ref_article" required />
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                    <div class="col-md-6">
                                           
                                            <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <label  class="text-white" for="state">Nom du de l'article</label> <br>
                                            <div class="form-group">
                                                    
                                                    <input class="form-control" value="<?= $results['nom_article'] ?>" type="text" id="nom_article" name="nom_article" required />
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                        <div class="col-md-6">
                                        
                                            <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <label class="text-white" for="state">Catégorie l'article</label> <br>
                                            <div class="form-group">
                                                <select class="form-control" name="categorie" id="categorie">
                                                      <option value="<?=$results['categorie']?>"><?=$results['categorie']?></option>
                                                       <?php foreach($res as $res) : ?>
                                                            <option value="<?=$res['nom']?>"><?=$res['nom']?></option>
                                                       <?php endforeach ?> 
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                        <div class="col-md-6">
                                           
                                            <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <label  class="text-white" for="state">Prix d'achat</label> <br>
                                            <div class="form-group">
                                                    
                                                    <input class="form-control" value="<?= $results['prix_d_achat'] ?>" type="text" id="prix_d_achat" name="prix_d_achat" required />
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                        <div class="col-md-6">
                                            
                                            <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                            <label class="text-white" for="state">Prix de vente</label> <br>
                                            <div class="form-group">
                                                        
                                                        <input class="form-control" value="<?= $results['prix_de_vente'] ?>"  type="text" id="prix_de_vente" name="prix_de_vente" required />
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <!---->
                                        <div class="col-md-3">
                                            
                                            <div class="p-3 shadown-sm d-flex justify-content-around align-items-center rounded">
                                                <div class="form-group">
                                                <button type="submit" class="btn btn-success">Modifier</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!---->
                                    </div>


                                    </form>                 
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