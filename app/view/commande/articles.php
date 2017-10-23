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
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
