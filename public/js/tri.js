function tri(sel){
	choix = sel.value;
	choix = String(choix);
	if(choix == "Nom" || choix == "Prenom" || choix == "Localite" || choix == "Pays"){
		document.getElementById('tri').innerHTML = "<label for='ordre'>Classée par :</label><select name='ordre' id='ordre' ><option value='Nom'>Nom</option><option value='Prenom' >Prenom</option><option value='Numero' selected>Numero</option><option value='Localite'>Localité</option><option value='Pays'>Pays</option><input type='radio' id='ordre' name='ordre' value='alpha' checked><label for='ordre'>Alphabétique</label><input type='radio' id='ordre' name='ordre' value='dalpha'><label for='ordre'>Inverse</label>";
	}
	if(choix == "Numero"){
		document.getElementById('tri').innerHTML = '<input type="radio" id="ordre" name="ordre" value="croi" checked><label for="croi">Croissant</label><input type="radio" id="ordre" name="ordre" value="dcroi"><label for="dcroi">Decroissant</label>';
	}
}

window.onload = function() {
	tri(document.getElementById('choix'));
};
