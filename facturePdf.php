<?php
 session_start();
 if(!$_SESSION['PROFILE']){
    header('Location:login.php');
} 


require_once('config/bdd/bdd.php'); 
require('fpdf181/fpdf.php');



if(isset($_GET['id_commande']) AND !empty($_GET['id_commande'])){

    try {

    $get_code=htmlspecialchars($_GET['id_commande']);
    /********************************Pour recupérer les informations de la facture à partir de l'id commande
     *                                             stocké dans la table facture ************************** */
    $req0 = "SELECT * FROM  ventes WHERE id_commande = ?";
    $ps = $conn->prepare($req0);
    $ps->execute(array($get_code));
    $res=$ps->fetchAll();
   
    /******************************Pour recupérer les informations de la commmande à partir de l'id commnde **************************************** */
    $req = $conn->prepare("SELECT * FROM commandes WHERE  id_commande = ?"); 
    $req->execute(array($get_code));
    $result = $req->fetchAll();
    foreach($result as $outCom){

        $id_cli = $outCom['ref_client'];
        $numCom = $outCom['id_commande'];
        $dateCom = $outCom['date'];
        $gerant = $outCom['vendeur'];
        $mntCom = $outCom['total_commande'];
               
    }
    /*********************************Pour recupérer le nom du clients dans la base de donnée à partir 
     * 
     *                                 de l'id du client stocké dans la base de données
     * ************************************* */ 
   
    $reqCli = $conn->prepare("SELECT * FROM clients WHERE  ref_client = ?"); 
    $reqCli->execute(array($id_cli));
    $resultCli = $reqCli->fetchAll();
    foreach($resultCli as $outCli){
       
         $nomClient = $outCli['nom_client'];      
    }
                             
   

    
   
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);
     // Titre
    $pdf->Cell(120,5,utf8_decode("Nom de la société"), 0, 0, 'L');
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(50,6,utf8_decode("FACTURE"),0,1,'C',true);
    $pdf->Ln(1);//saut de 1 ligne
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(120,5,"Libreville", 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
   // $pdf->Cell(80,5,"Mr/Mme  : ".$nomClient, 0,1,'L'); voici comment tu récupères tes variables
    $pdf->Cell(120,5,utf8_decode("ANGONDJE"), 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(120,5,utf8_decode("Téléphone/Fax "), 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(120,5,utf8_decode("Référence Internet "), 0,1,'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    
    $pdf->Ln(2);//saut de 2 lignes

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(120,5,"", 0,0,'L');
    $pdf->Cell(60,5,utf8_decode("Société et/ou Nom du client"), 0,1,'L');
    $pdf->SetFont('Arial','',10);
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(50,5,utf8_decode("Facture N :".$numCom), 0, 0, 'L',true); //true pour prendre en charge la couleur
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(50,5,utf8_decode("Date : ".$dateCom), 0, 0, 'L',true);
    $pdf->Cell(84,5,"Adresse", 0,1,'R');
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(50,5,utf8_decode("N client : .$nomClient"), 0, 0, 'L',true);
    $pdf->Cell(84,5,"CP Ville", 0,1,'R');
    $pdf->Ln(10);
    $pdf->SetFont('Arial','',10);
    $pdf->Cell(120,5,utf8_decode("Intitulé : Description du projet et/ou Produit facturé "), 0, 0, 'L');
    $pdf->Ln(10);
	
    //entêtes du tableau
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,utf8_decode(""), 0,0,'L');
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(30,10,utf8_decode("Référence  "), 1,0,'C',true);
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(50,10,utf8_decode("Article"), 1,0,'C',true);
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(10,10,utf8_decode("Qte"), 1,0,'C',true);
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(30,10,utf8_decode("Prix"), 1,0,'C',true);
    $pdf->SetFillColor(200,220,255);//définition de la couleur
    $pdf->Cell(30,10,utf8_decode("Montant"), 1,0,'C',true);
    $pdf->Cell(15,10,utf8_decode(""), 0,1,'L');

   //boucle pour recupérer chaque détails de la commande
    foreach($res as $out){

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,10,utf8_decode(""), 0,0,'L');
        $pdf->Cell(30,10,utf8_decode($out['ref_article']), 1,0,'C');
        $pdf->Cell(50,10,utf8_decode($out['nom_article']), 1,0,'C');
        $pdf->Cell(10,10,$out['quantite_vendue'], 1,0,'C');
        $pdf->Cell(30,10,$out['prix_de_vente'], 1,0,'C');
        $pdf->Cell(30,10,$out['total_vente'], 1,0,'C');
        $pdf->Cell(15,10,utf8_decode(""), 0,1,'L');  
               
    }

    $pdf->Ln(10); 

    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,utf8_decode(""), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode(""), 0,0,'C');
    $pdf->Cell(50,10,utf8_decode(""), 0,0,'C');
    $pdf->Cell(10,10,utf8_decode("Total Hors taxe"), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode(""), 0,0,'L');
    $pdf->Cell(30,10,$mntCom, 1,0,'R');
    $pdf->Cell(15,10,utf8_decode(""), 0,1,'L');

    $pdf->Cell(20,10,utf8_decode(""), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode(""), 0,0,'C');
    $pdf->Cell(50,10,utf8_decode(""), 0,0,'C');
    $pdf->Cell(10,10,utf8_decode("TVA à 20%"), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode(""), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode("55,20 XAF"), 1,0,'R');
    $pdf->Cell(15,10,utf8_decode(""), 0,1,'L');

    $pdf->Cell(20,10,utf8_decode(""), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode(""), 0,0,'C');
    $pdf->Cell(50,10,utf8_decode(""), 0,0,'C');
    $pdf->Cell(10,10,utf8_decode("Total TTC en XAF"), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode(""), 0,0,'L');
    $pdf->Cell(30,10,utf8_decode("331,20 XAF"),1,1,'R');
    $pdf->Cell(15,10,utf8_decode(""), 0,1,'L');

    $pdf->Ln(10);
    $pdf->Cell(120,5,utf8_decode("En votre aimable règlement"), 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(120,5,utf8_decode("Cordialement"), 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Ln(35);;
    $pdf->SetFont('Arial','',8);
    $pdf->Cell(120,5,"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor", 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(120,5,"incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation", 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(120,5,"ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit ", 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(120,5," fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia", 0, 0, 'L');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(120,5," in voluptate velit esse cillum dolore eu deserunt mollit anim id est laborum.", 0, 0, 'L');
    $pdf->Ln(10);
    $pdf->Cell(170,5,"  cillum dolore eu deserunt mollit anim id est laborum.", 0, 0, 'C');
    $pdf->Cell(60,5,"", 0,1,'L');
    $pdf->Cell(170,3," in voluptate velit esse cillum dolore eu deserunt mollit anim id est laborum.", 0, 0, 'C');
    $pdf->Cell(60,3,"", 0,1,'L');
    $pdf->Ln(12);
    $pdf->Cell(120,5,"", 0, 0, 'L');
    $pdf->Cell(60,5,"rolandntougou@gmail.com", 0,1,'R');
   
   



   

    $pdf->Output();
   
   
   }
    catch(PDOException $e)
        {
        $e->getMessage();
        }
    
  
}else{
    $e->getMessage();
    die('Erreur');
}





?>