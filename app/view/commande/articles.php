<div class="container">
    <h2>Articles de la commande <?php echo $co_numero ?></h2>
    </br></br>
    <table id="keywords" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>Numero</th>
            <th>Nom</th>
            <th>Couleur</th>
            <th>Poids</th>
            <th>Prix Achat</th>
            <th>Prix Vente</th>
            <th>En stock</th>
            <th></th>
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
                <td><?php echo $article["AR_PV"]. ' €'; ?></td>
                 <td><?php echo $article["AR_STOCK"]; ?></td>
                <td><div class="w3-container">
                        <div class="w3-dropdown-hover">
                            <button class="w3-button"><i class="fa fa-bars"></i></button>
                            <div class="w3-dropdown-content w3-bar-block w3-border">
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
