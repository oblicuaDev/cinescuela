<?php include 'includes/head.php'; ?>
<?php include 'includes/header.php'; ?>

<!--Contenido general-->
<section id="main_container" class="pelicula">
	<h2 class="hidden">Pelicula</h2>
	<!--Tabs contenido pelicula-->
	<div id="tabs">
		<ul>
		<?php for ($i=1; $i < 4 ; $i++) { ?>
			<li><a href="#tab-<?php echo $i; ?>"><span><strong><?php echo $i; ?></strong>Título 1 lorem ipsum dolor</span></a></li>
		<?php } ?>
		</ul>
		<!--Tab item video-->
		<section id="tab-1">
			<!--Contenido left-->
			<div class="c_left">
				<div class="general-scroll">
					<div class="desc">
						<h2>TÍTULO 1 LOREM IPSUM DOLOR</h2><hr>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
					</div>
				</div>
			</div><!--Fin Contenido left-->
			<!--Contenido Right-->
			<div class="c_right">
				<figure class="video" style="background-image:url(images/prueba/video.jpg);">
					<a href="http://www.youtube.com/embed/VOJyrQa_WR4" class="open_video">
						<img src="images/prueba/video.jpg" alt="Video">
						<span class="figcaption">REPRODUCIR VIDEO</span>
					</a>
				</figure>
				<div class="general-scroll two">
					<div class="footer_content">
						<p>Pie del contenido Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non augue at elit consequat tristique venenatis at ipsum. Morbi ut turpis laoreet, vestibulum ante quis, malesuada ex. Nam molestie dignissim ipsum, in rutrum nisi pulvinar in. dignissim ipsum, inar in. sit amet, consFusce non augue at elit consequat tristique venenatis at ipsum. Morbi ut turpis laoreet, vestibulum ante quis, malesuada ex.</p>
					</div>
				</div>
			</div><!--Fin Contenido Right-->
		</section><!--Fin Tab item video-->
		<!--Tab item audio-->
		<section id="tab-2">
			<!--Contenido left-->
			<div class="c_left">
				<div class="general-scroll">
					<div class="desc">
						<h2>TÍTULO 2 LOREM IPSUM DOLOR</h2><hr>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
					</div>
				</div>
			</div><!--Fin Contenido left-->
			<!--Contenido Right-->
			<div class="c_right">
				<figure class="audio" style="background-image:url(images/prueba/video.jpg);">
					<img src="images/prueba/video.jpg" alt="Audio">
					<div>
						<span class="figcaption">REPRODUCIR AUDIO</span>
						<!--AUDIO AQUI-->
					</div>
				</figure>
				<div class="general-scroll two">
					<div class="footer_content">
						<p>Pie del contenido Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non augue at elit consequat tristique venenatis at ipsum. Morbi ut turpis laoreet, vestibulum ante quis, malesuada ex. Nam molestie dignissim ipsum, in rutrum nisi pulvinar in. dignissim ipsum, inar in. sit amet, consFusce non augue at elit consequat tristique venenatis at ipsum. Morbi ut turpis laoreet, vestibulum ante quis, malesuada ex.</p>
					</div>
				</div>
			</div><!--Fin Contenido Right-->
		</section><!--Fin Tab item audio-->
		<!--Tab item imagenes-->
		<section id="tab-3">
			<!--Contenido left-->
			<div class="c_left">
				<div class="galeria">
					<div class="carrousel">
					<?php for ($a=1; $a < 5; $a++) { ?>
						<div>
						<?php for ($k=1; $k < 7; $k++) { ?>
							<figure style="background-image:url(images/prueba/art_<?php echo $k; ?>.jpg);">
								<a href="images/prueba/art_<?php echo $k; ?>.jpg" class="open_gallery">
									<img src="images/prueba/art_<?php echo $k; ?>.jpg" alt="imagen galeria">
								</a>
							</figure>
						<?php } ?>
						</div>
					<?php } ?>
					</div>
				</div>
				<div class="general-scroll three">
					<div class="footer_content">
						<p>Pie del contenido Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non augue at elit consequat tristique venenatis at ipsum. Morbi ut turpis laoreet, vestibulum ante quis, malesuada ex. Nam molestie dignissim ipsum, in rutrum nisi pulvinar in. dignissim ipsum, in rutrum nisi pulvinar in.</p>
					</div>
				</div>
			</div><!--Fin Contenido left-->
			<!--Contenido Right-->
			<div class="c_right">
				<div class="general-scroll">
					<div class="desc">
						<h2>TÍTULO 3 LOREM IPSUM DOLOR</h2><hr>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
						<p>Phasellus at aliquet nulla, sit amet cursus nisl. Nam scelerisque quis nisl eu congue. Nullam vitae est et mauris feugiat convallis vel sed justo. Integer id lacus eu quam dignissim pretium vel eu nulla. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer quis purus gravida, dictum erat luctus, fringilla nibh. Nullam hendrerit quam et mauris euismod, sit amet ornare sem elementum. Nunc mi urna, pellentesque at ex quis, pellentesque bibendum neque. Donec id lobortis lectus, et dapibus felis. In lacus ligula, imperdiet in mattis sed.</p>
					</div>
				</div>
			</div><!--Fin Contenido Right-->
		</section><!--Fin Tab item imagenes-->
	</div><!--Fin Tabs contenido pelicula-->
	<!--Actividades complementarias-->
	<section class="act_comp">
		<h2>ACTIVIDADES COMPLEMENTARIAS</h2>
		<ul id="carrousel_act">
		<?php for ($x=0; $x< 12; $x++) { ?>
			<li>
				<h3>Título actividad lorem ipsum dolor sit amet</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce non augue at elit consequat tristique venenatis at ipsum.</p>
			</li>
		<?php } ?>
		</ul>
	</section><!--Fin Actividades complementarias-->
</section><!--Fin Contenido general-->

<?php include 'includes/footer.php'; ?>