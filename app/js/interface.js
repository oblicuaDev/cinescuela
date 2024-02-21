var globalSavedFile = 0;
var total_files=0;

var Paliculas_activas = new Array();
var Paliculas_catalogo = new Array();
var Peliculas_sincronizadas = new Array();
var Peliculas_BtnSincronizar = new Array();
var url_video = new Array();
var Name_movies = new Array();
var ciclos = new Array();
var totalFilmAct = 0;

var cont_catalogo = 0;
var content = "";
var pintar = 0;
var contSession = 0;

var interval = 0;
var currentPage = 1;
var film_act = "";
var clickCatalogo = 0;

if(navigator.onLine){
    if(navigator.onLine){
        var OrekaObjectSb64 = new O("d1eb63ddc08ca2f41401b60bc6b7fc87*1.2");
        OrekaObjectSb64.getCollection(244,"created","downward",0,1,function(Url_movie){
            var ObjUrl = Url_movie.responseJSON;
            for(var i=0; i<ObjUrl.length; i++){
                Name_movies[ObjUrl[i]["rowID"]] = ObjUrl[i]["video_file"];
            }
            OrekaObjectSb64.destroy(function(result){
            });
        });
    }



    var OrekaObject = new O("d1eb63ddc08ca2f41401b60bc6b7fc87*1.2");
    var none = "";

    OrekaObject.getCollection(6,"created","downward",0,1,function(result_ciclos){
        var objCiclos = result_ciclos.responseJSON;
        for(var i=0; i<objCiclos.length; i++){
            ciclos.push(objCiclos[i]);
        }
    });
}


$(document).ready(function(){
	var vengen=$(document).height();
	var porcentaje=0.69;
	var pixelesven=0;
	var	porcentajepelis=0.71;
	var pixelpelis=0;

	pixelesven=vengen*porcentaje;
	$(document).height(pixelesven);

	pixelpelis=vengen*porcentajepelis;
	$(document).height(pixelpelis);


	$(window).resize(function(){
		vengen=$(document).height();
		pixelesven=vengen*porcentaje;
		pixelpelis=vengen*porcentajepelis;
		$("#info_movie").height(pixelesven);
		$(".scroll").height(pixelpelis);
	});
	
	
    if($(".scroll_element").length>0){
		$(".scroll_element").mCustomScrollbar({
            set_width:false, /*optional element width: boolean, pixels, percentage*/
            set_height:true, /*optional element height: boolean, pixels, percentage*/
            horizontalScroll:false, /*scroll horizontally: boolean*/
            scrollInertia:550, /*scrolling inertia: integer (milliseconds)*/
            scrollEasing:"easeOutCirc", /*scrolling easing: string*/
            mouseWheel:"auto", /*mousewheel support and velocity: boolean, "auto", integer*/
            autoDraggerLength:true, /*auto-adjust scrollbar dragger length: boolean*/
            scrollButtons:{ /*scroll buttons*/
                enable:true, /*scroll buttons support: boolean*/
                scrollType:"continuous", /*scroll buttons scrolling type: "continuous", "pixels"*/
                scrollSpeed:20, /*scroll buttons continuous scrolling speed: integer*/
                scrollAmount:40 /*scroll buttons pixels scroll amount: integer (pixels)*/
            },
            advanced:{
                updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
                updateOnContentResize:true, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
                autoExpandHorizontalScroll:false /*auto expand width for horizontal scrolling: boolean*/
            },
            callbacks:{
                onScroll:function(){}, /*user custom callback function on scroll event*/
                onTotalScroll:function(){}, /*user custom callback function on bottom reached event*/
                onTotalScrollOffset:0 /*bottom reached offset: integer (pixels)*/
            }
        });
	} 
    //Jquery UI Droplists
    if($(".custom_droplist").length>0){ $(".custom_droplist").selectmenu(); }
    
	
    
	//Validate form login
	$("#formLogin").validate({
        rules: {
            user: { required: true, minlength: 3},
            password: { required:true, minlength: 3}
        },
        messages: {
            user: "",
            password : ""
        }
    });
    
    
    
	//Cambio de interfaces
	//Se ocultan las interfaces
	$("#activas").hide();
	$("#catalogo").hide();
	$("#interna").hide();
	$("#intfooter").hide();
	$("header").hide();
	$(".feedback").hide();
    $(".pages").hide();
	$(".advert").hide();
    
    
    
	//Cambio de intefaces internas
	$(".btn").click(function(event){
		var element = $($(this).attr("href"));
		var active = $(this);
		$("#interna").fadeOut("fast");
		$(".btn").removeClass("active");
		active.addClass("active");
		$("video").remove();
        
		$(".currentTab").fadeOut("fast",function(){
			element.fadeIn("fast");
			$(".interfaz").removeClass("currentTab");
			element.addClass("currentTab");
			$(".advert").hide();
		});
		event.preventDefault();
	});
	
	
	
	if(navigator.onLine){
		$("#MCatalogo").show();
		none = "display:inline-block;";
	} else {
		$("#MCatalogo").hide();
		none = "display:none;";
//		none = "display:inline-block;";
        $("#preloader_cargar").fadeOut("fast");
	}
	
	
	
	//Login
	chrome.storage.sync.get('user', function(result_user){//Busca los usuarios guardados en el sistema	
		if(result_user.user){ //Valida si existe un usuario guardado para evitar el login
			$("#log").hide();
			$("header").fadeIn(1000);
			$(".intfooter").fadeIn(1000);
			$("#activas").fadeIn("fast");
			permissions_fileSystem();
		} else{//Sino hay usuarios guardados hace el proceso de login y al finalizar guarda el usuario
			login();
		}
	});
    
    
    
	$("#session").click(function(){
		EndSession();
	});
	
	
	$("#MCatalogo").click(function(){
        if(clickCatalogo==0){
			currentPage = 1;
            catalogo(1, 1);
        }
        clickCatalogo++;
	});
	
});//end document.ready


