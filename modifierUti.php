<?php
    //connexion à la base de données
    require_once('config/bdd/bdd.php');
    if(isset($_GET['id_utilisateur']) AND !empty($_GET['id_utilisateur'])){
          
        $get_code = htmlspecialchars($_GET['id_utilisateur']);

        $req = $conn->prepare('SELECT * FROM utilisateurs');
        $req->execute();
        $res = $req->fetchAll(); 

        $results = $conn->prepare('SELECT * FROM utilisateurs  WHERE id_utilisateur = ?');
        $results->execute(array($get_code));
    
            if($results->rowCount() == 1 ){
    
                $results = $results->fetch();
            
            }else{
    
                die('Cet article n\'existe pas');
    
            }
    
    }else{
        die('Erreur');
    }
 
                           
    if(isset($_POST['nom'],$_POST['email'],$_POST['roles']) ) {

      if(!empty($_POST['nom'])
          AND !empty($_POST['email'])
          AND !empty($_POST['roles'])
        
      ){
      
      
             
            $nom = htmlspecialchars($_POST['nom']);
            $email = htmlspecialchars($_POST['email']);
            $roles = htmlspecialchars($_POST['roles']);
           
             
            $ins = $conn->prepare('UPDATE utilisateurs SET nom = ?,email = ?,roles = ?  WHERE id_utilisateur = ?');
            $params = array($nom,$email,$roles,$get_code);
            $ins->execute($params);
            $message="succès";

            header("Location:utilisateurs.php");

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
                    
                    <h3 class="fs-4 mb-3">Modifier l'utilisateur  <?= $results['nom'] ?> </h3>
                    <div class="row g-3 my-2">
                        
                    <form method="POST">

                            <div class="row g-3 my-2 bg-secondary">

                            <div class="col-md-6">
                                    
                                    <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <label class="text-white" class="text-white" for="state">Nom</label> <br>
                                    <div class="form-group">
                                            
                                            <input class="form-control"  value="<?= $results['nom'] ?>" type="text" id="nom" name="nom" required />
                                        </div>
                                    </div>
                                </div>
                                <!---->
                            <div class="col-md-6">
                                    
                                    <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <label class="text-white" class="text-white" for="state">adresse email</label> <br>
                                    <div class="form-group">
                                            
                                            <input class="form-control" value="<?= $results['email'] ?>" type="email" id="emai" name="email" required />
                                        </div>
                                    </div>
                                </div>
                                <!---->
                                <div class="col-md-6">
                               
                                    <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <label class="text-white"  for="state">Rôles</label> <br>
                                    <div class="form-group">
                                        <select class="form-control" name="roles" id="roles">
                                            <option value="<?=$results['roles'] ?>"> <?= $results['roles'] ?> </option>
                                            <option value="admin">Administrateur</option>
                                            <option value="vendeur">Vendeur</option>
                                            
                                            </select>
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