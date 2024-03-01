<?php include 'includes/head.php'; 
if(!isset($_SESSION['logged']['cod_us']) || $_SESSION['logged']['cod_us']==""){?>
<script>location.href="<?=$_GET['lang']?>/";</script>
<?php } ?>
<?php 
	$user=$cinescuela->getInfoUser(strval($_SESSION['logged']['cod_us']));
?>
<!--Contenedor principal-->
<div id="main_container">
	<!--Encabezado-->
	<?php include 'includes/header.php';  ?><!--Fin Encabezado-->
	<!--Panel-->

	<script>
		let userRegion = "<?=$user->acf->region[0]->ID?>";
		let userProfile = "<?=$_SESSION['logged']['pro_us'][0]->ID?>";
	</script>
	<section class="dashboard">
		<div class="title">
			<h2><?=find_array($json,72, $lang_ct)?></h2>
			<ul>
				<li><?=$_SESSION['logged']['usu_us']?></li>
				<li> <?=$profile->post_title?> - <? echo $_SERVER["REMOTE_ADDR"];?></li>
			</ul>
			<a href="<?=$_GET['lang']?>/subir-pelicula" class="upload"><?=find_array($json,73, $lang_ct)?></a>
		</div>
		<aside>
			<h2><?=find_array($json,90, $lang_ct)?></h2>
			<ul>
			</ul>
        
		</aside>
		<section class="disp">
			<h2><span id="dash_cycles"><?=find_array($json,102, $lang_ct)?></span> / <span id="dash_films"><?=find_array($json,74, $lang_ct)?></span></h2>
			<div class="scroll-bar-one"></div>
		</section>
		<section class="news">
			<h2><?=find_array($json,76, $lang_ct)?></h2>
			<div class="scroll-bar-two">
			</div>
		</section>
		<section class="events">
			<h2><?=find_array($json,77, $lang_ct)?></h2>
			<div class="scroll-bar-two">
			</div>
		</section>
         <section class="events tools">
			<h2><?=find_array($json,91, $lang_ct)?></h2>
			<div class="scroll-bar-two"></div>
		</section>
	</section>
	<div id="loading_page"></div>
<?php include 'includes/footer.php'; ?>
<script>


  // Función para formatear la fecha
function formatDate(publication_date) {
    var months = {
        "Jan": "Ene",
        "Feb": "Feb",
        "Mar": "Mar",
        "Apr": "Abr",
        "May": "May",
        "Jun": "Jun",
        "Jul": "Jul",
        "Aug": "Ago",
        "Sep": "Sep",
        "Oct": "Oct",
        "Nov": "Nov",
        "Dec": "Dic"
    };
    
    var date = new Date(publication_date);
    var newM = months[date.toLocaleString('en', { month: 'short' })];
    var newD = date.getDate();
    
    return `<span>${newM}</span> ${newD}`;
}
// Consulta los perfiles primero para obtener los IDs de ciclos
complexQuery("cinescuela-perfiles/<?=strval($_SESSION['logged']['pro_us'][0]->ID)?>")
  .then((perfiles) => {
    let idsCilos = perfiles.response.acf.ciclos;
    // Realiza las demás consultas después de obtener los IDs de los ciclos
    Promise.all([
      query("cinescuela-ciclo", idsCilos),
      complexQuery("posts", "GET", 1, 100, { field: "region", value: userRegion, meta_key: "fecha_de_publicacion", order: "asc", categories: 9 }),
      complexQuery("cinescuela-events", "GET", 1, 100, { field: "perfil_relacionado", value: userProfile }),
      complexQuery("cinescuela-publi", "GET", 1, 100, { field: "region", value: userRegion })
    ])
      .then(([ciclos, posts, events, publi]) => {
        // Procesa los resultados de cada consulta
        ciclos.forEach((res) => {
          let template = `<article class="dash_cycle"><figure style="background-image:url(${res.acf.imagen_principal_el_ciclo});"></figure><div><h2><a href="<?=$_GET['lang']?>/ciclo/${get_alias(res.title.rendered)}-${res.id}" target="_blank">${res.title.rendered}</a></h2><p>${res.acf.mes_del_ciclo} ${res.acf.ano_del_ciclo}</p></div></article>`;
          document.querySelector(".scroll-bar-one").innerHTML += template;
        });
        posts.response.forEach((post) => {
          console.log(post.acf.imagen);
          var template = `
            <article>
              <figure style="background-image:url(${post.acf.imagen});"><a href="/<?=$_GET['lang']?>/informacion/16/${get_alias(post.title.rendered)}-${post.id}" target="_BLANK"></a></figure>
              <div>
                <time datetime="${post.acf.fecha_de_publicacion}">${formatDate(post.acf.fecha_de_publicacion)}</time>
                <h2><a href="/<?=$_GET['lang']?>/informacion/16/${get_alias(post.title.rendered)}-${post.id}" target="_BLANK" onClick="ga('send', 'event', 'Mi cinescuela', 'click','Actualidad de la región - ${post.title.rendered}')">${post.title.rendered}</a></h2>
                <div class="desc">
                  ${post.acf.descripcion_corta}
                </div>
              </div>
            </article>`;
          document.querySelector(".news .scroll-bar-two").innerHTML += template;
        });

        events.response.forEach((post) => {
          var template = `<article><h2><a href="<?=$_GET['lang']?>/informacion/19745/${get_alias(post.title.rendered)}-${post.id}" target="_BLANK" onClick="ga('send', 'event', 'Mi cinescuela', 'click','Utilidades - ${post.title.rendered}')">${post.title.rendered}</a></h2><time datetime="${post.acf["fecha_del_evento_a-m-d"]}">${formatDate(post.acf["fecha_del_evento_a-m-d"])}</time></article>`;
          document.querySelector(".events .scroll-bar-two").innerHTML += template;
        });

        publi.response.forEach((post) => {
          var template = `<li><a href="${post.acf.vinculo}" target="_blank"><img src="${post.acf.imagen}" alt="${post.title.rendered}"></a></li>`;
          document.querySelector("aside ul").innerHTML += template;
        });
      })
	  .then(()=>detectarCarga())
      .catch((error) => {
        console.error("Error fetching data:", error);
        // Handle error and update UI accordingly
      });
  })
  .catch((error) => {
    console.error("Error fetching data:", error);
    // Handle error and update UI accordingly
  });



</script>