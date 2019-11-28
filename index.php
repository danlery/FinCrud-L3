<?php
$page = "index";
require_once('config.php');
include('header.php');
include('nav.php');

$req = $bdd->prepare("SELECT * FROM users");
$req->execute();
$users = $req->fetchAll(); 


?>

    <div class="jumbotron mt-5">
        <h3 class="display-3">MOYENNE DE L'ETUDIANT<a name="" id="" class="btn btn-success ml-5" href="moyen.php" role="button"><i class="fa fa-plus-square fa-3x" aria-hidden="true"></i></a>
</h3>
        <hr class="my-2">
        <p class="lead">
            <table class="table">
            <thead>
                <tr>
                <th scope="col">#id</th>
                <th scope="col">Nom Et Prenom</th>
                <th scope="col">contact</th>
                <th scope="col">TELCOM</th>
                <th scope="col">MATH</th>
                <th scope="col">PHP</th>
                <th scope="col">MOY-GENERAL</th>
                <th scope="col">Modify</th>
                <th scope="col">Delete</th>
                </tr>
            </thead>
            <?php
                if (!empty($users)) {
                   foreach ($users as $mate) {
            ?>
            <tbody>
                <tr>
                <th scope="row"><?= $mate["id"]; ?></th>
                <td><?= $mate["nom"]; ?></td>
                <td><?= $mate["contact"]; ?></td>
                <td><?=$mate["telcom"];?></td>
                <td><?= $mate["math"]; ?></td>
                <td><?= $mate["php"]; ?></td>
                <td><?=$mate["moy"];?></td>
                 <td><a name="" id="" class="btn btn-primary" href="renews.php?id=<?= $mate['id']?>" role="button"><i class="fa fa-book" aria-hidden="true"></i></a></td>
                <td> <a name="" id="" class="btn btn-primary" href="supri.php?id=<?= $mate['id']?>" onclick="return confirm('Voulez vous supprimer cette donnéee ?')" role="button"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                </tr>
            </tbody>
            <?php 

                   }
                }
            ?>

        
            </table>

        </p>
    </div>
</div>

