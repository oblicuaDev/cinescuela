/*Javascript interfaz grafica Cinescuela
* Copyright(c) 2014, All rights reserved.
*/

/*Perfect scrollbar*/
$(document).ready(function ($) {
	$('.scroll-bar-one').perfectScrollbar({
		suppressScrollX:true,
		wheelPropagation:true,
		wheelSpeed:0.4
	});
	$('.scroll-bar-two').perfectScrollbar({
		suppressScrollX:true,
		wheelPropagation:true,
		wheelSpeed:0.4
	});
	if(language != 'es' && language != 'fr' ){
		language = 'es';
	}
	$('#dash_cycles').click(function(e){
		var cycles=$(".dash_cycle");
		var films=$(".dash_film");
		var cycle=cycles.eq(0);
		var scroll=$('.scroll-bar-one').eq(0);
		if(cycle.css("display")=="none"){
			scroll.animate({scrollTop:0},'slow');
			cycles.fadeIn("slow",'swing',function(){
				films.fadeOut("fast",'swing');
			});
		}
	});
	$('#dash_films').click(function(e){
		var films=$(".dash_film");
		var cycles=$(".dash_cycle");
		var film=films.eq(0);
		var scroll=$('.scroll-bar-one').eq(0);
		if(film.css("display")=="none"){
			scroll.animate({scrollTop:0},'slow');
			films.fadeIn("fast",'swing',function(){
				cycles.fadeOut("slow",'swing');
			});
		}
	});
});

/*Acordion interna pelicula*/
$(function(){
	$('#our_opinion').accordion({
		collapsible:true,
		active:false
	});
});


