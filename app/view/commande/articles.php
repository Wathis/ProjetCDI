<div class="container">
    <h2 class="text-center">Articles de la commande <?php echo $co_numero ?></h2>
    </br></br>
    <table id="keywords" class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <thead class="thead-light">
        <tr>
            <th>Numero</th>
            <th>Nom</th>
            <th>Couleur</th>
            <th>Poids</th>
            <th>Prix Achat</th>
            <th>Prix Vente</th>
            <th>Prix Vendu</th>
            <th>Quantité</th>
            <th>En stock</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article) { ?>
            <tr>

                <td><?php echo $article["AR_NUMERO"]; ?></td>
                <td><?php echo $article["AR_NOM"]; ?></td>
                <td><?php echo $article["AR_COULEUR"]; ?></td>
                <td><?php echo $article["AR_POIDS"]; ?></td>
                <td><?php echo $article["AR_PA"] . ' €'; ?></td>
                <td><?php echo $article["AR_PV"] . ' €'; ?></td>
                <td>
                    <?php 
                        echo $article["LIC_PU"]. ' €'; 
                        if ($article["LIC_PU"] != $article["AR_PV"]) {
                            $pu = (double) $article["LIC_PU"]; 
                            $pv = (double) $article["AR_PV"]; 
                            $reduction = (double) $pu / $pv * ((double) 100);
                            echo ' (' . $reduction . '%)';
                        }
                    ?>    
                </td>
                <td><?php echo $article["LIC_QTCMDEE"]; ?></td>
                <td><?php echo $article["AR_STOCK"]; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
