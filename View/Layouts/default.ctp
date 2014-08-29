<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : Glissade
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130326

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="What about grades? - Software para el seguimiento de notas para los alumnos de la Escuela profesional de Ingeniería de Sistemas UNSA" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout; ?></title>
<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
<?php echo $this->Html->css('style') ?>
<?php echo $this->Html->css('pure-min') ?>
</head>
<body>
<div id="wrapper">
	<div id="logo" class="container">
		<h1><?php echo $this->Html->link('What about Grades?',array('controller' => 'home','action' => 'index'))?></h1>
	</div>
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<?php echo $this->element('homepage_menu');?> 
			<li><?php echo $this->Html->link('Log-in',array('controller' => 'usuarios','action' => 'login'))?></li>
		</div>
	</div>
	<div id="page" class="container">
		<div id="content">
			<div class="post">
				<h2 class="title"><?php echo $title_for_layout; ?></h2>
				<div class="entry">
					<?php echo $this->Session->flash(); ?>

					<?php echo $this->fetch('content'); ?>
			</div>
			<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
		<!-- 
		<div id="sidebar">
			<div>
				<h2>Nulla luctus eleifend</h2>
				<ul class="list-style2">
					<li class="first"><a href="#">Pellentesque quis elit non lectus gravida blandit.</a></li>
					<li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></li>
					<li><a href="#">Phasellus nec erat sit amet nibh pellentesque congue.</a></li>
					<li><a href="#">Cras vitae metus aliquam risus pellentesque pharetra.</a></li>
					<li><a href="#">Phasellus nec erat sit amet nibh pellentesque congue.</a></li>
					<li><a href="#">Maecenas vitae orci vitae tellus feugiat eleifend.</a></li>
				</ul>
			</div>
		</div> -->
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page --> 
	
</div>
<div id="footer-bg">
	<div id="footer-content" class="container">
		<div id="column1">
			<h2>Links Recomendados</h2>
			<ul class="list-style2">
				<li><a target="blank"  href="http://www.episunsa.edu.pe/web/">Escuela Profesional de Ingeniería de Sistemas</a></li>
				<li><a target="blank"  href="http://www.unsa.edu.pe/">Universidad Nacional de San Agustín</a></li>
			</ul>
		</div>
		<div id="column3">
			<h2>Redes Sociales</h2>
			<ul class="list-style2">
				<li><a target="blank"  href="https://www.facebook.com/pages/Escuela-Profesional-de-Ingenieria-de-Sistemas/171720913528">Facebook EPIS</a></li>
				<li><a target="blank" href="https://twitter.com/episunsa">Twitter EPIS</a></li>			

				<li><a target="blank" href="http://www.youtube.com/user/cdepis">Youtube EPIS</a></li>			
			</ul>
		</div>
	</div>
</div>
<div id="footer">
	<?php echo $this->element('footer'); ?>
</div>
<!-- end #footer -->
</body>
</html>