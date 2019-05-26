<?php

$pdo = new PDO(    
    "mysql:host=localhost;dbname=ecom",
    "root",
    ""
);
$sql = "SELECT * FROM produits";
$stmt = $pdo ->query($sql);
$rows = $stmt->fetchAll(PDO:: FETCH_ASSOC );
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Modèle</title>
</head>
<body>
    <h1 style="text-align:center">Les modèles</h1>
    <!-- CARDS-->

    <div class="container-fluid padding">
        <div class="row padding">

            <?php foreach($rows as $row) :?>

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4" style="text-align:center">   
                    <div class="card" style="background-color: rgb(214, 209, 202)">
                        <img style="padding-top:10px" src="img/<?= $row['photo'] ?>" alt="" class="card-img-top">
                        <div class="card-body" style="background-color: rgb(214, 209, 202)">
                            <h4 class="card-title"><?= $row['designation']?> </h4>
                            <p class="card-text"> <span style="text-decoration:line-through"> <?= $row['prixNormal'] ?>$</span>              <span style="padding-left:20px, padding-right:50px">-<?= $row['prixPromo'] ?>$</span>                      <?= $row['reference'] ?></p>
                            <a href="produits.php?ref=<?= $row['reference'] ?> " class="btn btn-secondary">ADD</a>
                        </div>
                    </div><br>
                </div>
            <?php endforeach; ?>
        </div>
    </div>




</body>
</html>