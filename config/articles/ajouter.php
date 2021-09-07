<?php

require_once('config/bdd/bdd.php');


        $requete = $conn->prepare('SELECT * FROM categories');
        $requete->execute();
        $res = $requete->fetchAll(); 

if(isset($_POST['ref_article'],$_POST['nom_article'],$_POST['categorie'],$_POST['prix_d_achat'],$_POST['prix_de_vente'])) {

if(
        !empty(htmlspecialchars($_POST['ref_article']))
    AND !empty(htmlspecialchars($_POST['nom_article']))
    AND !empty(htmlspecialchars($_POST['categorie']))
    AND !empty(htmlspecialchars($_POST['prix_d_achat']))
    AND !empty(htmlspecialchars($_POST['prix_de_vente']))

){

            require('config/getDate.php');
            $dateA = date('Y-m-d');
            $refA = $_POST['ref_article'];
            $nomA = $_POST['nom_article']; 
            $cat = $_POST['categorie']; 
            $prixA = $_POST['prix_d_achat'];
            $prixV = $_POST['prix_de_vente'];
            $quantite = 0;

            $req = $conn->prepare('INSERT INTO articles (ref_article,nom_article,categorie,prix_d_achat,prix_de_vente,quantite,date_ajout,jours,mois) VALUES (?,?,?,?,?,?,?,?,?)');
            $params = array($refA,$nomA,$cat,$prixA,$prixV,$quantite,$dateA,$jour,$mois);
            $req->execute($params);
            
            $message="succès";

            header("Refresh:0; url=articles.php");



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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"  >
    <link rel="stylesheet" href="../css/style.css">
    <title>Ajouter un article</title>
</head>
<body>
   
       
       
        <!--Contenu de la page-->
           
                <div class="container-fluid px-4">
                    <form method="POST">

                        <div class="row g-3 my-2 bg-secondary">

                          <div class="col-md-6">
                                <label  class="text-white" for="state">Référent de l'article</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                         
						                <input class="form-control" type="text" id="ref_article" name="ref_article" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                           <div class="col-md-6">
                                <label  class="text-white" for="state">Nom du de l'article</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                         
						                <input class="form-control" type="text" id="nom_article" name="nom_article" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-6">
                            <label class="text-white" for="state">Catégorie l'article</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                       <select class="form-control" name="categorie" id="categorie">
                                           <option value="">--Sélectionner une catégorie--</option>
                                            <?php foreach($res as $res) : ?>
                                                            <option value="<?=$res['nom']?>"><?=$res['nom']?></option>
                                            <?php endforeach ?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-6">
                                <label  class="text-white" for="state">Prix d'achat</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                         
						                <input class="form-control" type="text" id="prix_d_achat" name="prix_d_achat" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-6">
                                <label class="text-white" for="state">Prix de vente</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
						                    <input class="form-control"  type="text" id="prix_de_vente" name="prix_de_vente" required />
                                    </div>
                                </div>
                            </div>
                          
                            <!---->
                            <div class="col-md-3">
                                
                                <div class="p-3 shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-success">Valider</button>
                                    </div>
                                </div>
                            </div>
                            <!---->
                        </div>
                       

                    </form>
                     
                </div>
           
         <!--Contenu de la page-->
  


    <script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>