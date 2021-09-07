<?php
        //connexion à la base de données
        require_once('config/bdd/bdd.php');

        $select = "";//variable pour la colonne recherchée
        $mc ="";//variable pour le champ recherché
        $size = 20;//limite le nombre de ligne du tableau 


        if(isset($_GET['page'])){

            $page = htmlspecialchars($_GET['page']);
        }else{
            $page = 0;
        }

        $offset=$size*$page;

        //recherche
        if(isset($_GET['motCle'],$_GET['select'])){

            $mc= htmlspecialchars($_GET['motCle']);
            $select= $_GET['select'];
        
            $req = $conn->prepare("SELECT * FROM categories WHERE $select like  '%$mc%' ORDER BY id_categorie ASC  LIMIT $size OFFSET $offset"); 

        }else{
            $req = $conn->prepare("SELECT * FROM categories ORDER BY id_categorie ASC  LIMIT $size OFFSET $offset "); 
        }

        $req->execute();
        $result = $req->fetchAll(); 

        //pour afficher par page
        if(isset($_GET['motCle'],$_GET['select']))
        $req2 = $conn->prepare("SELECT COUNT(*) AS NMBRE_SUP FROM categories WHERE $select like  '%$mc%' ORDER BY id_categorie DESC  ");
        else
        $req2 = $conn->prepare("SELECT COUNT(*) AS NMBRE_SUP FROM categories ORDER BY id_categorie DESC ");
        $req2->execute();
        $ligne=$req2->fetch(PDO::FETCH_ASSOC);

        $NMBRE=$ligne['NMBRE_SUP'];
        if(($NMBRE % $size)==0) $nbrePages=floor($NMBRE / $size);
        else  $nbrePages=floor($NMBRE / $size)+1;

?>