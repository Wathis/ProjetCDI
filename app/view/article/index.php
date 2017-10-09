<div class="container">
	<script src="<?php echo URL; ?>js/tri.js"></script>
    <h2>Page article</h2>

	<form action="<?php echo URL .'article/rechercherArt' ?>" method="post">
	<label for='choix'>Recherche sur :</label>
	<select name='choix' id="choix" onchange="tri(this)">
		<option value='Numero' selected>Numero</option>
		<option value='Nom'>Nom</option>
		<option value='Poids'>Poids</option>
		<option value='Couleur'>Couleur</option>
		<option value='Stock'>Stock</option>
	</select>
	<input type='text' name='champ'></imput>
	<input type='submit' value='Recherche'></input>
	<div id="tri" style ="display:inline">
	</div>
	</form>
	</br></br>
	<table id="keywords" cellspacing="0" cellpadding="0">
		<thead>
       		<tr>
	           <th>Numero</th>
	           <th>Nom</th>
	           <th>Poids</th>
	           <th>Couleur<th>
	           <th>Stock<th>
	           <th>Numero Fourniseur<th>
       		</tr>
   		</thead>
   <tbody>
	<?php foreach ($articles as $article) { ?>
		<tr>
		<td class="lalign"><?php echo $article["AR_NUMERO"]; ?></td>
		<td><?php echo $article["AR_NOM"]; ?></td>
		<td><?php echo $article["AR_POIDS"]; ?></td>
		<td><?php echo $article["AR_COULEUR"]; ?></td>
		<td></td>
		<td><?php echo $article["AR_STOCK"]; ?></td>
		<td></td>
		<td><?php echo $article["FO_NUMERO"]; ?></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
<style>
table a:link {
	color: #666;
	font-weight: bold;
	text-decoration:none;
}
table a:visited {
	color: #999999;
	font-weight:bold;
	text-decoration:none;
}
table a:active,
table a:hover {
	color: #bd5a35;
	text-decoration:underline;
}
table {
	font-family:Arial, Helvetica, sans-serif;
	color:#666;
	font-size:12px;
	text-shadow: 1px 1px 0px #fff;
	background:#eaebec;
	margin:20px;
	border:#ccc 1px solid;

	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;

	-moz-box-shadow: 0 1px 2px #d1d1d1;
	-webkit-box-shadow: 0 1px 2px #d1d1d1;
	box-shadow: 0 1px 2px #d1d1d1;
}
table th {
	padding:21px 25px 22px 25px;
	border-top:1px solid #fafafa;
	border-bottom:1px solid #e0e0e0;

	background: #ededed;
	background: -webkit-gradient(linear, left top, left bottom, from(#ededed), to(#ebebeb));
	background: -moz-linear-gradient(top,  #ededed,  #ebebeb);
}
table th:first-child {
	text-align: left;
	padding-left:20px;
}
table tr:first-child th:first-child {
	-moz-border-radius-topleft:3px;
	-webkit-border-top-left-radius:3px;
	border-top-left-radius:3px;
}
table tr:first-child th:last-child {
	-moz-border-radius-topright:3px;
	-webkit-border-top-right-radius:3px;
	border-top-right-radius:3px;
}
table tr {
	text-align: center;
	padding-left:20px;
}
table td:first-child {
	text-align: left;
	padding-left:20px;
	border-left: 0;
}
table td {
	padding:18px;
	border-top: 1px solid #ffffff;
	border-bottom:1px solid #e0e0e0;
	border-left: 1px solid #e0e0e0;

	background: #fafafa;
	background: -webkit-gradient(linear, left top, left bottom, from(#fbfbfb), to(#fafafa));
	background: -moz-linear-gradient(top,  #fbfbfb,  #fafafa);
}
table tr.even td {
	background: #f6f6f6;
	background: -webkit-gradient(linear, left top, left bottom, from(#f8f8f8), to(#f6f6f6));
	background: -moz-linear-gradient(top,  #f8f8f8,  #f6f6f6);
}
table tr:last-child td {
	border-bottom:0;
}
table tr:last-child td:first-child {
	-moz-border-radius-bottomleft:3px;
	-webkit-border-bottom-left-radius:3px;
	border-bottom-left-radius:3px;
}
table tr:last-child td:last-child {
	-moz-border-radius-bottomright:3px;
	-webkit-border-bottom-right-radius:3px;
	border-bottom-right-radius:3px;
}
table tr:hover td {
	background: #f2f2f2;
	background: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#f0f0f0));
	background: -moz-linear-gradient(top,  #f2f2f2,  #f0f0f0);	
}
<style>
</div>
