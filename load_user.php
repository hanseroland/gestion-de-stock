<?php

  $output = "";

  $output .= "
        <div  style='overflow:auto;white-space: nowrap;'>
        <table class='table bg-white rounded shadow-sm  table-hover'>
            <thead>
                <tr>
                    <th scope='col' width='50'>#</th>
                    <th scope='col'>nom</th>
                    <th scope='col'>email</th>
                    <th scope='col'>roles</th>
                    <th scope='col'>Acitions</th>
                    
                </tr>
            </thead>";
            $output .= "<tbody>";
                 foreach ($result as $result) :
            $output .= "<tr>
                        <th scope='row'> ".$result['id_utilisateur']."</th>
                        <td > ".$result['nom']."</td>
                        <td > ".$result['email']."</td>
                        <td > ".$result['roles']."</td>
                        <td>
                            <a href='modifierUti.php?id_utilisateur=".$result['id_utilisateur']."'   style='text-decoration:none' >Modifier</a> | 
                            <a href=config/utilisateurs/supprimer.php?id_utilisateur=<".$result['id_utilisateur']."' onclick='return confirm( 'ETES VOUS SUR DE VOULOIR SUPPRIMER CET ELEMENT?' )' style='text-decoration:none;color:red'>Supprimer</a>
                        </td>
                    </tr>  "; 
                 endforeach;
                
      $output .=" </tbody>
        </table>
        </div>
      ";
echo $output;

?>