//	Pintando las catálogo de películas
function catalogo(page, where){
    $("#activas").hide();
	if(navigator.onLine){
		if(cont_catalogo==0){
			cont_catalogo=1;
			
			if(where!=0){
				$("#listmovies_catalogo").html("");
			}
			
			$("#preloader_cargar").fadeIn("fast");
			OrekaObject.getCollection(8,"created","downward",8,page,function(result_film_catalogo){//Trae todas las películas del catálogo
				var film_content_cat = result_film_catalogo.responseJSON;
				var film_cat_list = $("#listmovies_catalogo");
				var iAux2=0;
                var totalFilmCat = film_content_cat.length;
				
				var pageAct = 0;
				var pageFinal = (page-1)*8+8;
                
                if(totalFilmCat<pageFinal){
                    pageFinal = totalFilmCat;
                }
                
				if(page>1){
					pageAct = (page-1)*8;
				}
				
				for(var i=0; i<film_content_cat.length; i++){//Recorre el arreglo con los objetos de cada película
					var posicion = -1;
					for(var k=0; k<film_act.length; k++){
						if(film_act[k]==film_content_cat[i]['rowID']){
							posicion = k;
						}
					}
					Paliculas_catalogo.push(film_content_cat[i]);

					var description_film_cat = film_content_cat[i]['desc_film'];
					description_film_cat = description_film_cat.split(" ");
					var description_film_final_cat = "";
                    
                    console.log(description_film_cat);
                    
					if(description_film_cat.length>20){
						for(var j=0; j<20; j++){
							if(description_film_cat[19]=="." || description_film_cat[19]=="," || description_film_cat[19]==";"){
								description_film_cat[19]="...";
							}else{
								description_film_cat[19]="...";
							}
                            if(j==18){
                                description_film_final_cat+= description_film_cat[j];
                            } else{
                                description_film_final_cat+= description_film_cat[j]+" ";
                            }
						}
					}else{
						for(var j=0; j<description_film_cat.length; j++){
							description_film_final_cat+= description_film_cat[j];
						}
					}
                    
                    //Html con la información de la película
                    if($("#filmC_"+film_content_cat[i]['rowID']).length<1){
                        var film_html_cat = "<article id='filmC_"+film_content_cat[i]['rowID']+"' class='articleMovie'><span class='overlayActive' style='display:none;' id='overlayActive_"+film_content_cat[i]['rowID']+"'>Para ver este contenido. Accede a la sección películas activas</span><figure class='basic_background' style='background-image:url(../images/defaultImage.jpg)'><a href='#' class='ageneral btn_more' data-int='c_"+film_content_cat[i]['rowID']+"'></a></figure><div><div class='info'><p>"+film_content_cat[i]['year-film']+"</p><!--<p class='ciclo'>Ciclo</p>--><h3><a href='#' class='btn_more' data-int='c_"+film_content_cat[i]['rowID']+"'>"+film_content_cat[i]['tit_film']+"</a></h3><p class='font3 text'>"+description_film_final_cat+"</p></div><a href='#' class='font3 button2 btn_more' data-int='c_"+film_content_cat[i]['rowID']+"'>Ver más</a></div></article>";
                    }
                    
                    film_cat_list.prepend(film_html_cat);//Imprime el html de la película
                    
					if(posicion!=-1){
//						film_cat_list.prepend(film_html_cat);
                        $("#overlayActive_"+film_content_cat[i]['rowID']).fadeIn("fast");
					}

					if(iAux2==pageFinal-1){
						$("#preloader_cargar").fadeOut("fast");
                        Paginated(0);
					}


					$("#filmC_"+film_content_cat[i]['rowID']+" .btn_more").click(function(){//Trae el id de la película enviado desde el href del a del botón ver más
						var element_more_btn2 = $(this).data('int');
						Painting_intMovie(element_more_btn2, Paliculas_catalogo, 0);//Envía el id de la película a la función Painting_intMovie
					});
					iAux2++;
				}
			});
		}
	}
}



