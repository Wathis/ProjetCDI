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

    <?php  
        if (count($livraisonsEnRetardIds) > 0) {
            echo '<div style="color:red">Des livraisons sont en retard</div>';
        }
    ?>

    <table id="keywords" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th>Numero</th>
            <th>Date de livraison</th>
            <th>Numero de client</th>
            <th>Numero magasin</th>
            <th>Numero commande</th>
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
                <td><?php echo $livraison["CL_NUMERO"]; ?></td>
                <td><?php echo $livraison["MA_NUMERO"]; ?></td>
                <td><?php echo $livraison["CO_NUMERO"]; ?></td>
                <td><div class="w3-container">
                        <div class="w3-dropdown-hover">
                            <button class="w3-button"><i class="fa fa-bars"></i></button>
                            <div class="w3-dropdown-content w3-bar-block w3-border">
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Magasin/index?ma_numero=' . $livraison["MA_NUMERO"] . '"'; ?>>Magasin</a>
                                <a class="w3-bar-item w3-button" href=<?php echo '"' . URL . 'Article/articlesDeLivraison?li_numero=' . $livraison["LI_NUMERO"] . '"'; ?>>Voir articles</a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
