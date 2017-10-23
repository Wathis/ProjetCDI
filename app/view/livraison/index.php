<div class="container">
    <h2>Livraisons
        <?php 
            if (isset($cl_numero)) {
                echo "du client " . $cl_numero;
            }
            if (isset($co_numero)) {
                echo "de la commande " . $co_numero;
            }
        ?>
    </h2>
    <form action="<?php echo URL .'livraison/rechercherLi' ?>" method="post">
        <label for='choix'>Recherche sur :</label>
        <select name='choix' id="choix" onchange="tri(this)">
            <option value='LI_Numero' selected>Numero</option>
            <option value='DATE_LIV'>Date</option>
            <option value='CL_Numero'>Numero Client</option>
            <option value='CO_Numero'>Numero Commande</option>
            <option value='MA_Numero'>Numero Magasin</option>
        </select>
        <input type='text' name='champ'></imput>
        <input type='submit' value='Recherche'>
        <div id="tri" style ="display:inline">
        </div>
    </form>

    <?php  
        foreach ($livraisons as $livraison) {
            if (in_array($livraison["LI_NUMERO"],$livraisonsEnRetardIds)){
                echo '<div style="color:red">Des livraisons sont en retard</div>';
                break;
            }
        }
    ?>

    <table id="keywords" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>Numero</th>
            <th>Date de livraison</th>
            <th>Nom client</th>
            <th>Numero magasin</th>
            <th>Numero commande</th>
            <th>Nom article</th>
            <th>Reste à livrer</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($livraisons as $livraison) { ?>
            <tr>
                <td><?php echo $livraison["LI_NUMERO"]; ?></td>
                <td>
                    <?php 
                        //Alors c'est un retard
                        if (in_array($livraison["LI_NUMERO"],$livraisonsEnRetardIds)) {
                            echo '<span style="color:red">' . $livraison["DATE_LIV"] . '</span>';
                        } else {
                            echo $livraison["DATE_LIV"]; 
                        }   
                    ?>
                </td>
                <td><?php echo $livraison["CL_NOM"]; ?></td>
                <td><?php echo $livraison["MA_NUMERO"]; ?></td>
                <td><?php echo $livraison["CO_NUMERO"]; ?></td>
                <td><?php echo $livraison["AR_NOM"]; ?></td>
                <td><?php echo $livraison["LIC_QTCMDEE"] - $livraison["LIL_QTLIVREE"]; ?></td>
                <td><div class="w3-container">
                        <div class="w3-dropdown-hover">
                            <button class="w3-button"><i class="fa fa-bars"></i></button>
                            <div class="w3-dropdown-content w3-bar-block w3-border">
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Magasin/index?ma_numero=' . $livraison["MA_NUMERO"] . '"'; ?>>Magasin</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Article/articlesDeLivraison?li_numero=' . $livraison["LI_NUMERO"] . '"'; ?>>Voir articles</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Livraison/ajouterQuantite?li_numero=' . $livraison["LI_NUMERO"] . '&ar_numero=' . $livraison["AR_NUMERO"] . '&quantite=1'. '"'; ?>>Nouvel article livré</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
