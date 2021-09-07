<?php

/*session_start();
if(!$_SESSION['PROFILE']){
  header('Location:../../login.php');
}*/


try {

  require_once('../bdd/bdd.php'); 
    
       if(!($_SESSION['PROFILE']['roles']=="admin")){
          header("location:".$_SERVER['HTTP_REFERER']);
        }else{ 
       
         if(isset($_GET['id_commande'])){
          $get_code = htmlspecialchars($_GET['id_commande']);

          $sql = $conn->query('SELECT * FROM commandes id_commande'.$_GET['id_commande']);
          $article = $sql->fetch();

           if($article){
              
            $article = $conn->prepare('DELETE  FROM commandes WHERE id_commande = ?');
            $article->execute(array($get_code));


            header('location:../../commandes.php');

           }else{

            header('location:../../commandes.php');
           }
         
        }
      }
       
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;



?>
