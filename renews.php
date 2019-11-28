<?php
$page = "index";
include('config.php');
include('header.php');
include('nav.php');

 error_reporting( ~E_NOTICE );
    
    if (isset($_POST['go'])) {

        $nom = htmlspecialchars($_POST['nom']);//htmlspecialchars Convertit les caractères spéciaux en entités HTML
        //récupération du tri2 et insertion de la valeur dans la variable $tri2
        $contact = htmlspecialchars($_POST['contact']);
        $telcom = htmlspecialchars($_POST['telcom']);
        $math = htmlspecialchars($_POST['math']);
        $php = htmlspecialchars($_POST['php']);
        $moy = ($php + $math +$anglais)/3;

        if (empty($nom) OR empty($contact) OR empty($telcom)OR empty($math)OR empty($php)) {
            //On affiche un message d'erreur demandant à l'utilisateur de remplir tous les champs du formulaire
            echo '
                   <div class="bs-example text-center">    
                       <div class="toast fade show">
                           <div class="toast-header red" >
                               <strong class="mr-auto"><i class="fa fa-exclamation-triangle"></i> Information</strong>
                               <button type="button" class="ml-2 mb-1 close red" data-dismiss="toast">&times;</button>
                           </div>
                           <div class="toast-body red">Veuillez; s\'il vous plaît remplir tous les champs du formulaire</div>
                       </div>
                   </div>  '; 
        }

         $sql = "INSERT INTO `users` ( `nom`, `contact`, `telcom`,`math`, `php`, `moy`) VALUES (:nom, :contact, :telcom,:math, :php, :moy);";//$sql reçoit la requête d'exécution d'insertion dans la table users des différents paramètre
         $req = $bdd->prepare("update users set nom='".$nom."', contact='".$contact. "', telcom='".$telcom."', math='".$math."', php='".$php."', moy= '".$moy ."' where id=" . $_GET["id"]);

                        //Une fois la requête preparée on l'exécute 
        $result = $req->execute([
                                ':nom'      => $nom,
                                ':contact' => $contact,
                                ':telcom'   => $telcom,
                                ':math'      => $math,
                                ':php' => $php,
                                ':moy'   => $moy
                        ]);
            if(!empty($result)){
                            //on affiche que tout est bon et que celui-ci sera rédirigé dans 2 secondes
                            echo '
                                    <div class="bs-example text-center">    
                                        <div class="toast fade show">
                                            <div class="toast-header green" >
                                                <strong class="mr-auto green"><i class="fa fa-check-circle green"></i> Succes</strong>
                                                <button type="button" class="ml-2 mb-1 close green" data-dismiss="toast">&times;</button>
                                            </div>
                                            <div class="toast-body green">
                                                Bravo l\'enregistrement a bien été fait et vous serez rédirigez d\'ici 2 secondes
                                            </div>
                                        </div>
                                    </div> ';
                            header("refresh:2;index.php");//header permet la redirection vers la nouvelle qu'on souhaite, et le refresh permet de définir en seconde le temps mis.
                        }
        }

    $req = $bdd->prepare("SELECT * FROM users WHERE id=".$_GET["id"]);
    $req->execute();
    $result = $req->fetchAll();

?>

 
<div class="container mt-5">
   
    <div class="jumbotron">
        <div class="container mt-5">
            <div class="row">
                    <h1 class="display-4">Modifications des moyennes</h1>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm"></div>
                <div class="col-sm">
                    <a name="" id="" class="btn btn-primary " href="index.php" role="button">
                        <i class="fa fa-arrow-left fa-3x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <hr class="my-4">

        

                <form class="container" action="" method="POST" name="frmAdd" class="ml-5 text-center" enctype="multipart/form-data">

                    <h2 class="text-center"></h2>


                    <div class="form-group ">
                        <label >nom</label>
                        <input type="text" name="nom" class="form-control w-25" value="<?=$result[0]["nom"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >contact</label>
                        <input type="text" name="contact" class="form-control w-25" value="<?=$result[0]["contact"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Telcom</label>
                        <input type="text" name="telcom" class="form-control w-25" value="<?=$result[0]["telcom"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Math</label>
                        <input type="text" name="math" class="form-control w-25" value="<?=$result[0]["math"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >php</label>
                        <input type="text" name="php" class="form-control w-25" value="<?=$result[0]["php"];?>" >
                    </div>
                    <div class="form-group ">
                        <label >Moy-General</label>
                        <input type="text" name="moy" class="form-control w-25" value="<?=$result[0]["moy"];?>" >
                    </div>

                    <input type="submit" name="go" class="btn btn-primary">

                </form>
                
            
    </div>
</div>


</body>
</html>