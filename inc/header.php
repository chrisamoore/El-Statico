<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js no-ie"> <!--<![endif]-->
<head>
 	<meta charset="utf-8">
 	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1"><![endif]-->

  <title><?php echo $page['title']; ?> | Elstatico</title>
	<link rel='canonical' href='<?php echo $page['canonical']; ?>' />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
	
	<link rel="stylesheet" href="<?php echo $site['domain']; ?>css/normalize.css" />
  <link rel="stylesheet" href="<?php echo $site['domain']; ?>css/style.css" />

	<script src="<?php echo $site['domain']; ?>js/modernizr-1.6.min.js"></script>
    


</head>
<body id="page-<?php echo $page['body_id'];?>">
<div id="sitewrap">
<section id="breadcrumbs">
<?php echo $page['breadcrumbs'];?>
</section>

<nav id="main-menu">
    	<ul><?php echo $page['menu']; ?></ul>
</nav>
<aside id="sidebar">
<?php echo $page['subpages']; ?>
</aside>
<section id="content">
