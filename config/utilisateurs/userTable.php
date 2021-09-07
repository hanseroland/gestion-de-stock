                        <?php
                            require_once('config/bdd/bdd.php');
                            $reqUser = $conn->prepare("SELECT * FROM utilisateurs ORDER BY id_utilisateur ASC  LIMIT 10"); 
                            $reqUser->execute();
                            $resultUser = $reqUser->fetchAll(); 
                        ?>

                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">nom</th>
                                    <th scope="col">roles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resultUser as $resultUser) : ?>
                                    <tr>
                                        <th scope="row"> <?= $resultUser['id_utilisateur'] ?></th>
                                        <td ><?= $resultUser['nom']?></td>
                                        <td ><?= $resultUser['roles']?></td>
                                    </tr>   
                                    <?php endforeach ?> 
                                
                            </tbody>
                        </table>