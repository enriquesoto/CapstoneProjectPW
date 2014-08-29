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
<?php echo $this->fetch('script'); ?>
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
			<ul>
					<?php echo $this->element('homepage_menu');?>
					<?php echo $this->element('alumno_menu') ; ?>
					<?php echo $this->element('user_menu'); ?>
			</ul>
		</div>
	</div>
	<div id="page" class="container">
		<div id="content">
			<div class="post">
				<div ><?php echo $this->Session->flash(); ?></div>
				<h2 class="title"><?php echo $title_for_layout; ?></h2>
				<div class="entry">
					

					<?php echo $this->fetch('content'); ?>
			</div>
			<div style="clear: both;">&nbsp;</div>
		</div>
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page --> 
	
</div>
<div id="footer">
	<?php echo $this->element('footer'); ?>
</div>
<!-- end #footer -->
</body>
</html>