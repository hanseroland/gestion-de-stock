<?php

/*session_start();
if(!$_SESSION['PROFILE']){
  header('Location:../../login.php');
}*/


try {

  require_once('../bdd/bdd.php'); 
    
      /* if(!($_SESSION['PROFILE']['roles']=="admin")){
          header("location:".$_SERVER['HTTP_REFERER']);
        }else{ */
       
         if(isset($_GET['id_utilisateur'])){
          $get_code = htmlspecialchars($_GET['id_utilisateur']);

          $sql = $conn->query('SELECT * FROM utilisateurs id_utilisateur'.$_GET['id_utilisateur']);
          $article = $sql->fetch();

           if($article){
              
            $article = $conn->prepare('DELETE  FROM utilisateurs WHERE id_utilisateur = ?');
            $article->execute(array($get_code));


            header('location:../../utilisateurs.php');

           }else{

            header('location:../../utilisateurs.php');
           }
         
        }
   // }
       
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;



?>
