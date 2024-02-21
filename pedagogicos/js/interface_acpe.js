/*Javascript interfaz grafica Cinescuela fase II
* Copyright(c) 2015, All rights reserved.
*/

$(document).ready(function(){
	//height_container();

	//imagen principal (fondo fijo)
	back_img();

	//perfect scrollbar
	$('.general-scroll').perfectScrollbar({
		wheelPropagation:true,
		wheelSpeed:0.5
		//suppressScrollX:true
	});
	$('#lista_ruta').perfectScrollbar({
		wheelPropagation:true,
		wheelSpeed:0.25
		//suppressScrollX:true
	});
	$('#post_list').perfectScrollbar({
		wheelPropagation:true,
		wheelSpeed:0.5
		//suppressScrollX:true
	});

	//Accordion presentacion
	$(function() {
		$( "#accordion" ).accordion({
			heightStyle: "fill",
			activate:function(event, ui){$('.general-scroll').perfectScrollbar('update')},
			create:function(event, ui){$('.general-scroll').perfectScrollbar('update')}
		});
	});

	//listado cultura y sociedad
	var $container = $('#list_container');
	// iniciar listado despues de cargar imagenes
	$container.imagesLoaded( function() {
		$container.masonry({
			columnWidth:'.item',
			itemSelector:'.item',
			"gutter": 10
		});
	});

	//fancy video
	$('.open_video').colorbox({
		iframe:true,
		innerWidth:'90%',
		maxWidth:'700px',
		innerHeight:'90%',
		maxHeight:'500px'
	});

	//carrusel pelicula
	var slider = $('.carrousel').bxSlider({
		controls:false,
		infiniteLoop:false,
		speed:1000
	});

	//tabs pelicula
    
    if($("#tabs").length){
	
		$( "#tabs" ).tabs({
			activate:function(event, ui){				
				if($('.carrousel').length){
					slider.reloadSlider();
				}
			}
		});
	
        }
	//fancy galeria peliculas
	$('.open_gallery').colorbox({
		maxWidth: '90%',
		maxHeight: '90%',
		rel:'galery_movie',
		onClosed:function(){
			if($('.carrousel').length){
				slider.reloadSlider();
			}
		}
	});

	//abrir listado de ruta pedagogica
	$('#ruta_pedagogica').on('click',function(e){
		open_menu(e,$(this),$('#lista_ruta'));
	});

	//abrir listado cultura y sociedad
	$('#o_post_list').on('click',function(e){
		open_menu(e,$(this),$('#post_list'));
	});

	/*abrir menu princial (responsive)*/
	$('#btn_menu_top').on('click',function(e){
		open_main_menu(e,$(this),$('#main_menu ul'));
	});
	$('#btn_menu').on('click',function(e){
		open_main_menu(e,$(this),$('#bottom_menu > div > ul'));
	});

	//abrir tooltip
	$('.tooltip .ico').on('click',function(e){
		open_tooltip(e,$(this));
	});
	//cerrar todos los tooltips
	$('.img_info').on('click',function(){
		$('.tooltip .msn').css('display','none');
		$('.tooltip .ico').removeClass('active');
	});

});
$(window).load(function(){
	detectarCarga("loading_page");
	//imagen principal (fondo fijo)
	back_img();
});
$(window).resize(function(){
	//imagen principal (fondo fijo)
	back_img();
});

//Funcion tamaño contenedor general
function height_container(){
	if($('#main_container').length && $(window).width()>800){
		var h_header = $('#page_header').outerHeight(true);
		//var h_footer = $('#page_footer').outerHeight(true);
		var h_wrapper = $('#main_wrapper').height();
		var result = h_wrapper-h_header/*-h_footer*/;
		$('#main_container').css('height',result+'px');
	}
}

/*loading page*/
function detectarCarga(id_loading){
	var element= document.getElementById(id_loading);
	if(element!=null){fade(element)}
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

/*funcion para abrir menus*/
function open_menu(e,obj_click,obj_open){
	e.preventDefault();
	obj_click.toggleClass('active');
	obj_open.slideToggle('slow',function(){$(this).perfectScrollbar('update')});
}

//funcion abrir menus principales
function open_main_menu(e,obj_btn,obj_menu){
	e.preventDefault();
		obj_menu.toggleClass('menu_active');
		obj_btn.toggleClass('menu_active');
}

//funcion imagen fija fondo
function back_img(){
	var element = document.getElementById('main_image');
	var ratio = element.width / element.height;
	if((window.innerWidth / window.innerHeight) < ratio){
		element.style.width = 'auto';
		element.style.height = '100%';
		if (element.width > window.innerWidth){
			var ajuste = (window.innerWidth - element.width)/2;
			element.style.left = ajuste+'px';
		}
	}
	else{
		element.style.width = '100%';
		element.style.height = 'auto';
		element.style.left = '0';
	}
}

/*Funcion abrir tooltips infografia*/
function open_tooltip(e,obj_click){
	e.preventDefault();
	obj_click.toggleClass('active');
	var parent = obj_click.parent(),msn = parent.children('.msn'),px = msn.data('position-x'),py = msn.data('position-y');

	//posiciones
	if(px=='left' && py=='top'){
		msn.css({'right':'150%','top':'0px'}).children('.tri').addClass('left-top');
	}
	else if(px=='left' && py=='bottom'){
		msn.css({'right':'150%','bottom':'0px'}).children('.tri').addClass('left-bottom');
	}
	else if(px=='left' && py=='center'){
		var t = -(msn.innerHeight()/2);
		msn.css({'right':'150%','top':'50%','margin-top':t+'px'}).children('.tri').addClass('left-center');
	}
	else if(px=='right' && py=='top'){
		msn.css({'left':'150%','top':'0px'}).children('.tri').addClass('right-top');
	}
	else if(px=='right' && py=='bottom'){
		msn.css({'left':'150%','bottom':'0px'}).children('.tri').addClass('right-bottom');
	}
	else if(px=='right' && py=='center'){
		var t = -(msn.innerHeight()/2);
		msn.css({'left':'150%','top':'50%','margin-top':t+'px'}).children('.tri').addClass('right-center');
	}
	else if(px=='center' && py=='top'){
		var l = -(msn.innerWidth() / 2);
		msn.css({'left':'50%','margin-left':l+'px','bottom':'150%'}).children('.tri').addClass('center-top');
	}
	else if(px=='center' && py=='bottom'){
		var l = -(msn.innerWidth() / 2);
		msn.css({'left':'50%','margin-left':l+'px','top':'150%'}).children('.tri').addClass('center-bottom');
	}
	else{
		var t = -(msn.innerHeight()/2);
		var l = -(msn.innerWidth() / 2);
		msn.css({'left':'50%','margin-left':l+'px','top':'50%','margin-top':t+'px'}).children('.tri').addClass('center-center');
	}
	msn.toggle();
}