<div class="container">
        <h2 class="text-center well">Magasins</h2>

    <a  class="btn btn-secondary btn-sm" href="<?php echo URL . 'magasin/ajouter' ?>">Ajouter un magasin</a><br \><br \>
    <form action="<?php echo URL .'magasin/rechercherMagasin' ?>" method="post">
    <label for='choix'>Recherche sur :</label>
    <select name='choix' id="choix" onchange="tri(this)">
        <option value='MA_NUMERO' selected>Numero</option>
        <option value='MA_LOCALITE'>Localite</option>
        <option value='MA_NOM_GERANT'>Prenom</option>
        <option value='MA_NOM_GERANT'>Nom</option>
    </select>
    <input type='text' name='champ'></imput>
    <input class="btn btn-info btn-sm" type='submit' value='Recherche'></input>
    <div id="tri" style ="display:inline">
    </div>
    </form>

    </br></br>
    <table id="keywords" class="table table-striped table-bordered table-hover" cellspacing="0" cellpadding="0">
        <thead class="thead-light">
            <tr>
                <th>Numero</th>
                <th>Localite</th>
                <th>Nom gérant</th>
                <th>Prenom gérant</th>
            </tr>
        </thead>
   <tbody>
    <?php foreach ($magasins as $magasin) { ?>
        <tr>
             <td><?php echo $magasin["MA_NUMERO"]; ?></td>
             <td><?php echo $magasin["MA_LOCALITE"]; ?></td>
             <td><?php echo $magasin["MA_NOM_GERANT"] ?></td>
             <td><?php echo $magasin["MA_PRENOM_GERANT"] ?></td>
        </tr>
    <?php } ?>
    </tbody>
    </table>
    <style>
    </style>
</div>