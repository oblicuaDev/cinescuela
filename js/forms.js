$(document).ready(function () {
	validateFormLogin();
	if (typeof openColorboxSession == "function") {
		openColorboxSession();
	}
});
/* CONTACT FORM*/
var app = angular.module('app',[]);
app.controller('Contacto',['$scope',function($scope){
	var vm = this;
	$scope.submitFun = function($event) {
	scope.submitted = true;
		if (!$scope.myForm.$valid) 
		{
			console.log('todo bn');
			$event.preventDefault();
		}
	}
	$scope.Save = function(){
		/*Anotación falta agregar estilos al feedback y cambiar lo siguiente a variables, para dejar mejor el codigo*/
		OrekaCloud.postRow('9',1,"64,65,66,67,54","char_val,char_val,char_val,char_val,char_val",[vm.nombre,vm.email,vm.asunto,vm.mensaje,vm.nombre],function(data){
			var tmpUser={}; 
			var tmpAdmin={}; 
			OrekaCloud.getRows("29758,29926",function(d){
				var tmps=JSON.parse(d.responseText);
				tmpUser=tmps[1]['es'];
				tmpAdmin=tmps[0]['es'];
			},false);
			var btnSubmit = $('#btnSubmit');
			var mergevariables=new Array();
			OrekaCloud.getRows(tmpUser.vars_template,function(d){fillMergeVars(mergevariables,d,vm.nombre)},false);
			btnSubmit.prop( "disabled", false );
			OrekaCloud.sendNotification('cinescuela@mediodecontencion.com',
									vm.email,
									vm.nombre,
									mergevariables,
									tmpUser.name_template,
									tmpUser.tempkey_template,
									tmpUser.apikey_template,
									"Cinescuela",function(){
										console.log('notification full');
										$('#feedback').show('slow');
										$('#cinescuela_contacto')[0].reset();
									});	
			mergevariables=new Array();
			OrekaCloud.getRows(tmpAdmin.vars_template,function(d){fillMergeVars(mergevariables,d,"Administrador")},false);
			mergevariables.push({name:'desc',content:"Se ha recibido un mensaje con los siguientes datos:"+
				"<p>Nombre: "+vm.nombre+"</p>"+
				"<p>E-mail: "+vm.email+"</p>"+
				"<p>Asunto: "+vm.asunto+"</p>"+
				"<p>Mensaje: "+vm.mensaje+"</p>"
			});
			OrekaCloud.sendNotification('multimedia5@quickin.co',
									'cinescuela@mediodecontencion.com',
									'Administrador Cinescuela',
									mergevariables,
									tmpAdmin.name_template,
									tmpAdmin.tempkey_template,
									tmpAdmin.apikey_template);
		});
	};
}]);
function fillMergeVars(ar,d,add){
	var rows=JSON.parse(d.responseText);
	for (var i = rows.length - 1; i >= 0; i--) {
		var row=rows[i]['es'];
		if(add&&row.name_vars=="fname")
			ar.push({name:row.name_vars,content:row.content_vars+add});
		else
			ar.push({name:row.name_vars,content:row.content_vars});
	}
}
function validateFormLogin() {
	var formLogin  = $('#formLogin');
	var formForgot = $('#forgotForm');
	var sendButton  = $("#btnLogin");
	var sendButton2 = $("#btnForgot");
	var warning = $('.warning');

	var aForgot = $('#aForgot');
	var aLogin  = $('#arForgot');
	var secLogin  = $('#login_section');
	var secForgot = $('#forgotSection');

	var divFailed  = $('.failed > .error');
	var divSuccess = $('.success > h2');

	if (formLogin.length) {
		formLogin.validate({
			lang: 'es'
			,
			rules: {
				'username': 'required',
				'password': 'required'
			},
			messages: {
				username: {
					required: findUiWord( 16 , language),
				},
				passsword: {
					required: findUiWord( 17 , language),
				}
			},
			invalidHandler: function(event, validator) {
				//warning.show();
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "username") {
					$("input[name='"+element.attr("name")+"'").addClass('inputwarning');
					$("input[name='"+element.attr("name")+"'").attr('placeholder',findUiWord( 16 , language));
				}
				if (element.attr("name") == "password" ) {
					$("input[name='"+element.attr("name")+"'").attr('placeholder',findUiWord( 17 , language));
				}
			},
			submitHandler: function (form) {
				sendButton.prop( "disabled", true );	
				sendButton.html(findUiWord( 19 , language));
				formLogin.ajaxSubmit({dataType: 'json',success: function(data){
					console.log(data);
					if(data == '2'){
						sendButton.html(findUiWord( 18 , language));
						warning.html(findUiWord( 100 , language));
						warning.fadeIn('slow');
						sendButton.prop( "disabled", false );	
					}else if(data == '0'){
						//Iniciar sesión
						sendButton.html(findUiWord( 18 , language));
						warning.html(findUiWord( 20 , language));
						warning.fadeIn('slow');
						sendButton.prop( "disabled", false );	
					}else{
						sendButton.html(findUiWord( 23 , language));
						location.href=language+"/usuario/"+get_alias(data);
					}
				}});
			}
		});
	}


	/*------ FORGOT FORM -------*/
	secForgot.slideToggle();
	aForgot.on('click',function(){
		secLogin.slideToggle();
		secForgot.slideToggle('slow');
	});
	aLogin.on('click',function(){
		secForgot.slideToggle();
		secLogin.slideToggle('slow');
	});

	if (formForgot.length) {
		formForgot.validate({
			lang: 'es'
			,
			rules: {
				'userforgot': 'required'
			},
			messages: {
				userforgot: {
					required: findUiWord( 26 , language),
				}
			},
			invalidHandler: function(event, validator) {
				//warning.show();
			},
			errorPlacement: function(error, element) {
				if (element.attr("name") == "userforgot") {
					$("input[name='"+element.attr("name")+"'").addClass('inputwarning');
					$("input[name='"+element.attr("name")+"'").attr('placeholder',findUiWord( 26 , language));
				}
			},
			submitHandler: function (form) {
				sendButton2.prop( "disabled", true );	
				sendButton2.html(findUiWord( 28 , language));
				formForgot.ajaxSubmit({dataType: 'json',success: function(data){
					console.log(data);
					if(data == 'listo'){
						divFailed.parent().hide();
						divSuccess.parent().fadeIn('slow');
						sendButton2.html(findUiWord( 30 , language));
					}else if(data == 'fail'){
						divSuccess.parent().hide();
						divFailed.parent().fadeIn('slow');
						sendButton2.html(findUiWord( 27 , language));
						sendButton2.prop( "disabled", false );	
					}
				}});
			}
		});
	}

}

