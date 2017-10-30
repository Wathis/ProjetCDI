<div class="container">
    <h2>Page commande</h2>
    <a href="<?php echo URL . 'commande/ajouter' ?>">Ajouter une commande</a><br \><br \>
    <form action="<?php echo URL .'commande/rechercherCo' ?>" method="post">
        <label for='choix'>Recherche sur :</label>
        <select name='choix' id="choix" onchange="tri(this)">
            <option value='CO_Numero' selected>Numero</option>
            <option value='CO_Date'>Date</option>
            <option value='CL_Numero'>Numero Client</option>
        </select>
        <input type='text' name='champ'></imput>
        <input type='submit' value='Recherche'>
        <div id="tri" style ="display:inline">
        </div>
    </form>

    </br>
    <?php  
        foreach ($commandes as $commande) {
            if (in_array($commande["CO_NUMERO"],$commandesSansLivraisons)){
                echo '<div style="color:red">Des commandes n\'ont pas de livraison</div>';
                break;
            }
        }
    ?>
    </br>
    <table id="keywords" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>Numero</th>
            <th>Date</th>
            <th>Numero de client</th>
            <th>Magasin numero</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($commandes as $commande) { ?>
            <tr>
                <td>
                    <?php 
                        //Alors c'est un retard
                        if (in_array($commande["CO_NUMERO"],$commandesSansLivraisons)) {
                            echo '<span style="color:red">' . $commande["CO_NUMERO"] . '</span>';
                        } else {
                            echo $commande["CO_NUMERO"]; 
                        }   
                    ?>
                </td>
                <td><?php echo $commande["CO_DATE"]; ?></td>
                <td><?php echo $commande["CL_NUMERO"]; ?></td>
                <td><?php echo $commande["MA_NUMERO"]; ?></td>
                <td><div class="w3-container">
                        <div class="w3-dropdown-hover">
                            <button class="w3-button"><i class="fa fa-bars"></i></button>
                            <div class="w3-dropdown-content w3-bar-block w3-border">
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Magasin/index?ma_numero=' . $commande["MA_NUMERO"] . '"'; ?>>Magasin</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Client/consulter?cl_numero=' . $commande["CL_NUMERO"] . '"'; ?>>Client</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Commande/consulterArticles?co_numero=' . $commande["CO_NUMERO"] . '"'; ?>>Consulter articles</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Livraison/commandes?co_numero=' . $commande["CO_NUMERO"] . '"'; ?>>Livraisons déjà faites</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Article/restantALivrer?co_numero=' . $commande["CO_NUMERO"] . '"'; ?>>Restant à livrer</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Livraison/ajouter?co_numero=' . $commande["CO_NUMERO"] . '"'; ?>>Ajouter nouvelle livraison</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Pdf/index?co_numero=' . $commande["CO_NUMERO"] . '"'; ?>>Récupérer le pdf</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>



