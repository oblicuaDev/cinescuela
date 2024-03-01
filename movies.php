<?php include 'includes/head.php'; ?>
<!--Contenedor principal-->
<div id="main_container">

	<!--Encabezado-->
	<?php include 'includes/header.php'; ?><!--Fin Encabezado-->
	
	<!--peliculas-->
	<section class="intern">
		<div class="green_title">
			<!--<h2>Películas</h2>-->
			<!--Filtro-->
			<div class="filter">
				<div>
					<form action="Peliculas" method="get" id="fSearch">
					<input type="text" placeholder="<?=find_array($json, 44, $lang_ct)?>" id="search" class="txt_search" name="s" value="<?=$_GET['s']?>">
					</form>
				</div>
				<div>
                	<form action="Peliculas" method="get" id="featured">
					<select id="select_todas" name="featured">
						<option value="2" <? echo $sel=($_GET['featured']==2)?"selected":"" ?> ><?=find_array($json, 42, $lang_ct)?></option>
						<option value="1" <? echo $sel=($_GET['featured']==1)?"selected":"" ?> ><?=find_array($json, 43, $lang_ct)?></option>
					</select>
                     </form>
				</div>
				<div>
                	<form action="Peliculas" method="get" id="subject">
					<select id="select_asignaturas" name="subject">
						<option value="-1"><?=find_array($json, 45, $lang_ct)?></option>
                        	<?
							$asignaturas = $cinescuela->getAsignaturas();
							for($i=0;$i<count($asignaturas);$i++){ $post = $asignaturas[$i]; ?>
                        <option value="<?=$post->id?>" <? if($_GET['subject']==$post->id){ echo "selected";} ?>><?=$post->title->rendered?></option>
                            <? } ?>
					</select>
                    </form>
				</div>
				<div>
                	<form action="Peliculas" method="get" id="topic">
					<select id="select_etiquetas" name="topic">
						<option value="-1"><?=find_array($json, 46, $lang_ct)?></option>
                        <?
							$tematicas = $cinescuela->getTematicas();
							for($i=0;$i<count($tematicas);$i++){ $post = $tematicas[$i]; ?>
                            <option value="<?=$post->id?>" <? if($_GET['topic']==$post->id){ echo "selected";} ?>><?=$post->title->rendered?></option>
                            <? } ?>
					</select>
                    </form>
				</div>
			</div>
			<!--Fin Filtro-->

		</div><!--Fin Titulo-->
		<!--lista peliculas-->
		<div class="list_movies">
		<?php
// Obtener el número de página actual
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$lang = isset($_GET['lang']) ? $_GET['lang'] : "es";

// Obtener películas destacadas si estamos en la primera página
if ($currentPage == 1) {
    $destacadosParams = ['field' => 'pelicula_destacada,pelicula_frances', 'value' => '1,' . ($lang == 'es' ? 0 : 1)];

    // Agregar validaciones adicionales para $_GET['subject'] y $_GET['topic']
    if (isset($_GET['subject'])) {
        $destacadosParams['field'] .= ',asignaturas';
        $destacadosParams['value'] .= ',' . $_GET['subject'];
    }

    if (isset($_GET['topic'])) {
        $destacadosParams['field'] .= ',tematicas';
        $destacadosParams['value'] .= ',' . $_GET['topic'];
    }

    $destacados = $cinescuela->getPeliculas("", $currentPage, 2, $destacadosParams);

    if (is_array($destacados["response"])) {
        for ($i = 0; $i < count($destacados["response"]); $i++) {
            $post = $destacados["response"][$i];
            $class = "";
            if ($i == 0) {
                $class = 'class="big"';
            }
            if ($i == 1) {
                $class = 'class="big_two"';
            }
            ?>
            <article <?=$class?>>
                <a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->title->rendered)?>-<?=$post->id?>" onClick="ga('send', 'event', 'Películas', 'click', '<?=$post->title->rendered?>')">
                <img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="<?=$post->acf->imagen_pelicula?>" alt="<?=$post->title->rendered?>">
                    <div>
                        <h2><?=$post->title->rendered?></h2>
                        <p><?=$post->acf->director_pelicula?></p>
                        <!--<img src="images/site/min_rank_4.png" alt="ranking">-->
                    </div>
                </a>
            </article>
            <?php }
    }
}

// Obtener películas para la página actual
$postsParams = ['field' => 'pelicula_destacada,pelicula_frances', 'value' => '0,' . ($lang == 'es' ? 0 : 1)];

// Agregar validaciones adicionales para $_GET['subject'] y $_GET['topic']
if (isset($_GET['subject'])) {
    $postsParams['field'] .= ',asignaturas';
    $postsParams['value'] .= ',' . $_GET['subject'];
}

if (isset($_GET['topic'])) {
    $postsParams['field'] .= ',tematicas';
    $postsParams['value'] .= ',' . $_GET['topic'];
}

// Agregar validación para $_GET['s']
if (isset($_GET['s'])) {
    $postsParams['search'] = $_GET['s'];
}

$posts = $cinescuela->getPeliculas("", $currentPage, 15, $postsParams);

if (is_array($posts["response"])) {
    foreach ($posts["response"] as $post) { ?>
        <article>
            <a href="<?=$_GET['lang']?>/pelicula/<?=get_alias($post->title->rendered)?>-<?=$post->id?>">
                <img loading="lazy" class="lazyload" src="https://picsum.photos/20/20" data-src="<?=$post->acf->imagen_pelicula?>" alt="<?=$post->title->rendered?>">
                <div>
                    <h2><?=$post->title->rendered?></h2>
                    <p><?=$post->acf->director_pelicula?></p>
                    <!--<img src="images/site/min_rank_4.png" alt="ranking">-->
                </div>
            </a>
        </article>
    <?php }
}
?>




        <div class="pager">
			<? pager($currentPage,$posts["total_pages"]); ?>
		</div>
        </div><!--Fin lista peliculas-->
        
	</section><!--Fin peliculas-->

<?php include 'includes/footer.php'; ?>