function login(){
	var user = $("#user");
	var password = $("#password");
	var login = $("#entrar");
	
	login.click(function(){
		var element2 = $($(this).attr("href"));
		$(".feedback").fadeOut("fast");
		
		if(navigator.onLine){
			if(user.val()!="" && password.val()!=""){ //Validación de campos vacios para feedback
				$("#preloader_cargar").fadeIn("fast");
				OrekaObject.fieldSearch(user.val(),"name_user",1,0,1,"created","downward",function(result_user){
					if(result_user.responseJSON!=""){
						if(user.val()==result_user.responseJSON[0]["name_user"] && md5(password.val())==result_user.responseJSON[0]["pass_user"]){ //Cambio de la interfaz de login a películas activas
							$("#log").fadeOut(1000,function(){
								$("header").fadeIn(1000);
								$(".intfooter").fadeIn(1000);
								element2.fadeIn(1000);
								$(".interfaz").removeClass("currentTap");
								element2.addClass("currentTap");
							});
							saved_user(result_user);
						} else{ //Error de login
							$("#feedback").fadeIn();
							$("#preloader_cargar").fadeOut("fast");
						}
					}else{
						$("#feedback").fadeIn();
						$("#preloader_cargar").fadeOut("fast");
					}
				});
			} else if(user.val()==""){
				$("#feedback1").fadeIn();
			} else if(password.val()==""){
				$("#feedback2").fadeIn();
			}
		}else{
			$("#preloader_sinConexion").fadeIn("fast");
		}
	});
}



//Guarda los datos del usuario en storage api
function saved_user(result_user){
	chrome.storage.sync.set({'id': result_user.responseJSON[0]["rowID"], 'user': result_user.responseJSON[0]["name_user"], 'pass': result_user.responseJSON[0]["pass_user"]});
	permissions_fileSystem();
};



function EndSession(){
    $(".menu li a").removeClass("active");
    $("#MAtivas").addClass("active");
	chrome.storage.sync.clear();
	$("header").fadeOut("fast");
	$(".intfooter").fadeOut("fast");
	$("#activas").fadeOut("fast");
	$("#log").fadeIn("fast");
	$("#listmovies_acti").html("");
//	$("#listmovies_catalogo").html("");
    clickCatalogo = 0;
    currentPage = 1;
	login();

	$("#user").val("");
	$("#password").val("");
}



