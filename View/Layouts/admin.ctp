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
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout; ?></title>
<link href="http://fonts.googleapis.com/css?family=Oxygen:400,700,300" rel="stylesheet" type="text/css" />
<?php echo $this->Html->css('style') ?>
</head>
<body>
<div id="wrapper">
	<div id="logo" class="container">
		<h1><a href="#">Glissade </a></h1>
		<p>In posuere eleifend odio quisque semper augue.</p>
	</div>
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="#">Home</a></li>
				<li><a href="#">Log-in</a></li>
				<li><a href="#">Blog</a></li>
				<li><a href="#">Photos</a></li>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Links</a></li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
	</div>
	<div id="page" class="container">
		<div id="content">
			<div class="post">
				<h2 class="title"><a href="#">Fusce ultrices fringilla metus</a></h2>
				<div class="entry">
					<?php echo $this->Session->flash(); ?>

					<?php echo $this->fetch('content'); ?>
			</div>
			<div style="clear: both;">&nbsp;</div>
		</div>
		<!-- end #content -->
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
		</div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page --> 
	
</div>
<div id="footer-bg">
	<div id="footer-content" class="container">
		<div id="column1">
			<h2>Tellus feugiat eleifend</h2>
			<ul class="list-style2">
				<li class="first"><a href="#">Pellentesque quis elit non lectus gravida blandit.</a></li>
				<li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></li>
				<li><a href="#">Phasellus nec erat sit amet nibh pellentesque congue.</a></li>
				<li><a href="#">Cras vitae metus aliquam risus pellentesque pharetra.</a></li>
				<li><a href="#">Maecenas vitae orci vitae tellus feugiat eleifend.</a></li>
			</ul>
		</div>
		<div id="column2">
			<h2>Etiam rhoncus volutpat</h2>
			<ul class="list-style2">
				<li class="first"><a href="#">Pellentesque quis elit non lectus gravida blandit.</a></li>
				<li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></li>
				<li><a href="#">Phasellus nec erat sit amet nibh pellentesque congue.</a></li>
				<li><a href="#">Cras vitae metus aliquam risus pellentesque pharetra.</a></li>
				<li><a href="#">Maecenas vitae orci vitae tellus feugiat eleifend.</a></li>
			</ul>
		</div>
		<div id="column3">
			<h2>Recommended Links</h2>
			<ul class="list-style2">
				<li class="first"><a href="#">Pellentesque quis elit non lectus gravida blandit.</a></li>
				<li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</a></li>
				<li><a href="#">Phasellus nec erat sit amet nibh pellentesque congue.</a></li>
				<li><a href="#">Cras vitae metus aliquam risus pellentesque pharetra.</a></li>
				<li><a href="#">Maecenas vitae orci vitae tellus feugiat eleifend.</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="footer">
	<p>© 2013 Untitled Inc. All rights reserved. Lorem ipsum dolor sit amet nullam blandit consequat phasellus etiam lorem. Design by <a href="http://www.freecsstemplates.org/" rel="nofollow">FreeCSSTemplates.org</a>.  Photos by <a href="http://fotogrph.com/">Fotogrph</a>.</p>
</div>
<!-- end #footer -->
</body>
</html>