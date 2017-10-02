function tri(){
	console.log('mdr');
	if($("#choix").val()== 'Nom' || 'Prenom' || 'Localite' || 'Pays'){
		document.getElementById('tri').innerHTML = '<input id="alpha" name="alpha" type="checkbox" value="alpha" class="checkbox"><label for="alpha">ABC</label>';
	}else if($("#choix").val()=='Numero'){
		document.getElementById('tri').innerHTML = '<input id="croi" name="croi" type="checkbox" value="croi" class="checkbox"><label for="croi">123</label>';
	}
}