function verify_user(page, where2){
    $("#catalogo").hide();
	//Pintando las películas activas
	chrome.storage.sync.get('user', function(result_user){//Busca los usuarios guardados en el sistema
		if(result_user.user){
			$("#preloader_cargar").fadeIn("fast");
			var film_act_list = $("#listmovies_acti");
			
			if(where2!=1){
				film_act_list.html("");
			}
			
			chrome.storage.sync.get(function(result_user){//Busca los usuarios guardados en el equipo
				OrekaObject.fieldSearch(result_user.user,"name_user",1,0,1,"created","downward",function(result_film_act){//Busca las películas del usuario encontrado
					film_act = result_film_act.responseJSON[0]["films_user"];
					if(film_act!=""){
						film_act = film_act.split(",");//Separa el string con los ids de las películas activas para el usuario
						auxfilm_act = new Array();
						console.log(film_act);
						for(kk=0;kk<film_act.length;kk++)
						{
							if(film_act[kk]!="")
							{
								auxfilm_act.push(film_act[kk]);
							}
						}
						film_act = new Array();
						film_act = auxfilm_act;
						console.log(film_act);
						totalFilmAct = film_act.length;
						
						var PageIni = 0;
						var PageFin = (page-1)*8+8;
						var PagePainting = (page-1)*8+8;
                        var TotalFilmPage = (page-1)*8+8;
                        
						if(totalFilmAct<PageFin){
							PageFin = totalFilmAct;
						}
						if(page>1){
							PageIni = (page-1)*8;
						}
						var iAux=PageIni;
                        
//                        if(Paliculas_activas.length >= TotalFilmPage){
//                            var objArray = Paliculas_activas;
//                        }
                        
						for(var i=PageIni; i<PageFin; i++){//Recorre el arreglo con los ids de las películas traidas
					
							OrekaObject.getContent(film_act[i], function(result_film_act_content){//Busca la información de las películas activas
								film_content = result_film_act_content.responseJSON;
								
								if(Paliculas_activas.length<film_act.length){
									Paliculas_activas.push(film_content);
								}
                                
//                                if(Paliculas_activas.length < PageFin){
                                    var objArray = film_content;
//                                }
                                
								var film_html = pintar_item(objArray);
								film_act_list.prepend(film_html);//Imprime el html de la película
								
								verify_file(film_content['rowID'],0);
                                
								$("#move_"+film_content['rowID']).click(function(){
									var id_movie = $(this).data('idm');
                                    $("#toll_"+id_movie).fadeOut("fast");
                                    $(this).addClass("btn_sincronizar");
                                    $("#advert_"+id_movie).fadeIn("fast");
									
									
									url_video[id_movie]="download/"+id_movie+".txt";
									
									var click_id = $(this).data('message');
									
										if(url_video[film_content['rowID']]){
											$("#play").fadeIn("fast");
										}
                                    create_file(id_movie);
									interval = setInterval(function(){ verify_file(click_id, 1) }, 120000);
								});

								if(iAux==PageFin-1){
									$("#preloader_cargar").fadeOut("fast");
									
									Paginated(1);
								}
                                
								$("#filmA_"+film_content['rowID']+" .btn_more").click(function(){//Trae el id de la película enviado desde el href del a del botón ver más
									var element_more_btn1 = $(this).data('inter');
									
									Painting_intMovie(element_more_btn1, Paliculas_activas, 1);//Envía el id de la película a la función
								});
								iAux++;
                                
                                for(var i=0; i<Peliculas_BtnSincronizar.length; i++){
                                    var idMovie_sicronizadas = Peliculas_BtnSincronizar[i].split(".");
                                    $("#move_"+idMovie_sicronizadas[0]).hide();
									$("#advert_"+idMovie_sicronizadas[0]).hide();
                                }
							});
						}
                        OrekaObject.count_re(8,function(result){
                            if(film_act.length==parseInt(result.responseJSON)){
                                $("#MCatalogo").fadeOut();
                            }
                        });
					} else{
						$("#preloader_cargar").fadeOut("fast");
						var user_string = result_user.user;
						user_string = user_string.split("");
						film_act_list.append("<p class='font3 response'><span>"+result_user.user+"</span>, bienvenido a Cinescuela.</p><p class='font3'>En este momento no tienes películas activas</p>");
					}
				});
			});
		}
	});
}



function verify_file(click_id, num){
    $.ajax({
		url:'../download/'+click_id+'.txt',
		type:'HEAD',
		error: function(){
            $("#move_"+click_id).fadeIn("fast");
		},
		success: function(){
            $("#advert_"+click_id).fadeOut("fast");
            $("#Noadvert_"+click_id).fadeIn("fast");
            $("#move_"+click_id).fadeOut("fast");
            $("#a_"+click_id).fadeIn("fast");
			clearInterval(interval);
		}
	});
}


