<?php session_start();
/*if(!$_SESSION['PROFILE']){
  header('Location:../../../login.php');
}



require_once('../../../src/config/conn.php');
$user = $_SESSION['PROFILE']['username'];

if(!($_SESSION['PROFILE']['roles']=="admin")){
  header("location:".$_SERVER['HTTP_REFERER']);
}else{*/

    require_once('config/bdd/bdd.php');  
    function function_alert($msg) {
        echo "<script>alert('$msg');</script>";
    };

                           
if(isset($_POST['nom'],$_POST['email'],$_POST['roles'],$_POST['mot_de_passe'],$_POST['repassword']) ) {

if( 
    !empty($_POST['nom']) 
    AND !empty($_POST['email'])
    AND !empty($_POST['roles']) 
    AND !empty($_POST['mot_de_passe'])
    AND !empty($_POST['repassword'])

){

       
        $nomU = htmlspecialchars($_POST['nom']);
        $login = htmlspecialchars($_POST['email']); 
        $role = htmlspecialchars($_POST['roles']);
        $pass1 = htmlspecialchars($_POST['mot_de_passe']); 
        $pass2 = htmlspecialchars($_POST['repassword']);
        $options = [
            'cost' => 12,
        ];

        if($pass1 == $pass2){
            
          $pass = password_hash($pass1, PASSWORD_DEFAULT, $options );
                
            $req = $conn->prepare('INSERT INTO utilisateurs (nom,email,roles,mot_de_passe) VALUES (?,?,?,?)');
            $params = array($nomU,$login,$role,$pass);
            $req->execute($params);

            header("Location:utilisateurs.php");
         

        }else{

            
            function_alert("Le mot de passe ne correspond pas");
        }



        }else {

            function_alert("Le mot de passe ne correspond pas");
        }
      }

//}





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
    <title>Ajouter un utilisateur</title>
</head>
<body>
   
       
       
        <!--Contenu de la page-->
           
                <div class="container-fluid px-4">
                    <form method="POST">

                        <div class="row g-3 my-2 bg-secondary">

                          <div class="col-md-6">
                                
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                <label class="text-white" class="text-white" for="state">Nom</label> <br>
                                <div class="form-group">
                                         
						                <input class="form-control" type="text" id="nom" name="nom" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                           <div class="col-md-6">
                                
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                <label class="text-white" class="text-white" for="state">adresse email</label> <br>
                                <div class="form-group">
                                         
						                <input class="form-control" type="email" id="email" name="email" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-6">
                           
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                <label class="text-white"  for="state">Rôles</label> <br>
                                <div class="form-group">
                                       <select class="form-control" name="roles" id="roles">
                                           <option value="">-----Roles-----</option>
                                           <option value="admin">Administrateur</option>
                                           <option value="vendeur">Vendeur</option>
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-6">
                                
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                <label class="text-white" for="state">Mot de passe</label> <br>
                                    <div class="form-group">
                                         
						                <input class="form-control" type="password" id="mot_de_passe" name="mot_de_passe" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-6">
                                
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                <label class="text-white" for="state">Confirmer le mot de passe</label> <br>
                                    <div class="form-group">
                                         
						                <input class="form-control" type="password" id="repassword" name="repassword" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                           
                            <div class="col-md-3">
                                
                                <div class="p-3 shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-success">Ajouter</button>
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