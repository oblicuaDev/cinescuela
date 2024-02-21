<?php include 'includes/head.php'; if(!isset($_SESSION['logged'])) echo '<script>location.href="/'.$lang.'/";</script>'?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->

	<!--Contenido interna-->
	<article class="intern general">
		<h2><?=$spina_post['title']?></h2>
	</article><!--Fin Contenido interna-->

	<!--Formulario contacto-->
	<section class="form_contact">
		<h2><?=find_array($json,73, $lang_ct)?></h2>
        <p class="warning"><?=find_array($json,89, $lang_ct)?></p>
		<div >
			<form id="cinescuela_contacto">
				<p>
					<label for="nom"><?=find_array($json,78, $lang_ct)?>:</label>
					<input type="text" id="nom" name="nom" class="required">
				</p>
                <p>
					<label for="description"><?=find_array($json,79, $lang_ct)?>:</label>
					<textarea id="description" name="description" class="required"></textarea>
				</p>
                <p>
					<label for="trailer"><?=find_array($json,80, $lang_ct)?>:</label>
					<input type="text" id="trailer" name="trailer" class="required">
				</p>
                <p>
					<label for="director"><?=find_array($json,81, $lang_ct)?>:</label>
					<input type="text" id="director" name="director" class="required">
				</p>
                <p>
					<label for="tags"><?=find_array($json,82, $lang_ct)?>:</label>
					<input type="text" id="tags" name="tags" class="required">
				</p>
                <p>
					<label for="country"><?=find_array($json,83, $lang_ct)?></label>
					<input type="text" id="country" name="country" class="required">
				</p>
                <p>
					<label for="year"><?=find_array($json,84, $lang_ct)?>:</label>
					<input type="text" id="year" name="year" class="required">
				</p>
                <p>
					<label for="mins"><?=find_array($json,85, $lang_ct)?>:</label>
					<input type="text" id="mins" name="mins" class="required">
				</p>
                <p>
					<label for="body"><?=find_array($json,86, $lang_ct)?></label>
					<textarea id="body" name="body" class="required"></textarea>
				</p>
                 <p>
					<label for="download"><?=find_array($json,87, $lang_ct)?>:</label>
					<input type="text" id="download" name="download" class="required" />
				</p>
				<p>
					<input type="button" value="<?=find_array($json,88, $lang_ct)?>" class="btn" onclick="validar_form()">
				</p>
			</form>
		</div>
	</section><!--Fin Formulario contacto-->

<script>
function validar_form()
{
	var obligatorios = $("#cinescuela_contacto input.required,  #cinescuela_contacto textarea.required");
	var valido = 0;
	/*Primero miramos que no esten vacíos*/
	obligatorios.each(function( index ) {
		  if( $(this).val()==0 || $(this).val()=="")
			{
				valido = 1;
				$(this).css('border','1px solid #FF003A')

			}
			else
			{
				$(this).css('border','0')
			}
		});
		

		
	if(valido==0)
	{
		$("#cinescuela_contacto").animate({'opacity':0},500);
		var form=$('#cinescuela_contacto').serializeArray();
		$.ajax({
            url: "reg_movie.php",
            type: "post",
            data: form,
            success: function(d) {
                console.log(d);
				$(".warning").fadeIn();
            }
        });
	}
}
</script>
<style>
.uploadifive-button
{
	float:none;
	margin:0 auto;
}
.form_contact > div p
{
	overflow:hidden;
}
</style>
<?php include 'includes/footer.php'; ?>