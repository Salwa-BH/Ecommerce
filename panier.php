<?php
    if(isset($_SESSION['panier']) && count($_SESSION['panier'])!=0){
        if(count($_SESSION['panier'])!=0){
            $req = "select distinct * from produits where reference in (";
    
            foreach ($_SESSION['panier'] as $key => $value) {
                $req.="'$key',";
            }
            $req = substr($req, 0, -1);
            $req .= ");";
        
            $query = $pdo->query($req);
            $panier = $query->fetchAll();
        }
        else{
            die();
        }
    
    
    }
    else{
        die();
    }
    $totals=0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Panier</title>
</head>
<body>
    <h1 class="titre" style="text-align:center">VOTRE PANIER</h1>
    <hr>
    <div class="container">
    <table class="table table-hover table-dark" style="background-color:rgb(123, 132, 132); font-weight: 500; font-size: 20px;">
    <thead>
    <tr>
        <th scope="col">TYPE</th>
        <th scope="col">REFERENCE</th>
        <th scope="col">DESIGNATION</th>
        <th scope="col">PRIX</th>
        <th scope="col">PRIX Promo</th>
        <th scope="col">PHOTO</th>
        <th scope="col">Quantité</th>
        <th scope="col">Total</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach ($panier as $results):  ?>
            <tr>
                <?php 
                    if ( $results['prixPromo']=="0" ){
                        $total=$results['prixNormal']*($_SESSION['panier'][$results['reference']]);
                    }
                    if ( $results['prixPromo']!="0" ){
                        $total=$results['prixPromo']*($_SESSION['panier'][$results['reference']]);                        
                    }
                    $totals=$totals+$total;
                ?>

                <td><?= $results['type']; ?></td>
                <td><?= $results['reference']; ?></td>
                <td><?= $results['designation']; ?></td>
                <td><?= $results['prixNormal']; ?>$</td>
                <td><?= $results['prixPromo']; ?>$</td>
                <td><img src="./images/<?= $results['type']; ?>/<?= $results['photo']; ?>" alt=""></td>
                <td><?= $_SESSION['panier'][$results['reference']]; ?></td>
                <td><?= $total ?> $</td>

            </tr>
        <?php endforeach;?>
    </tbody>
    <tr>
        <td>TOTAL  A  PAYER</td>
        <td></td><td></td><td></td><td></td><td></td><td></td>
        <td><?= $totals ?> $</td>
    </tr>
</table></div>