function Painting_intMovie(content_element, obj, interface){
    var painting_title = $("#interna");
	content_element = content_element.split("_");
	
	var content_painting = obj;
	var none = "";
    
    var none2 = "";
    if(content_element[0]=="c"){
        none2 = "display:none;";
    } else{
        none2 = "";
    }
    
	var id_film_more = content_element[1];
	$("#activas").fadeOut("fast");
	$("#catalogo").fadeOut("fast");
	$("#interna").fadeIn("fast");
    
	var aux = 0;
	for(var i=0; i<content_painting.length; i++){
		if(id_film_more == content_painting[i]["rowID"]){
			aux = i;
		}
	}
	
    if(painting_title.html()!=""){
		painting_title.html("");
	}
	
	var url_video = "";
	if(Name_movies[content_painting[aux]["file_movie"]]){
		var NameMovie = Name_movies[content_painting[aux]["file_movie"]];
		NameMovie = NameMovie.split("/");
		var nameM = NameMovie[NameMovie.length-1];
        if(interface==1){
            url_video = "http://190.84.244.77/projects/cinescuela_app/files/641.php?name="+content_painting[aux]['rowID']+"&url="+nameM+"&type=video&action=download";
        } else{
            url_video = "";
        }
		
	}
	if(url_video=="undefined"){
		url_video = "";
	}
    
    
    var title_html = "<a href='#' class='back' id='back'></a><h3 class='font2 title' id='title_intMovie'>"+content_painting[aux]["tit_film"]+"</h3><div class='scroll scroll_element' id='info_movie'></div>";
    
    painting_title.append(title_html);
    
    if(interface==1){
        $("#back").click(function(){
            $("#interna").fadeOut("fast");
            $("video").remove();
            $("#activas").fadeIn("fast");
			$(".advert").hide();
        });
    } else if(interface==0){
        $("#back").click(function(){
            $("#interna").fadeOut("fast");
            $("video").remove();
            $("#catalogo").fadeIn("fast");
			$(".advert").hide();
        });
    }
    
    
    var cicloMovie = "";
    var none3 = "display: none;";
	for(var j=0; j<ciclos.length; j++){
		if(ciclos[j]['films_cycle']!=""){
			var filmCiclos = ciclos[j]['films_cycle'].split(",");
			for(var g=0; g<filmCiclos.length; g++){
                if(filmCiclos[g] == content_painting[aux]["rowID"]){
                    if(ciclos[j]['tit_cycle']!=""){
                        cicloMovie = ciclos[j]['tit_cycle'];
                        none3 = "";
                    }
                }
            }
		}
	}

    var none4 = "";
    if(content_painting[aux]["sinop_film"]==""){
        none4 = "display: none;";
    }
    
    var Container_info_intMovie = $("#info_movie");
    var IntMovie_html = "";
    if(interface==0){
       IntMovie_html = "<div class='infomovie'><div class='container info'><p><strong>Año:</strong>"+content_painting[aux]["year_film"]+"</p><p><strong>Director:</strong>"+content_painting[aux]["direct_film"]+"</p><p style='"+none3+"'><strong>Ciclo:</strong>"+cicloMovie+"</p><p><strong>País:</strong>"+content_painting[aux]["country_film"]+"</p><p><strong>Duración:</strong>"+content_painting[aux]["duration_film"]+" min</p><p class='text'><strong>Descripción: </strong>"+content_painting[aux]["desc_film"]+"</p><p style='"+none4+"'><strong>Sinopsis: </strong>"+content_painting[aux]["sinop_film"]+"</p><ul class='contPedag'><!--<li class='font2 button'><a href='#'>Descargar contenido pedagógico</a></li>--><li class='font2 button'><a href='"+content_painting[aux]["pedago_film"]+"' target='_blank'>Ver contenido pedagógico</a></li></ul></div><div class='container sincrobar sincrobar_int' "+none2+"><p class='advert' style='display:none;'>La película aun no está sincronzada...</p><a href='"+url_video+"' class='basic_background sincro' style='background-image:url(images/asset.png); display:none;' id='moveInt' target='_blank'><span class='font3 showHover'>Sincronizar</span></a></div></div>";
    } else if(interface==1){
        IntMovie_html = "<div class='infomovie'><div class='container info'><p><strong>Año:</strong>"+content_painting[aux]["year_film"]+"</p><p><strong>Director:</strong>"+content_painting[aux]["direct_film"]+"</p><p style='"+none3+"'><strong>Ciclo:</strong>"+cicloMovie+"</p><p><strong>País:</strong>"+content_painting[aux]["country_film"]+"</p><p><strong>Duración:</strong>"+content_painting[aux]["duration_film"]+" min</p><p class='text'><strong>Descripción: </strong>"+content_painting[aux]["desc_film"]+"</p><p style='"+none4+"'><strong>Sinopsis: </strong>"+content_painting[aux]["sinop_film"]+"</p><ul class='contPedag'><!--<li class='font2 button'><a href='#'>Descargar contenido pedagógico</a></li>--><li class='font2 button'><a href='"+content_painting[aux]["pedago_film"]+"' target='_blank'>Ver contenido pedagógico</a></li></ul></div><div class='container sincrobar sincrobar_int' "+none2+"><p class='advert' style='display:none;'>La película aun no está sincronzada...</p><a href='"+url_video+"' class='basic_background sincro' style='background-image:url(images/asset.png); display:none;' id='moveInt' target='_blank'><span class='font3 showHover'>Sincronizar</span></a></div><figure class=' container basic_background generalimg' id='figure' style='background-image:url(../images/default2.jpg)'><a href='#' class='basic_background play' id='play' style='background-image:url(images/play.png);"+none2+"'></a><div id='preloader_play'><img src='images/Play_prelouder.gif' alt=''></div></figure></div>";
    }
	
    
    
	Container_info_intMovie.append(IntMovie_html);
	Container_info_intMovie.mCustomScrollbar({
		set_width:false, /*optional element width: boolean, pixels, percentage*/
		set_height:true, /*optional element height: boolean, pixels, percentage*/
		horizontalScroll:false, /*scroll horizontally: boolean*/
		scrollInertia:550, /*scrolling inertia: integer (milliseconds)*/
		scrollEasing:"easeOutCirc", /*scrolling easing: string*/
		mouseWheel:"auto", /*mousewheel support and velocity: boolean, "auto", integer*/
		autoDraggerLength:true, /*auto-adjust scrollbar dragger length: boolean*/
		scrollButtons:{ /*scroll buttons*/
			enable:true, /*scroll buttons support: boolean*/
			scrollType:"continuous", /*scroll buttons scrolling type: "continuous", "pixels"*/
			scrollSpeed:20, /*scroll buttons continuous scrolling speed: integer*/
			scrollAmount:40 /*scroll buttons pixels scroll amount: integer (pixels)*/
		},
		advanced:{
			updateOnBrowserResize:true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
			updateOnContentResize:true, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
			autoExpandHorizontalScroll:false /*auto expand width for horizontal scrolling: boolean*/
		},
		callbacks:{
			onScroll:function(){}, /*user custom callback function on scroll event*/
			onTotalScroll:function(){}, /*user custom callback function on bottom reached event*/
			onTotalScrollOffset:0 /*bottom reached offset: integer (pixels)*/
		}
	});
	
	
	$("#play").hide();
	$.ajax({
		url:'../download/'+content_painting[aux]["rowID"]+'.txt',
		type:'HEAD',
		error: function(){
			var video = url_video[content_painting[aux]["rowID"]];
			if($("#intVideo_"+content_painting[aux]["rowID"]).length<1){
				$(".infomovie").append("<video controls autoplay id='intVideo_"+content_painting[aux]["rowID"]+"' style='display:none;'><source src='"+video+"' type='video/mp4'></source></video>");
			}
            $("#play").hide();
			$("#moveInt").fadeIn("fast");
			$(".advert").fadeIn("fast");
            $("#preloader_play").fadeOut("fast");
		},
		success: function(){
            $("#play").fadeIn();
			var video = "../download/"+content_painting[aux]["rowID"]+".txt";
            $("#play").click(function(){
				if($("#intVideo_"+content_painting[aux]["rowID"]).length<1){
					$(".infomovie").append("<video controls autoplay id='intVideo_"+content_painting[aux]["rowID"]+"'><source src='"+video+"' type='video/mp4'></source></video>");
				}
            });
			$("#moveInt").fadeOut("fast");
			$(".advert").fadeOut("fast");
            $("#preloader_play").fadeOut("fast");
		}
	});
	
	
	$("#play").click(function(){
		$("#figure").fadeOut("fast");
		$("#intVideo_"+content_painting[aux]["rowID"]).fadeIn("fast");
	});
	
	$("#moveInt").click(function(){
		create_file(content_painting[aux]["rowID"]);
	});
    
    if(content_element[0]=="c"){
        $(".sincrobar_int").hide();
        $("#preloader_play").hide();
    } else{
        $("#preloader_play").fadeIn("fast");
    }
}


