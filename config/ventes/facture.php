<?php
    require('config/bdd/bdd.php');
    require('config/ventes/req.php')
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" 
    integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Bootstrap core CSS -->
      <script src="config/js/prototype.js"></script>

    <title>Facture</title>
</head>
<body>
<script language='javascript' type="text/javascript">
function recolter()
{
	document.getElementById("formulaire").request({
		onComplete:function(transport){
			switch(document.getElementById('param').value)
			{
				case 'recup_article':
                    var tab_info = transport.responseText.split('|');
                    document.getElementById('id_article').value = tab_info[0];
                    document.getElementById('nom_article').value = tab_info[1];
                    document.getElementById('categorie').value = tab_info[2];
                    document.getElementById('prix_de_vente').value = tab_info[3];
                    document.getElementById('quantite').value = tab_info[4];
                                        
				break;
				
			    case 'recup_client':
					    var tab_info = transport.responseText.split('|');
					    document.getElementById('nom_client').value = tab_info[0];	
                        console.log(tab_info)			
				break;

                case 'creer_client':
                     var rep =	transport.responseText;	
                     if(rep=="nok")
                            alert("Ce client existe déjà");
                     else	
                          {
                                var liste = document.getElementById("ref_client");
                                var option = document.createElement("option");
                                option.value = rep;
                                option.text = rep;
                                liste.add(option);
                                liste.selectedIndex = liste.length-1;						
                        }		
                break;
                case 'facturer':
                                    
                      if(transport.responseText="ok")
                           alert("La facture a été validé avec succès");	
                       else
                            {
                                alert("Une erreur est survenue");	
                            }
                break;
				/*	
				case 'creer_client':
					var rep = transport.responseText;
					if(rep=="nok")
						alert("Le client existe déjà");
					else
					{
						var liste = document.getElementById("ref_client");
						var option = document.createElement("option");
						option.value = rep;
						option.text = rep;
						liste.add(option);
						liste.selectedIndex = liste.length-1;						
					}
				break;*/				
				
			}	
		}
	});
}
</script>

       
       
        <!--Contenu de la page-->
           
                <div class="container-fluid px-4">
                    <form id="formulaire" name="formulaire" method="POST" action="config/ventes/rep_facture.php">

                        <div class="row g-3 my-2 bg-secondary">

                            <div class="col-md-4">
                            <label  class="text-white" for="state">référence du client</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                       <select class="form-control" name="ref_client" id="ref_client" onchange="document.getElementById('param').value='recup_client';recolter();">
                                           <option value="">--Sélectionner un client--</option>
                                           <?php foreach ($resultatsCli as $ref_cli) : ?>
                                                <option value="<?=$ref_cli['ref_client']?>"><?=$ref_cli['ref_client']?></option>
                                            <?php endforeach ?> 
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-4">
                                <label class="text-white" for="state">Nom du client</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control" type="text" id="nom_client" placeholder="client+ref_Client" name="nom_client"  required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            
                            <div class="col-md-4">
                               
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                         <br>
                                          <input  class="btn btn-primary" type="button" id="creer_client" name="creer_client" value="Créer un client" onclick="document.getElementById('param').value='creer_client';recolter();">
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-4">
                                <label  class="text-white" for="state">référence du article</label> <br>
                                    <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                        <div class="form-group">
                                        <select class="form-control" name="ref_article" id="ref_article" onchange="getElementById('param').value='recup_article';recolter();">
                                            <option value="">--Sélectionner une reférence--</option>
                                               <?php foreach ($resultats as $ref_p) : ?>
                                                    <option value="<?=$ref_p['ref_article']?>"><?=$ref_p['ref_article']?></option>
                                                <?php endforeach ?> 
                                            
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <!---->
                            <div class="col-md-4">
                                <label class="text-white" for="state">Nom de l'article</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control" type="text" id="nom_article" name="nom_article" disabled required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                           
                            <div class="col-md-4">
                                <label class="text-white" for="state">Catégorie</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="categorie" name="categorie" disabled required />
                                    </div>
                                </div>
                            </div>
                              <!---->
                              <div class="col-md-4">
                                <label class="text-white" for="state">Prix de l'article</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="prix_de_vente" name="prix_de_vente" disabled required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                             <!---->
                               <div class="col-md-4">
                                <label class="text-white" for="state">Quantité en stock</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="quantite" name="quantite" disabled required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                             <!---->
                             <div class="col-md-4">
                                <label class="text-white" for="state">Quantité en commandée</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="quantite_com" name="quantite_com" required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                             <!---->
                             <div class="col-md-4">
                                <label class="text-white" for="state">Montant donné en espèce</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="montant_espece" name="montant_espece"  required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <!---->
                            <div class="col-md-4">
                                <label class="text-white" for="state">Prix total de la commande</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="montant_total" name="montant_total" disabled required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                             <!---->
                             <div class="col-md-4">
                                <label class="text-white" for="state">Montant à rendre</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="montant_rendu" name="montant_rendu" disabled  required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <!---->
                            <div class="col-md-4">
                                <label class="text-white" for="state">Identifiant de l'article</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control numerique" type="text" id="id_article" name="id_article" disabled  required />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="alert alert-success " role="alert">
                             <div class="row g-3 my-2" >

                                    <div class="col-md-2 mb-3">
                                    <p>Référence</p>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <p>Quantité commandée</p>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <p>nom de l'article</p>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <p>Prix unitaire</p>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <p>Prix total</p>
                                    </div> 
                             </div>
                             <!--affichage detail facture-->
                                <div class="row" id="det_com">
                                    <div class="col-md-2 mb-3 ">
                                    
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        
                                    </div> 
                                    <div class="col-md-2 mb-3">
                                    
                                    </div> 
                                </div>
                                <!--edition facture-->
                                <div class="row" id="editer">
                                        
                                </div>
                        </div>
                       
                            <div class="col-md-3">
                                
                                <div class="p-3 shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                         <input  class="btn btn-primary" type="button" id="ajouter" name="ajouter" value="Ajouter" onclick="plus_com();">
                                         <input   class="btn btn-success"  type="button" id="valider" value="Valider"  type="submit" onclick="document.getElementById('param').value='facturer';recolter();">
				                         <input type="text" id="param" name="param"  style="visibility:hidden;">
                                         <input type="text" id="chaine_com" name="chaine_com"  style="visibility:hidden;">
                                         <input type="text" id="total_com" name="total_com"  style="visibility:hidden;">  
                                    </div>
                                </div>
                            </div>
                            <!---->

                        </div>
                        


                    </form>
                     
                </div>
           
         <!--Contenu de la page-->
  

