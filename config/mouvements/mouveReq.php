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
        if(isset($_GET['motCle'],$_GET['select'],$_GET['jourd'],$_GET['moisd'],  $_GET['anneed'],$_GET['jourf'],$_GET['moisf'],$_GET['anneef']) AND !empty($_GET['motCle'])
                AND !empty($_GET['select']) AND empty($_GET['jourd']) AND empty($_GET['moisd']) AND empty($_GET['anneed']) AND empty($_GET['jourf'])
                AND empty($_GET['moisf']) AND empty($_GET['anneef'])
            
            ){


            $mc= htmlspecialchars($_GET['motCle']);
            $select= $_GET['select'];

        
            $req = $conn->prepare("SELECT * FROM mouvements WHERE $select like  '%$mc%' ORDER BY id_mouvement DESC  LIMIT $size OFFSET $offset"); 

        }
         elseif(isset($_GET['motCle'],$_GET['select'],$_GET['jourd'],$_GET['moisd'],  $_GET['anneed'],$_GET['jourf'],$_GET['moisf'],$_GET['anneef']) AND !empty($_GET['motCle'])
                AND !empty($_GET['select']) AND !empty($_GET['jourd']) AND !empty($_GET['moisd']) AND !empty($_GET['anneed']) AND !empty($_GET['jourf'])
                AND !empty($_GET['moisf']) AND !empty($_GET['anneef'])
     
         ){
            $mc= htmlspecialchars($_GET['motCle']);
            $select= $_GET['select'];

            $jourd = $_GET['jourd'];
            $moisd = $_GET['moisd'];
            $anneed = $_GET['anneed'];

            $jourf = $_GET['jourf'] ;
            $moisf = $_GET['moisf'];
            $anneef = $_GET['anneef'];



            $dated = $anneed."-".$moisd."-".$jourd;
            $datef = $anneef."-".$moisf."-".$jourf;

            $req = $conn->prepare("SELECT * FROM mouvements WHERE $select like  '%$mc%' AND mouvement_date >= '$dated' AND mouvement_date <= '$datef' ORDER BY id_mouvement DESC  LIMIT $size OFFSET $offset"); 

        } elseif(isset($_GET['motCle'],$_GET['select'],$_GET['jourd'],$_GET['moisd'],  $_GET['anneed'],$_GET['jourf'],$_GET['moisf'],$_GET['anneef']) AND !empty($_GET['motCle'])
                AND empty($_GET['select']) AND empty($_GET['jourd']) AND !empty($_GET['moisd']) AND !empty($_GET['anneed']) AND !empty($_GET['jourf'])
                AND !empty($_GET['moisf']) AND !empty($_GET['anneef'])
     
         ){
            
            $jourd = $_GET['jourd'];
            $moisd = $_GET['moisd'];
            $anneed = $_GET['anneed'];

            $jourf = $_GET['jourf'] ;
            $moisf = $_GET['moisf'];
            $anneef = $_GET['anneef'];


            $dated = $anneed."-".$moisd."-".$jourd;
            $datef = $anneef."-".$moisf."-".$jourf;


            $req = $conn->prepare("SELECT * FROM mouvements WHERE  mouvement_date >= '$dated' AND mouvement_date <= '$datef' ORDER BY id_mouvement DESC  LIMIT $size OFFSET $offset"); 

        }
        else{
            $req = $conn->prepare("SELECT * FROM mouvements ORDER BY id_mouvement DESC  LIMIT $size OFFSET $offset "); 
        }

        $req->execute();
        $result = $req->fetchAll(); 

        //pour afficher par page
        if( isset($_GET['motCle'],$_GET['select'],$_GET['jourd'],$_GET['moisd'],  $_GET['anneed'],$_GET['jourf'],$_GET['moisf'],$_GET['anneef']) AND !empty($_GET['motCle'])
            AND !empty($_GET['select']) AND empty($_GET['jourd']) AND empty($_GET['moisd']) AND empty($_GET['anneed']) AND empty($_GET['jourf'])
            AND empty($_GET['moisf']) AND empty($_GET['anneef'])
        )
        {
            $req2 = $conn->prepare("SELECT COUNT(*) AS NMBRE_SUP FROM mouvements WHERE $select like  '%$mc%' ORDER BY id_mouvement DESC  ");

        }elseif(isset($_GET['motCle'],$_GET['select'],$_GET['jourd'],$_GET['moisd'],  $_GET['anneed'],$_GET['jourf'],$_GET['moisf'],$_GET['anneef']) AND !empty($_GET['motCle'])
                AND !empty($_GET['select']) AND !empty($_GET['jourd']) AND !empty($_GET['moisd']) AND !empty($_GET['anneed']) AND !empty($_GET['jourf'])
                AND !empty($_GET['moisf']) AND !empty($_GET['anneef'])
          ){
            $req2 = $conn->prepare("SELECT * FROM mouvements WHERE $select like  '%$mc%' AND mouvement_date >= '$dated' AND mouvement_date <= '$datef' ORDER BY id_mouvement DESC"); 

        }elseif(isset($_GET['motCle'],$_GET['select'],$_GET['jourd'],$_GET['moisd'],  $_GET['anneed'],$_GET['jourf'],$_GET['moisf'],$_GET['anneef']) AND !empty($_GET['motCle'])
                 AND empty($_GET['select']) AND empty($_GET['jourd']) AND !empty($_GET['moisd']) AND !empty($_GET['anneed']) AND !empty($_GET['jourf'])
                 AND !empty($_GET['moisf']) AND !empty($_GET['anneef'])
        ){

            $req2 = $conn->prepare("SELECT * FROM mouvements WHERE  mouvement_date >= '$dated' AND mouvement_date <= '$datef' ORDER BY id_mouvement DESC  LIMIT $size OFFSET $offset"); 

        }else{
            $req2 = $conn->prepare("SELECT COUNT(*) AS NMBRE_SUP FROM mouvements ORDER BY id_mouvement DESC ");
        }
        $req2->execute();
        $ligne=$req2->fetch(PDO::FETCH_ASSOC);

        $NMBRE=$ligne['NMBRE_SUP'];
        if(($NMBRE % $size)==0) $nbrePages=floor($NMBRE / $size);
        else  $nbrePages=floor($NMBRE / $size)+1;

?>