function pintar_item(film_content){
    film_html="";
    if(film_content['tit_film']){
        //Toma la descripción de la películas para imprimir un maximo de 160 caracteres
        var description_film = film_content['desc_film'];
        if(description_film!=""){
           description_film = description_film.split(" ");
        }else{ description_film=""; }
        var description_film_final = "";

        if(description_film.length>20){
            for(var j=0; j<20; j++){
                if(description_film[19]=="." || description_film[19]=="," || description_film[19]==";"){
                    description_film[19]="...";
                }else{
                    description_film[19]="...";
                }
                
                if(j==18){
                    description_film_final+= description_film[j];
                } else{
                    description_film_final+= description_film[j]+" ";
                }
            }
            }else{
                for(var j=0; j<description_film.length; j++){
                    description_film_final+= description_film[j];
                }
            }
        
        var url_video = "";
        if(Name_movies[film_content["file_movie"]]){
            var NameMovie = Name_movies[film_content["file_movie"]];
            NameMovie = NameMovie.split("/");
            var nameM = NameMovie[NameMovie.length-1];
            url_video = "http://190.84.244.77/projects/cinescuela_app/files/641.php?name="+film_content['rowID']+"&url="+nameM+"&type=video&action=download";
        }
        if(url_video=="undefined"){
            url_video = "#";
        }
        //Html con la información de la película
        if($("#filmA_"+film_content['rowID']).length<1){
            var film_html = "<article id='filmA_"+film_content['rowID']+"'><figure class='basic_background' style='background-image:url(../images/defaultImage.jpg)'><a href='#' class='ageneral btn_more' data-inter='a_"+film_content['rowID']+"' id='a_"+film_content['rowID']+"' style='display: none;'></a></figure><div><div class='sincrobar'><!--<a href='' class='basic_background ex' id='cancel' style='background-image:url(images/asset.png);'><span class='font3 showHover'>Cancelar sincronización</span></a><div class='bar'><span style='width: 25%'></span></div><p>20%</p>--><p class='advert' id='advert_"+film_content['rowID']+"' style='display: none;'>Sincronizando la película...</p><p class='advert' id='Noadvert_"+film_content['rowID']+"' style='display: none;'>Película sincronizada...</p><a href='"+url_video+"' class='basic_background  sincro' style='background-image:url(images/asset.png);"+none+"' id='move_"+film_content['rowID']+"' data-idm='"+film_content['rowID']+"' data-message='"+film_content['rowID']+"' target='_blank' download><span class='font3 showHover'  id='toll_"+film_content['rowID']+"'>Sincronizar</span></a></div><div class='info'><p class='anio'>"+film_content['year_film']+"</p><h3><a href='#' class='btn_more' data-inter='a_"+film_content['rowID']+"'>"+film_content['tit_film']+"</a></h3><p class='font3 text'>"+description_film_final+"</p></div><a href='#' class='font3 button2 btn_more' data-inter='a_"+film_content['rowID']+"'>Ver más</a></div></article>";
        } else{
            var film_html="";
        }
	}
	return film_html;
}



