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
       
         if(isset($_GET['id_vente'])){
          $get_code = htmlspecialchars($_GET['id_vente']);

          $sql = $conn->query('SELECT * FROM ventes id_vente'.$_GET['id_vente']);
          $article = $sql->fetch();

           if($article){
              
            $article = $conn->prepare('DELETE  FROM ventes WHERE id_vente = ?');
            $article->execute(array($get_code));


            header('location:../../ventes.php');

           }else{

            header('location:../../ventes.php');
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
