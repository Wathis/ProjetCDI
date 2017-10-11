<div class="container">
    <script src="<?php echo URL; ?>js/tri.js"></script>
    <link href="<?php echo URL; ?>css/tableau.css" rel="stylesheet">
    <h2>Page article</h2>

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
        </tr>
        </thead>
        <tbody>
        <?php foreach ($commandes as $commande) { ?>
            <tr>
                <td><?php echo $commande["CO_NUMERO"]; ?></td>
                <td><?php echo $commande["CO_DATE"]; ?></td>
                <td><?php echo $commande["CL_NUMERO"]; ?></td>
                <td><?php echo $commande["MA_NUMERO"]; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