function validateRenewPass(){
	var formRenew = $('#formRenew');
	var button = $('#btnRenew');
	var feedback = $('.warning');
	var inputRepw = $('#repass');
	var feedGood  = $('#feedback');

	inputRepw.keyup(_.debounce(function(){
		if($("#pass").html() != $("#repass").html()){
			button.prop( "disabled", true );
			feedback.show();
		}else{
			feedback.hide();
		}
	}, 500));
	

	if (formRenew.length) {
		formRenew.validate({
			rules: {
				'password': 'required',
				'repassword': 'required'
			},
			messages: {
				password: {
					required: findUiWord( 17 , language),
				},
				repasssword: {
					required: findUiWord( 95 , language),
				}
			},
			submitHandler: function (form) {
				button.prop( "disabled", true );	
				button.html(findUiWord( 19 , language));
				formRenew.ajaxSubmit({dataType: 'json',success: function(data){
					console.log(data);
					if(data = 'listo'){
						feedGood.show();
						button.html(findUiWord( 101 , language));
					}
					/*if(data == '2'){
						sendButton.html("Iniciar sesión");
						warning.html('Usuario No Activo');
						warning.fadeIn('slow');
						sendButton.prop( "disabled", false );	
					}else if(data == '1'){
						sendButton.html("Iniciando sesión ...");
						window.location.reload();
					}else if(data == '0'){
						//Iniciar sesión
						sendButton.html("Iniciar sesión");
						warning.html('Usuario o contraseña incorrecta, inténtalo de nuevo');
						warning.fadeIn('slow');
						sendButton.prop( "disabled", false );	
					}*/
				}});
			}
		});
	}
}
