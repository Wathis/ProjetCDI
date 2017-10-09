function tri(sel){
	choix = sel.value;
	choix = String(choix);
	if(choix == "Nom" || choix == "Prenom" || choix == "Localite" || choix == "Pays"){
		document.getElementById('tri').innerHTML = '<input type="radio" id="ordre" name="ordre" value="alpha" checked><label for="alpha">Alphabetique</label><input type="radio" id="ordre" name="ordre" value="dalpha"><label for="dalpha">Inverse</label>';
	}
	if(choix == "Numero"){
		document.getElementById('tri').innerHTML = '<input type="radio" id="ordre" name="ordre" value="croi" checked><label for="croi">Croissant</label><input type="radio" id="ordre" name="ordre" value="dcroi"><label for="dcroi">Decroissant</label>';
	}
}

window.onload = function() {
	tri(document.getElementById('choix'));
};