<script language='javascript' type="text/javascript">
  var tot_com = 0;
  function plus_com()
  {
    
    if(ref_client.value !=0 && ref_article.value !=0 && quantite_com.value !=0 && quantite_com.value != "")
     {
        if(parseInt(quantite_com.value) > parseInt(quantite.value))
        
          alert("La quantité en stock est insuffisante pour effectuer cette commande !");
        
        else
        {
               var ref_p = ref_article.value;
               var qte_p =  quantite_com.value;
               var des_p = nom_article.value;
               var prixht = prix_de_vente.value;
               var idProd = id_article.value;
               var catA = categorie.value;
              

               tot_com = tot_com+qte_p*prixht;
               montant_total.value = tot_com.toFixed(2);
               total_com.value =  montant_total.value;
               chaine_com.value += "|" + ref_p + ";" + qte_p + ";" + des_p + ";" + prixht + ";" + idProd + ";" + catA;
               reste();
               facture();
        }
     }

  }

  function reste()
  {
    var mnt_espece = montant_espece.value;
    var mnt_rendu = 0;
    mnt_rendu = mnt_espece - montant_total.value;
    montant_rendu.value = mnt_rendu.toFixed(2);  
  }
  function facture()
  {
        var tab_com = chaine_com.value.split('|');
        var nb_lignes = tab_com.length;
        document.getElementById("det_com").innerHTML = "";
        for(ligne=0;ligne<nb_lignes;ligne++)
          {
              if(tab_com[ligne]!="")
                {
                  var ligne_com = tab_com[ligne].split(';');
                  document.getElementById("det_com").innerHTML += "<div class='col-md-2 mb-3'>" + ligne_com[0] + "</div>";
                  document.getElementById("det_com").innerHTML += "<div class='col-md-2 mb-3'>" + ligne_com[1] + "</div>";
                  document.getElementById("det_com").innerHTML += "<div class='col-md-2 mb-3'>" + ligne_com[2] + "</div>";
                  document.getElementById("det_com").innerHTML += "<div class='col-md-2 mb-3'>" + ligne_com[3] + "</div>";
                  document.getElementById("det_com").innerHTML += "<div class='col-md-2 mb-3'>" + (ligne_com[1]*ligne_com[3]).toFixed(2) + "</div>";
                  document.getElementById("det_com").innerHTML += "<div class='col-md-2 mb-3'>   <input style='height:30px;font-size:12px'  class='btn  btn-outline-danger' type='button' title='Supprimer le produit' value='X' onclick='suppr(\""+tab_com[ligne]+"\");'>  </div>";
              
      

                }
          }
  }


  function suppr(ligne_s)
  {
      chaine_com.value = chaine_com.value.replace('|' + ligne_s, '');
      var tab_detail = ligne_s.split(';');
      montant_total.value = (montant_total.value -tab_detail[1]*tab_detail[3]).toFixed(2);
     
      total_com.value =  montant_total.value;
    
      tot_com.value = total_com.value*1;
      reste();
      facture();

  }
</script>

</body>
</html>