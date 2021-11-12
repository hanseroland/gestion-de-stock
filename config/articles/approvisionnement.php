<?php 
require('config/bdd/bdd.php');
$requete = $conn->prepare("SELECT * FROM articles"); 
$requete->execute();
$resultats = $requete->fetchAll();
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
   
    <title>approvisionnement</title>
    <script src="config/js/prototype.js"></script>
</head>
<body>
<script language='javascript' type="text/javascript">
function recolter()
{
	document.getElementById("formulaire").request({
		onComplete:function(transport){

 
			if(document.getElementById('tampon').value=='recup_article')
      {
          var tab_info = transport.responseText.split('|');
                    //document.getElementById('id_produit').value = tab_info[0];
		     document.getElementById('nom_article').value = tab_info[0];
                    document.getElementById('quantite').value = tab_info[1];
                    document.getElementById('quantite_aps').value = "";
                    document.getElementById('quantite_article').value = "";

      }
      else
      {
            if(transport.responseText=="OK")
            {
                document.getElementById('quantite_aps').value = parseInt( document.getElementById('quantite').value) + parseInt( document.getElementById('quantite_article').value);
                document.getElementById('msg_reponse').innerText = " Le stock a été mis à jour avec succès!!!";
              }
            else
            {
              document.getElementById('msg_reponse').innerText = "Erreur de  mise à jour, le stock n'a pas été impacté!!!";
            }


      }
		
		}
	});
}

</script>
       
       
        <!--Contenu de la page-->
           
                <div class="container-fluid px-4">
                    <form id="formulaire" name="formulaire" method="POST" action="config/articles/rep_stock.php">

                        <div class="row  bg-secondary">

                            <div class="col-md-3">
                            <label class="text-white"  for="state">référence de l'article</label> <br>
                                <div class="p-3  shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                       <select class="form-control" name="ref_article" id="ref_article" onchange="getElementById('tampon').value='recup_article';recolter();">
                                           <option value="">--Sélectionner un article--</option>
                                                <?php foreach ($resultats as $ref_p) : ?>
									                <option value="<?=$ref_p['ref_article']?>"><?=$ref_p['ref_article']?></option>
								                <?php endforeach ?> 
                                           
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-3">
                                <label  class="text-white" for="state">Nom de l'article</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control" type="text" id="nom_article" name="nom_article" disabled />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-3">
                                <label class="text-white" for="state">Quantite avt ajout</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                         
						                <input class="form-control" type="text" id="quantite" name="quantite" disabled />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-3">
                                <label class="text-white" for="state">Quantite en + ou +</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
						                    <input class="form-control"  type="text" id="quantite_article" name="quantite_article" />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-3">
                                <label class="text-white" for="state">Quantite après ajout</label> <br>
                                <div class="p-3 bg-secondary shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                              
                                      <input class="form-control" type="text" id="quantite_aps" name="quantite_aps" disabled />
                                    </div>
                                </div>
                            </div>
                            <!---->
                            <div class="col-md-3">
                                
                                <div class="p-3 shadown-sm d-flex justify-content-around align-items-center rounded">
                                    <div class="form-group">
                                      <input type="text" id="tampon" name="tampon"  style="visibility:hidden;">    
                                      <input class="btn btn-success"  type="button" id="valider"  name="valider" value="Valider la mise à jour" onclick="getElementById('tampon').value='maj';recolter();">
                                    </div>
                                </div>
                            </div>
                            <!---->
                        </div>
                        <div class="row g-3 mb-4 my-2">
                            <div id="msg_reponse" class="alert alert-success" role="alert">
				               <?php
                                echo "Réponse server";
                               ?>
                            </div>
                        </div>


                    </form>
                     
                </div>
           
         <!--Contenu de la page-->
  

</body>
</html>
