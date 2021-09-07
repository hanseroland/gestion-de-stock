<?php

require_once('config/bdd/bdd.php');

if(isset($_POST['nom']) ) {

if(!empty(htmlspecialchars($_POST['nom']))

){


        $nom = $_POST['nom'];
            $req = $conn->prepare('INSERT INTO categories (nom) VALUES (?)');
            $params = array($nom);
            $req->execute($params);
            
            $message="succès";
            echo '<script>alert("Catégorie ajoutée")</script>';
            header("Refresh:0; url=categories.php");



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
    <title>Ajouter une catégorie</title>
</head>
<body>
   
       
       
        <!--Contenu de la page-->
            
                <div class="container-fluid px-4"> 
                    <h4  class="text-white"> <?= $message ?> </h4>
                    <form method="POST">

                        <div class="row g-3 my-2 bg-secondary">

                         
                           <div class="col-md-6">
                                <label class="text-white" for="state">Nom de la catégorie</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                         
						                <input class="form-control" type="text" id="nom" name="nom" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                           
                          
                            <div class="col-md-6">
                                
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