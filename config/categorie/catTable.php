<?php
                            require_once('config/bdd/bdd.php');
                            $reqUser = $conn->prepare("SELECT * FROM categories ORDER BY id_categorie ASC  LIMIT 10"); 
                            $reqUser->execute();
                            $resultUser = $reqUser->fetchAll(); 
                        ?>

                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">catégorie</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultUser as $resultUser) : ?>
                                    <tr>
                                        <th scope="row"> <?= $resultUser['id_categorie'] ?></th>
                                        <td ><?= $resultUser['nom']?></td>
                                    </tr>   
                                    <?php endforeach ?> 
                                
                            </tbody>
                        </table>