function Paginated(int){
	var numPage = 1;
	var cant_pages = 0;
	var containerFilms = "";
    
	OrekaObject.count_re(8, function(result){
		var resultCount = 0;
		var elementPaint = "";
		var elementContent = "";
		if(int==0){
			elementContent = $("#listmovies_catalogo");
			elementContent.append("<ul class='pages font2' id='Cpaginated'>");
			elementPaint = $("#Cpaginated");
			resultCount = parseInt(result.responseJSON);
			containerFilms = "p";
		} else{
			elementContent = $("#listmovies_acti");
			elementContent.append("<ul class='pages font2' id='Apaginated'>");
			elementPaint = $("#Apaginated");
			resultCount = totalFilmAct;
			containerFilms = "a";
		}
		
		if(resultCount>8){
			var none4 = "";
			var none5 = "";
			elementPaint.show();
			
			if(numPage>1){
				none4 = "";
			} else{
				none4 = "display: none;";
			}
			
			elementPaint.append("<li class='back2' style='"+none4+"'><a href='#' class='basic_background' style='background-image:url(images/asset.png)' id='back2'></a></li>");
			cant_pages = Math.ceil(resultCount/8);
	        
			for(var i=1; i<=cant_pages; i++){
				if($("#"+containerFilms+"_"+i).length<1){
					elementPaint.append("<li><a href='#' class='PagesNum pageC pageStyle' id='"+containerFilms+"_"+i+"' data-page='"+i+"'>"+i+"</a></li>");
				}
				
				$("#"+containerFilms+"_"+i).click(function(){
					var page_paint = $(this).data('page');
                    currentPage = page_paint;
					cont_catalogo  = 0;

					if(int==0){
						catalogo(page_paint, 1);
					} else{
						verify_user(page_paint, 2);
					}
					numPage++;
				});
			}
			$("#"+containerFilms+"_"+currentPage).addClass("active3");
			if(numPage!=cant_pages){
				none5 = "";
			} else{
				none5 = "display: none;";
			}
			
			elementPaint.append("<li class='next' style='"+none5+"'><a href='#' class='basic_background' style='background-image:url(images/asset.png)' id='next2'></a></li>");
			
			elementContent.append("</ul>");
    	}
	});
}






//Empieza la creación y guardado de los archivos con el contenido de las películas
function permissions_fileSystem(){ //Crea el espacio en el disco para guardar los archivos en el sistema
	btn_cancel = $("#cancel");
	Message = $(".advert");
	
	navigator.webkitPersistentStorage.requestQuota(50*1024*1024*1024, function(){//Pide permisos al sistema para crear el espacio en disco
		window.webkitRequestFileSystem(window.TEMPORARY, 50*1024*1024*1024, create_system, function(e_createSystem){//Crea el espacio en disco para guardar los archivos
			console.log("Error: ("+e_createSystem.code+") Creando el espacio en disco");
		});
	});
}



function create_system(system){ //Obtiene la ruta de la carpeta raiz
    space = system.root; //Carpeta raiz
	chrome.storage.sync.get('id', function(result_user){
		route = result_user.id;
	
		space.getDirectory(route, {create: true}, function(dirEntry){
            painting_files();
            verify_user(1, 1);
		}, function(e_createDirectory){ //Crea el directorio con el nombre especificado en la variable ruta
			console.innerHTML = "Error: ("+e_createDirectory.code+") Creando el sistema y directorio de archivos";
		});
	});
}



function create_file(id_movie){// Crea el archivo y le asigna un nombre
	var btn_sincronizar = $("#move_"+id_movie);
    var name_file = id_movie+".json";
	var content = update_contentJson(id_movie);
	
	chrome.storage.sync.get('id', function(result_user){
		route = result_user.id;
		space.getFile(route+'/'+name_file, {create: false}, function(fileEntry) {
			fileEntry.remove(function() {
				newfile(route,name_file);
			}, function(){
			});
		}, function(){
			newfile(route,name_file);
		});
	});
}



