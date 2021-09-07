<?php session_start(); ?>
<!doctype html>
<html lang="fr">
  <head>

    <link rel="stylesheet" href="config/bootstrap/css/bootstrap.min.css"> 
     <!-- Custom styles for this template -->
    <link href="config/css/signin.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Connexion</title>


    <!-- Bootstrap core CSS -->


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
   
  </head>
  <body class="text-center">

  <?php
    require_once('config/bdd/bdd.php');
      
    if (isset($_POST) AND !empty($_POST)) {
      if(!empty(htmlspecialchars($_POST['email'])) AND !empty(htmlspecialchars($_POST['mot_de_passe']))){

      
      $email = $_POST['email'];
      $pass = $_POST['mot_de_passe']; 

      
      $results = $conn->prepare('SELECT * FROM utilisateurs WHERE email = ?');
      $results->execute(array($email));
      
      if($results->rowCount() == 1 ){

        $results = $results->fetch();

        $motPass = $results['mot_de_passe'];

        if(password_verify($pass, $motPass)){

          $req = $conn->prepare('SELECT * FROM utilisateurs WHERE email = ? AND mot_de_passe = ?'); 
          $params = array($email, $motPass);
          $req->execute($params);
  
          header('location:index.php');
          
          
  
          if($user=$req->fetch()){
             $_SESSION['PROFILE'] = $user;
  
             header('location:index.php');
             
  
            }
            else{
  
              $message = 'Identifiants incorrects !';
            }

        }
    
        
    
    }else{

        die('Ce username n\'existe pas');

    }
      

      }
      else {

          $message = 'Veuillez remplir tous les champs !';
      }

      if (isset( $message)){

          echo '<div class="col-sm-6 mx-auto">  
          
          <div class="error text-center">'.  $message .'</div>
          
          </div>';

         
      }
        header('location:index.php');

  }
         
    ?>

<h5 class="text-danger"> <?php       if(isset($message)){ echo  $message;}   ?> </h5>

    <form class="form-signin" method="POST">
 

 
        
    <div class="form-group row">
        <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1>
    </div> 

    <div class="form-group row">
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="email" name="email" required autofocus>
   </div> 

    <div class="form-group row">
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="mot de passe" name="mot_de_passe" required>
  </div>    
 <div class="form-group row">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
 </div> 
        <p class="mt-5 mb-3 text-muted">&copy; 2021 Développé par NGUEMA NTOUGOU Hanse Roland Parfait</p>
  </form>
</body>
</html>
