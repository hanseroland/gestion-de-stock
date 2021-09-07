<?php 
/*session_start();
if(!$_SESSION['PROFILE']){
  header('Location:../../../login.php');
}*/

  require_once('../bdd/bdd.php');
  
   
	
		if(isset($_POST["tampon"]) && $_POST["tampon"]=="recup_article")
		{		
		
			$requete_ref = $conn->prepare("SELECT * FROM articles WHERE ref_article = '".$_POST["ref_article"]."'; "); 
			$requete_ref->execute();
			$resultats_ref = $requete_ref->fetch();
			$chaine = $resultats_ref['nom_article']."|".$resultats_ref['quantite'];
            

			
			print($chaine);
		}
		else
		{

			require('../getDate.php');

			$qteA = $_POST['quantite_article'];
			$refA = $_POST['ref_article'];

			$requete_ref = $conn->prepare('UPDATE articles SET quantite = quantite + ? WHERE ref_article = ?'); 
			$requete_ref->execute(array($qteA,$refA));
			if($requete_ref->rowCount()==1)
			{

				  /**********************Historique*********************** */
				/*  $user = $_SESSION['PROFILE']['username'];
				  $date =  date('Y-m-d');
				  $action = 'Ajout du produit '.$refp.' d\'une quantité ';
				  $detail =  $qte_p;
				  $reqHis = $conn->prepare('INSERT INTO historique (his_action,his_detail,his_date,his_utilisateur)
				  VALUES (?,?,?,?)');
				  $param = array($action,$detail,$date,$user);
				  $reqHis->execute($param);*/
				  /*********************Mouvement************************ */
				 

                  $requete_m = $conn->prepare("SELECT * FROM articles WHERE ref_article = ? "); 
			      $requete_m->execute(array($refA));
			      $resultats_m = $requete_m->fetch();

                  $date = date('Y-m-d');
				  $idArt = $resultats_m['id_article'];
				  $refArt = $resultats_m['ref_article'];
				  $nomArt = $resultats_m['nom_article'];
                  $catArt = $resultats_m['categorie'];
				  $prixA = $resultats_m['prix_d_achat'];
				  $montant = $qteA*$prixA;
				  $type= "entree";



  
				  $reqMouv = $conn->prepare('INSERT INTO mouvements (id_article,ref_article,nom_article,categorie,quantite,montant,type,mouvement_date,jours,mois) VALUES (?,?,?,?,?,?,?,?,?,?)');
				  $paramMouv = array($idArt,$refArt,$nomArt,$catArt,$qteA,$montant,$type,$date,$jour,$mois);
				  $reqMouv->execute($paramMouv);
				   /*********************Mouvement************************ */

				print("OK");
			}
			else
			{
				print("NOK");
			}

		}
			
			
			/*switch($_POST["tampon"])
			{


				case "recup_prod":
					
					$requete_ref = $conn->prepare("SELECT * FROM produits WHERE ref_produit = '".$_POST["ref_produit"]."'; "); 
					$requete_ref->execute();
					$resultats_ref = $requete_ref->fetch();
					$chaine = $resultats_ref['id_produit']."|".$resultats_ref['designation']."|".$resultats_ref['prix_v']."|".$resultats_ref['quantite_p'];
					print($chaine);
	
				break;
				
				case "recup_client":
					$requete = "SELECT * FROM clients WHERE Client_num = ".$_POST["ref_client"].";";
					$retours = mysqli_query($liaison2, $requete);
					$retour = mysqli_fetch_array($retours);
					$chaine = $retour["Client_civilite"]."|".$retour["Client_nom"]."|".$retour["Client_prenom"];
					print($chaine);					
				break;
				
				case "recup_article":
					$requete = "SELECT * FROM produits WHERE Article_code = '".$_POST["ref_produit"]."';";
					$retours = mysqli_query($liaison2, $requete);
					$retour = mysqli_fetch_array($retours);
					$chaine = $retour["Article_designation"]."|".$retour["Article_PUHT"]."|".$retour["Article_Qte"];	
					print($chaine);					
				break;

				case "creer_client":
					$requete = "SELECT COUNT(Client_num) AS nb FROM clients WHERE Client_nom='".$_POST["nom_client"]."' AND Client_prenom='".$_POST["prenom_client"]."';";
					$retours = mysqli_query($liaison2, $requete);
					$retour = mysqli_fetch_array($retours);
					if($retour["nb"]>0)	
						print("nok");
					else
					{
						$requete = "INSERT INTO clients(Client_civilite, Client_nom, Client_prenom) VALUES ('".$_POST["civilite"]."', '".$_POST["nom_client"]."', '".$_POST["prenom_client"]."');";
						$retours = mysqli_query($liaison2, $requete);
						if($retours==1)
							print(mysqli_insert_id($liaison2));
					}
				break;	*/			
			
		
	
	//mysqli_close($liaison2);
?>