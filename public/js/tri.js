function tri(sel){
	choix = sel.value;
	choix = String(choix);
	if(choix.indexOf("Numero") == -1){
		document.getElementById('tri').innerHTML = '<input type="radio" id="ordre" name="ordre" value="asc" checked><label for="asc">Alphabetique</label><input type="radio" id="ordre" name="ordre" value="desc"><label for="desc">Inverse</label>';		
	}else
	{
		document.getElementById('tri').innerHTML = '<input type="radio" id="ordre" name="ordre" value="asc" checked><label for="asc">Croissant</label><input type="radio" id="ordre" name="ordre" value="desc"><label for="desc">Decroissant</label>';
	}
}

window.onload = function() {
	tri(document.getElementById('choix'));
};
