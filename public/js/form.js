var numberOfArticles = 1;
$(document).ready(function(){
  $("#addArticle").click(function(){
  	//Permet de cloner la div article pour ajouter un nouvel article
  	$('#divArticle' + numberOfArticles).clone().attr('id', 'divArticle' + (numberOfArticles + 1)).insertAfter('#divArticle' + numberOfArticles);
  	$('#divArticle' + (numberOfArticles + 1)).children('.article').attr('name', 'article' + (numberOfArticles + 1));
  	$('#divArticle' + (numberOfArticles + 1)).children('.reduction').attr('name', 'reduction' + (numberOfArticles + 1));
  	$('#divArticle' + (numberOfArticles + 1)).children('.quantity').attr('name', 'quantity' + (numberOfArticles + 1));
  	$('#divArticle' + (numberOfArticles + 1)).children('.articleTitle').text('Article ' + (numberOfArticles + 1) + ' : ');
  	numberOfArticles++;
  });
});