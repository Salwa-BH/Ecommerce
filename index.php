
<?php
//connecte to BD
$pdo = new PDO(    
    "mysql:dbname=ecom",
    "root",
    ""
);
$sql = "SELECT * FROM produits";
$query = $pdo ->query($sql);
$rows = $query->fetchAll(PDO::FETCH_ASSOC );

//open session
    session_start();//session_destroy();session_start();

if(!isset($_SESSION['panier']))
    $_SESSION['panier']=[];

if(isset($_GET['ref']) && !isset($_SESSION['panier'][$_GET['ref']]) && count($_SESSION['panier'])!=0){
    $_SESSION['panier'][$_GET['ref']]=0;
}

    if(isset($_GET['ref'])){
        
        $_SESSION['panier'][$_GET['ref']]=$_SESSION['panier'][$_GET['ref']]+1;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Modèles</title>
    
</head>
<body>

    <!-- Navbar -->
    <div class="navv">
    <ul>
        <li><h2 style="color:#EBF1F6 ;margin-left:50px">E-commerce vêtements</h2></li>
        <li style="float:right"><a href="#panierT" ><img src="images/panier.jpg" alt="pan-" style="width:30px;height:30px;margin-bottom:5px"> Votre Panier</a></li>
    </ul>
    </div>
    <div class="model" >
        <!-- title -->
        <br><br><br>
        <h1  id="titre">Modèles Vêtements</h1><br>-
    </div>
    <!-- CARDS-->

    <div class="container-fluid padding">
        <div class="row padding">

            <?php foreach($rows as $row) :?>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4" style="text-align:center">   
                    <div class="card" style="background-color:#696969">
                        <img style="padding-top:10px" src="<?="images/".$row['type'].'/'.$row['photo']?>" alt="" class="card-img-top">
                        <div class="card-body" style="color: rgb(214, 209, 202)">
                            <h4 class="card-title"><?= $row['designation']?> </h4>
                            <p class="card-text"> <span style="text-decoration:line-through"> <?= $row['prixNormal'] ?>$</span><span style="padding-left:20px; padding-right:20px"><?= $row['prixPromo'] ?>$</span><?= $row['reference'] ?></p>---<br>
                            <a  class="linkadd"  href="?ref=<?= $row['reference'] ?>" >ADD to Basquet</a><br>---
                        
                        </div>
                    </div><br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <hr>
 <!-- Panier-->
    <div id="panierT">
        <?php
            require_once ('panier.php');
        ?>
    </div>

    <hr>
    <p style="float:right; font-weight: 500; font-size: 15px;">Made By: BATAH SALWA 1GI EHTP</p>
    
</body>
</html>