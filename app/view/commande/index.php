<div class="container">
    <script src="<?php echo URL; ?>js/tri.js"></script>
    <link href="<?php echo URL; ?>css/tableau.css" rel="stylesheet">
    <h2>Page commande</h2>

    <form action="<?php echo URL .'commande/rechercherCommande' ?>" method="post">
        <label for='choix'>Recherche sur :</label>
        <select name='choix' id="choix" onchange="tri(this)">
            <option value='Numero' selected>Numero</option>
            <option value='Date'>Date</option>
            <option value='Client'>Client</option>
        </select>
        <input type='text' name='champ'></imput>
        <input type='submit' value='Recherche'>
        <div id="tri" style ="display:inline">
        </div>
    </form>

    </br></br>
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
                <td><?php echo $commande["CO_NUMERO"]; ?></td>
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
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Livraison/commandes?co_numero=' . $commande["CO_NUMERO"] . '"'; ?>>Livraisons</a>
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