function get_alias(str)
{

	str=str.replace(/¡/g,"&#161;",str);//Signo de exclamación abierta.&iexcl;
	str=str.replace(/¢/g,"-",str);//Signo de centavo.&cent;
	str=str.replace(/£/g,"-",str);//Signo de libra esterlina.&pound;
	str=str.replace(/¤/g,"-",str);//Signo monetario.&curren;
	str=str.replace(/¥/g,"-",str);//Signo del yen.&yen;
	str=str.replace(/¦/g,"-",str);//Barra vertical partida.&brvbar;
	str=str.replace(/§/g,"-",str);//Signo de sección.&sect;
	str=str.replace(/¨/g,"-",str);//Diéresis.&uml;
	str=str.replace(/©/g,"-",str);//Signo de derecho de copia.&copy;
	str=str.replace(/ª/g,"-",str);//Indicador ordinal femenino.&ordf;
	str=str.replace(/«/g,"-",str);//Signo de comillas francesas de apertura.&laquo;
	str=str.replace(/¬/g,"-",str);//Signo de negación.&not;
	str=str.replace(/®/g,"-",str);//Signo de marca registrada.&reg;
	str=str.replace(/¯/g,"&-",str);//Macrón.&macr;
	str=str.replace(/°/g,"-",str);//Signo de grado.&deg;
	str=str.replace(/±/g,"-",str);//Signo de más-menos.&plusmn;
	str=str.replace(/²/g,"-",str);//Superíndice dos.&sup2;
	str=str.replace(/³/g,"-",str);//Superíndice tres.&sup3;
	str=str.replace(/´/g,"-",str);//Acento agudo.&acute;
	str=str.replace(/µ/g,"-",str);//Signo de micro.&micro;
	str=str.replace(/¶/g,"-",str);//Signo de calderón.&para;
	str=str.replace(/·/g,"-",str);//Punto centrado.&middot;
	str=str.replace(/¸/g,"-",str);//Cedilla.&cedil;
	str=str.replace(/¹/g,"-",str);//Superíndice 1.&sup1;
	str=str.replace(/º/g,"-",str);//Indicador ordinal masculino.&ordm;
	str=str.replace(/»/g,"-",str);//Signo de comillas francesas de cierre.&raquo;
	str=str.replace(/¼/g,"-",str);//Fracción vulgar de un cuarto.&frac14;
	str=str.replace(/½/g,"-",str);//Fracción vulgar de un medio.&frac12;
	str=str.replace(/¾/g,"-",str);//Fracción vulgar de tres cuartos.&frac34;
	str=str.replace(/¿/g,"-",str);//Signo de interrogación abierta.&iquest;
	str=str.replace(/×/g,"-",str);//Signo de multiplicación.&times;
	str=str.replace(/÷/g,"-",str);//Signo de división.&divide;
	str=str.replace(/À/g,"a",str);//A mayúscula con acento grave.&Agrave;
	str=str.replace(/Á/g,"a",str);//A mayúscula con acento agudo.&Aacute;
	str=str.replace(/Â/g,"a",str);//A mayúscula con circunflejo.&Acirc;
	str=str.replace(/Ã/g,"a",str);//A mayúscula con tilde.&Atilde;
	str=str.replace(/Ä/g,"a",str);//A mayúscula con diéresis.&Auml;
	str=str.replace(/Å/g,"a",str);//A mayúscula con círculo encima.&Aring;
	str=str.replace(/Æ/g,"a",str);//AE mayúscula.&AElig;
	str=str.replace(/Ç/g,"c",str);//C mayúscula con cedilla.&Ccedil;
	str=str.replace(/È/g,"e",str);//E mayúscula con acento grave.&Egrave;
	str=str.replace(/É/g,"e",str);//E mayúscula con acento agudo.&Eacute;
	str=str.replace(/Ê/g,"e",str);//E mayúscula con circunflejo.&Ecirc;
	str=str.replace(/Ë/g,"e",str);//E mayúscula con diéresis.&Euml;
	str=str.replace(/Ì/g,"i",str);//I mayúscula con acento grave.&Igrave;
	str=str.replace(/Í/g,"i",str);//I mayúscula con acento agudo.&Iacute;
	str=str.replace(/Î/g,"i",str);//I mayúscula con circunflejo.&Icirc;
	str=str.replace(/Ï/g,"i",str);//I mayúscula con diéresis.&Iuml;
	str=str.replace(/Ð/g,"d",str);//ETH mayúscula.&ETH;
	str=str.replace(/Ñ/g,"n",str);//N mayúscula con tilde.&Ntilde;
	str=str.replace(/Ò/g,"o",str);//O mayúscula con acento grave.&Ograve;
	str=str.replace(/Ó/g,"o",str);//O mayúscula con acento agudo.&Oacute;
	str=str.replace(/Ô/g,"o",str);//O mayúscula con circunflejo.&Ocirc;
	str=str.replace(/Õ/g,"o",str);//O mayúscula con tilde.&Otilde;
	str=str.replace(/Ö/g,"o",str);//O mayúscula con diéresis.&Ouml;
	str=str.replace(/Ø/g,"o",str);//O mayúscula con barra inclinada.&Oslash;
	str=str.replace(/Ù/g,"u",str);//U mayúscula con acento grave.&Ugrave;
	str=str.replace(/Ú/g,"u",str);//U mayúscula con acento agudo.&Uacute;
	str=str.replace(/Û/g,"u",str);//U mayúscula con circunflejo.&Ucirc;
	str=str.replace(/Ü/g,"u",str);//U mayúscula con diéresis.&Uuml;
	str=str.replace(/Ý/g,"y",str);//Y mayúscula con acento agudo.&Yacute;
	str=str.replace(/Þ/g,"b",str);//Thorn mayúscula.&THORN;
	str=str.replace(/ß/g,"b",str);//S aguda alemana.&szlig;
	str=str.replace(/à/g,"a",str);//a minúscula con acento grave.&agrave;
	str=str.replace(/á/g,"a",str);//a minúscula con acento agudo.&aacute;
	str=str.replace(/â/g,"a",str);//a minúscula con circunflejo.&acirc;
	str=str.replace(/ã/g,"a",str);//a minúscula con tilde.&atilde;
	str=str.replace(/ä/g,"a",str);//a minúscula con diéresis.&auml;
	str=str.replace(/å/g,"a",str);//a minúscula con círculo encima.&aring;
	str=str.replace(/æ/g,"a",str);//ae minúscula.&aelig;
	str=str.replace(/ç/g,"a",str);//c minúscula con cedilla.&ccedil;
	str=str.replace(/è/g,"e",str);//e minúscula con acento grave.&egrave;
	str=str.replace(/é/g,"e",str);//e minúscula con acento agudo.&eacute;
	str=str.replace(/ê/g,"e",str);//e minúscula con circunflejo.&ecirc;
	str=str.replace(/ë/g,"e",str);//e minúscula con diéresis.&euml;
	str=str.replace(/ì/g,"i",str);//i minúscula con acento grave.&igrave;
	str=str.replace(/í/g,"i",str);//i minúscula con acento agudo.&iacute;
	str=str.replace(/î/g,"i",str);//i minúscula con circunflejo.&icirc;
	str=str.replace(/ï/g,"i",str);//i minúscula con diéresis.&iuml;
	str=str.replace(/ð/g,"i",str);//eth minúscula.&eth;
	str=str.replace(/ñ/g,"n",str);//n minúscula con tilde.&ntilde;
	str=str.replace(/ò/g,"o",str);//o minúscula con acento grave.&ograve;
	str=str.replace(/ó/g,"o",str);//o minúscula con acento agudo.&oacute;
	str=str.replace(/ô/g,"o",str);//o minúscula con circunflejo.&ocirc;
	str=str.replace(/õ/g,"o",str);//o minúscula con tilde.&otilde;
	str=str.replace(/ö/g,"o",str);//o minúscula con diéresis.&ouml;
	str=str.replace(/ø/g,"o",str);//o minúscula con barra inclinada.&oslash;
	str=str.replace(/ù/g,"o",str);//u minúscula con acento grave.&ugrave;
	str=str.replace(/ú/g,"u",str);//u minúscula con acento agudo.&uacute;
	str=str.replace(/û/g,"u",str);//u minúscula con circunflejo.&ucirc;
	str=str.replace(/ü/g,"u",str);//u minúscula con diéresis.&uuml;
	str=str.replace(/ý/g,"y",str);//y minúscula con acento agudo.&yacute;
	str=str.replace(/þ/g,"b",str);//thorn minúscula.&thorn;
	str=str.replace(/ÿ/g,"y",str);//y minúscula con diéresis.&yuml;
	str=str.replace(/Œ/g,"d",str);//OE Mayúscula.&OElig;
	str=str.replace(/œ/g,"-",str);//oe minúscula.&oelig;
	str=str.replace(/Ÿ/g,"-",str);//Y mayúscula con diéresis.&Yuml;
	str=str.replace(/ˆ/g,"-",str);//Acento circunflejo.&circ;
	str=str.replace(/˜/g,"-",str);//Tilde.&tilde;
	str=str.replace(/–/g,"-",str);//Guiún corto.&ndash;
	str=str.replace(/—/g,"-",str);//Guiún largo.&mdash;
	str=str.replace(/'/g,"-",str);//Comilla simple izquierda.&lsquo;
	str=str.replace(/'/g,"-",str);//Comilla simple derecha.&rsquo;
	str=str.replace(/,/g,"-",str);//Comilla simple inferior.&sbquo;
	str=str.replace(/"/g,"-",str);//Comillas doble derecha.&rdquo;
	str=str.replace(/"/g,"-",str);//Comillas doble inferior.&bdquo;
	str=str.replace(/†/g,"-",str);//Daga.&dagger;
	str=str.replace(/‡/g,"-",str);//Daga doble.&Dagger;
	str=str.replace(/…/g,"-",str);//Elipsis horizontal.&hellip;
	str=str.replace(/‰/g,"-",str);//Signo de por mil.&permil;
	str=str.replace(/‹/g,"-",str);//Signo izquierdo de una cita.&lsaquo;
	str=str.replace(/›/g,"-",str);//Signo derecho de una cita.&rsaquo;
	str=str.replace(/€/g,"-",str);//Euro.&euro;
	str=str.replace(/™/g,"-",str);//Marca registrada.&trade;
	str=str.replace(/ & /g,"-",str);//Marca registrada.&trade;
	str=str.replace(/\(/g,"-",str);
	str=str.replace(/\)/g,"-",str);
	str=str.replace(/�/g,"-",str);
	str=str.replace(/\//g,"-",str);
	str=str.replace(/ /g,"-",str);//Espacios
	str=str.replace(/  /g,"p",str);//Espacios
	str=str.replace(/\./g,"",str);//Punto
	
	//Mayusculas
	str=str.toLowerCase();
	
	return(str);
}
$(document).ready(function(){
	
	/*Selects filtro*/
	//alert(myuVar);
	if(myuVar!="")
	{
		
		var q_links = $("a");
		q_links.each(function(index, element) {
			
			var current_link = $(this).attr("href");
			
			if(current_link.indexOf("?")>-1)
			{
				var conector = "&";
			}else
			{
				var conector = "?";
			}
			
			if(current_link.indexOf("javascript:")==-1)
			{
			
            //$(this).attr("href",current_link+conector+"utoken="+myuVar);
			}
        });
		
	}
	
	$('#select_todas').selectmenu({select:function(event,ui){
		ga('send', 'event', 'Filtro películas', 'click', ui.item.label);
	}});
	
	$('#select_asignaturas').selectmenu({select:function(event,ui){
		ga('send', 'event', 'Filtro películas', 'click', ui.item.label);
	}});
	
	$('#select_etiquetas').selectmenu({select:function(event,ui){
		ga('send', 'event', 'Filtro películas', 'click', ui.item.label);
	}});
	
	$('#select_todos').selectmenu(
		{
		select:function(event,ui){
		ga('send', 'event', 'Filtro películas', 'click', ui.item.label);
		}}
	);
	
	
	
	$(document).on('click', '#select_todas-menu li', function(){
		location.href=""+lang+"/peliculas/featured/"+get_alias($("#select_todas option:selected").text())+"-"+$("#select_todas").val();
    	});
	$(document).on('click', '#select_asignaturas-menu li', function(){
		location.href=""+lang+"/peliculas/subject/"+get_alias($("#select_asignaturas option:selected").text())+"-"+$("#select_asignaturas").val();
    	});
	$(document).on('click', '#select_etiquetas-menu li', function(){
		location.href=""+lang+"/peliculas/topic/"+get_alias($("#select_etiquetas option:selected").text())+"-"+$("#select_etiquetas").val();
    	});
	$("#fSearch").submit(function(e){
		e.preventDefault();
		var rep = $("#search").val().replaceAll(" ","_");
		location.href=""+lang+"/peliculas/busquedas/"+rep;
	});
	


		
	/*Carrusel peliculas interna ciclo*/
	$('#carousel_movies_cycle').bxSlider({
		minSlides: 1,
		maxSlides: 5,
		slideWidth: 170,
		slideMargin: 10,
		pager:false,
		speed:2000
	});
	
	/*Slider frases cinescuela home*/
	$('.slider_cinescuela').bxSlider({
		speed:2000,
		auto:true,
		pause:8000
	});
	
	/*Slider peliculas del mes*/
	$('.slider_movies').bxSlider({
		speed:1500,
		mode:'fade',
		pagerCustom: '#carousel_movies',
		controls:false
	});
	$('#carousel_movies').bxSlider({
		minSlides: 1,
		maxSlides: 5,
		slideWidth: 170,
		slideMargin: 10,
		pager:false,
		speed:2000
	});
	$('#carousel_movies > li a.active').parent().addClass('active');
	$('#carousel_movies > li').on('click',function(){
		$('#carousel_movies > li').removeClass('active');
		$(this).addClass('active');
	});
	
	/*Slider frases educacion home*/
	$('#slider_phr_edu').bxSlider({
		controls:false,
		speed:2500,
		auto:true,
		pause:5000
	});

	/*Abrir fancy login*/
	$('.open_login').colorbox({
		maxWidth:'480px',
		width:'95%'
	});
	$('.open_forgot').colorbox({
		maxWidth:'480px',
		width:'95%'
	});
	/*Abrir recordar contrasenia*/
	$('.r_pass').live('click',function(e){
		e.preventDefault();
		$.colorbox({href:$(this).attr('href'),width:480})
	});
	
	/*Fancy videos interna pelicula*/
	$('.v_trailer').colorbox({
		iframe:true,
		maxWidth: 700,
		maxHeight: 450,
		width:'90%',
		height:'90%',
		className:'video'
	});

	/*menu fijo home*/
	if($('.home #main_menu').length){var menu = $('.home #main_menu').offset().top;}
	$(window).on('scroll',function(){
		menu_fixed(menu);
	});
	menu_fixed(menu);
	
	/*ancla ver mas home*/
	$('.learn_more a').on('click',function(e){
		e.preventDefault();
		enlace  = $(this).attr('href');
		$('html, body').animate({scrollTop: $(enlace).offset().top}, 2000);
	});
	
	/*slider de pagina completa*/
	allwindow($('.phrases_cinescuela'));
	allwindow($('.movies_month'));

	/*abrir menu princial (responsive)*/
	$('#btn_menu').on('click',function(e){
		e.preventDefault();
		$('#main_menu > div > ul').toggleClass('menu_active');
		$(this).toggleClass('menu_active');
	});
	loadUiWord();
});
/*resize de la pantalla*/
$(window).resize(function(){
	/* resize Selects filtro*/
	$('#select_todas').selectmenu("refresh");
	$('#select_asignaturas').selectmenu("refresh");
	$('#select_etiquetas').selectmenu("refresh");
	$('#select_todos').selectmenu("refresh");
});


//Oreka SDK
var OrekaCloud = new O("d1eb63ddc08ca2f41401b60bc6b7fc87*1.3",0,0);
var none = "";

/*
OrekaCloud.getCollection(6,"created","downward",0,1,function(result_ciclos){
    var objCiclos = result_ciclos.responseJSON;
    for(var i=0; i<objCiclos.length; i++){
        ciclos.push(objCiclos[i]);
    }
});
 */
/*OrekaCloud.helloworld(function(helloworld){
	console.log(helloworld);
});*/

/*funcion slider de pagina completa*/
function allwindow(obj){
	var w_window = $(window).width(), h_window = $(window).height();	
	obj.css({'height':h_window+'px'})
}

/*funcion menui fixed*/
function menu_fixed(menu){
	if($(window).scrollTop() >= menu){$('#page_header').addClass('fixed')}
	else if($(window).scrollTop() < menu){$('#page_header').removeClass('fixed')}
}

/*pantalla loading*/
$(window).load(function(){
	detectarCarga();
});
function detectarCarga(){ 
	//document.getElementById("imgLOAD").style.display="none";
	var element= document.getElementById("loading_page");
	if(element!=null){
		fade(element);
	}
}
function fade(element) {
	var op = 1;  // initial opacity
	var timer = setInterval(function () {
		if (op <= 0.1){
			clearInterval(timer);
			element.style.display = 'none';
		}
		element.style.opacity = op;
		element.style.filter = 'alpha(opacity=' + op * 100 + ")";
		op -= op * 0.1;
	}, 50);
}
/*   COOKIES   */
function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

function checkCookie() {
	var user = getCookie("username");
	if (user != "") {
		alert("Welcome again " + user);
	} else {
		user = prompt("Please enter your name:", "");
		if (user != "" && user != null) {
			setCookie("username", user, 365);
		}
	}
}
function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
	vars[key] = value;
	});
	return vars;
}

var ui_words = new Array();
var functionLCompleted = false;


function loadUiWord(){
	
	$.getJSON("js/data_static.json", function(palabras) {

		$.each(palabras,function(key,palabra)
			{
				ui_words.push({row:palabra.row,es:palabra.es,fr:palabra.fr});
		 	});
		return functionLCompleted = true;
	});
}
function findUiWord( row , lang){

	if(functionLCompleted){
		//console.log(ui_words[row][lang]);
		var value = ui_words[row][lang];
		return value;
	}else{
		setTimeout(function(){
				//console.log('waiting');
				findUiWord(row, lang);
		}, 10);
	}
}