function newfile(route,name_file){ //New file
	space.getFile(route+'/'+name_file, {create:true, exclusive: false}, function(e_createFile){					 
		//Crea el archivo con el nombre especificado y lo guarda en la ruta que se creò anteriormente
		e_createFile.createWriter(function(fileWriter){//Escribe el contenido del archivo cargado en el archivo creado
			fileWriter.onwriteend = Open_file(name_file);
            
			var fileTypee = 'text/json';
			var blob = new Blob([content], {type: fileTypee});//Convierte el contenido del archivo en blob
			fileWriter.write(blob);
		}, function(e){
			console.log("Error: "+e.code+" en la sincronización");
		});
	}, function(e){
		console.log("Error: "+e.code+" creando el archivo");
	});
}



function update_contentJson(id_movie){
	var respuesta = 0;
	var Video_content = "";
			
	for(var i=0; i<Paliculas_activas.length; i++){
		if(id_movie==parseInt(Paliculas_activas[i]["rowID"])){

			content = '{"rowID":"'+Paliculas_activas[i]["rowID"]+'","tit_film":"'+Paliculas_activas[i]["tit_film"]+'","year_film":"'+Paliculas_activas[i]["year_film"]+'","direct_film":"'+Paliculas_activas[i]["direct_film"]+'","ciclo":"ciclo","country_film":"'+Paliculas_activas[i]["country_film"]+'","duration_film":"'+Paliculas_activas[i]["duration_film"]+'","desc_film": "'+Paliculas_activas[i]["desc_film"]+'","sinop_film":"'+Paliculas_activas[i]["sinop_film"]+'"}';
			respuesta = content;
		}
	}
	return respuesta;
}



function Open_file(name_file){//Abre el archivo creado
	chrome.storage.sync.get('id', function(result_user){
		route = result_user.id;
		var name_file_open = "/"+route+"/"+name_file;
        
        var id_fileSave = name_file.split(".");

		space.getFile(name_file_open, {create:true, exclusive: false}, function(e_openFile){//llama al archivo indicado con el nombre
			globalSavedFile = e_openFile;
			e_openFile.file(function(e_fileOpening){//Lee el contenido del archivo creado y que abrió la función anterior
				var Reading = new FileReader();
				Reading.onload = exito;
				Reading.readAsText(e_fileOpening);
			}, function(e_loadinFile){
				console.log = "Error: "+e_loadinFile.code+" Abriendo el archivo";
			});
		}, function(e){
			console.log = "Error: "+e.code+" Leyendo el archivo";
		});
	});
}



function exito(e_exito){ //Si la lectura del archivo se da con exto, esta función escribe su contenido
	content_fileOpen = e_exito.target.result;
	content_fileOpen = JSON.parse(content_fileOpen);
	Peliculas_sincronizadas.push(content_fileOpen);
	
	if(pintar==1){
		var item = pintar_item(content_fileOpen);
		$("#listmovies_acti").append(item);
		
		$("#filmA_"+content_fileOpen['rowID']+" .btn_more").click(function(){//Trae el id de la película enviado desde el href del a del botón ver más
			var element_more_btn1 = $(this).data('inter');
			Painting_intMovie(element_more_btn1,Peliculas_sincronizadas, 1);//Envía el id de la película a la función Painting_intMovie
		});
	}
}



function painting_files(){// Pinta la información del archivo
	chrome.storage.sync.get('id', function(result_user){
		route = result_user.id;
		space.getDirectory(route, null, function(e_directory){//Crea el lector de los directorios
			reader = e_directory.createReader();
			load(reader);
			if(!navigator.onLine){
				$("#preloader_cargar").fadeOut("fast");
			}	
		}, function(e_reader){
			console.log = "Error: "+e_reader.code+" Creando el lector de directorios";
		});
	});
}



function load(reader){// Lee los archivos que se crearon en los directorios
	reader.readEntries(function(e_files){
		if(e_files.length){
			list(e_files);
		}
	}, function(e){
		console.log = "Error: "+e.code+" Leyendo los archivos";
	});
}



function list(files_list){ //Imprime el nombre de los archivos creados
	total_files = files_list.length;
	pintar=1;
    
	for(var i=0; i<files_list.length; i++){
        if(navigator.onLine){
            if(files_list[i].isFile){
                fileSincronizado = files_list[i].name;
                Peliculas_BtnSincronizar.push(fileSincronizado);
            }
        } else{
            Open_file(files_list[i].name);
//            var nameID = files_list[i].name;
//            nameID = nameID.split(".");
//            console.log(parseInt(nameID[0]));
//            $("#Noadvert_"+nameID[0]).show();
//            $("#a_"+nameID[0]).show();
        }
	}
}