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
       
         if(isset($_GET['id_article'])){
          $get_code = htmlspecialchars($_GET['id_article']);

          $sql = $conn->query('SELECT * FROM articles id_article'.$_GET['id_article']);
          $article = $sql->fetch();

           if($article){
              
            $article = $conn->prepare('DELETE  FROM articles WHERE id_article = ?');
            $article->execute(array($get_code));


            header('location:../../articles.php');

           }else{

            header('location:../../articles.php');
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
