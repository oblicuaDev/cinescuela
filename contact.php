<?php 
	include 'includes/head.php';
?>

<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--Contenido interna-->
	<article class="intern general">
		<h2><?=$spina_post['title']?></h2>
	</article><!--Fin Contenido interna-->

	<!--Formulario contacto-->
	<section class="form_contact" ng-app="app">
		<h2><?=find_array($json,12, $lang_ct)?></h2>
		<p class="warning"><?=find_array($json,92, $lang_ct)?></p>
		<div>
			<form id="cinescuela_contacto" method="post" ng-controller="Contacto as $ctrl" name="myForm" ng-submit="Save()">
				<p>
					<label for="name"><?=find_array($json,58, $lang_ct)?></label>
					<input type="text" name="name" ng-model="$ctrl.nombre" ng-minlength="3" required>
					<span ng-show="submitted || myForm.name.$dirty && myForm.name.$invalid">
						<span class="error" ng-show="myForm.name.$error.required"><?=find_array($json,67, $lang_ct)?>.</span>
						<span class="error" ng-show="myForm.name.$touched && myForm.name.$invalid"><?=find_array($json,63, $lang_ct)?>.</span>
					</span>
				</p>
				<p>
					<label for="email"><?=find_array($json,59, $lang_ct)?></label>
					<input type="email" name="email" ng-model="$ctrl.email" required>
					<span ng-show="submitted || myForm.email.$dirty && myForm.email.$invalid">
						<span class="error" ng-show="myForm.email.$error.required"><?=find_array($json,68, $lang_ct)?>.</span>
						<span class="error" ng-show="myForm.email.$touched && myForm.email.$invalid"><?=find_array($json,64, $lang_ct)?>.</span>
					</span>
				</p>
				<p>
					<label for="asunto"><?=find_array($json,60, $lang_ct)?></label>
					<input type="text"  name="asunto"  ng-model="$ctrl.asunto" ng-minlength="5" required>
					<span ng-show="submitted || myForm.asunto.$dirty && myForm.asunto.$invalid">
						<span class="error" ng-show="myForm.asunto.$error.required"><?=find_array($json,69, $lang_ct)?>.</span>
						<span class="error" ng-show="myForm.asunto.$touched && myForm.asunto.$invalid"><?=find_array($json,65, $lang_ct)?>.</span>
					</span>
				</p>
				<p>
					<label for="message"><?=find_array($json,61, $lang_ct)?></label>
					<textarea name="message" ng-model="$ctrl.mensaje" ng-minlength="10" required></textarea>
					<span ng-show="submitted || myForm.message.$dirty && myForm.message.$invalid">
						<span class="error" ng-show="myForm.message.$error.required"><?=find_array($json,70, $lang_ct)?>.</span>
						<span class="error" ng-show="myForm.message.$touched && myForm.message.$invalid"><?=find_array($json,66, $lang_ct)?>.</span>
					</span>
				</p>
				<p style="display:none;">
					<input type="text" name="ref" hidden="hidden" ng-model="$ctrl.ref" value="facebook">
				</p>
				<div id="feedback" style="display: none;">
					<h2>*<?=find_array($json,71, $lang_ct)?></h2>
				</div>
				<p>
					<button class="btn"  type="submit" id="btnSubmit"><?=find_array($json,62, $lang_ct)?></button>
				</p>
			</form>
		</div>
	</section><!--Fin Formulario contacto-->
<?php include 'includes/footer.php'; ?>