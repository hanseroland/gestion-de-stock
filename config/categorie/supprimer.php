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
       
         if(isset($_GET['id_categorie'])){
          $get_code = htmlspecialchars($_GET['id_categorie']);

          $sql = $conn->query('SELECT * FROM categories id_categorie'.$_GET['id_categorie']);
          $article = $sql->fetch();

           if($article){
              
            $article = $conn->prepare('DELETE  FROM categories WHERE id_categorie = ?');
            $article->execute(array($get_code));


            header('location:../../categories.php');

           }else{

            header('location:../../categories.php');
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
