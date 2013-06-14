<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="chrome=1">

	<title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
	<meta name="description" content="The Open Data project is part of the NASA Open Government Initiative, and is intended to improve access to NASA data. This data catalog is a continually-growing listing of publicly available NASA datasets.">
  	<meta name="author" content="Sean Herron">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Disable IE6 Image Toolbar -->
	<meta http-equiv="imagetoolbar" content="false" />
	
	<!-- Facebook OpenGraph -->
	<meta property="og:title" content="data.nasa.gov" />
	<meta property="og:description" content="The Open Data project is part of the NASA Open Government Initiative, and is intended to improve access to NASA data. This data catalog is a continually-growing listing of publicly available NASA datasets." />
	
	
	<?php roots_stylesheets(); ?>
	
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
	
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/modernizr-2.0.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs/respond.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri(); ?>/js/libs/jquery-1.6.2.min.js"><\/script>')</script>

	<?php wp_head(); ?>
	<?php roots_head(); ?>

	<script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js"></script>
	<link rel='stylesheet' id='Ubuntu-css'  href='http://fonts.googleapis.com/css?family=Ubuntu&#038;ver=3.2.1' type='text/css' media='all' /> 
	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
	
	
</head>

<body <?php $page_slug = $post->post_name; body_class($page_slug); ?>>

	<?php roots_wrap_before(); ?>
	<div id="wrap" class="container" role="document">
	<?php roots_header_before(); ?>
		<header id="banner" class="<?php global $roots_options; echo $roots_options['container_class']; ?>" role="banner">
			<?php roots_header_inside(); ?>
			<div class="container">
	
				<a id="logo" href="http://data.nasa.gov" alt="<?php bloginfo('name'); ?>">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="<?php bloginfo('name'); ?>" />
				</a>
				<a id="tagline" href="<?php echo network_site_url(); ?>"><?php bloginfo('description'); ?></a>
				
				<?php if ($roots_options['clean_menu']) { ?>
					<nav id="nav-main" role="navigation">
						<?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'walker' => new roots_nav_walker())); ?>
					</nav>
					<?php 					
						$utility_nav = wp_get_nav_menu_object('Utility Navigation');
						$utility_nav_term_id = (int) $utility_nav->term_id;
						$menu_items = wp_get_nav_menu_items($utility_nav_term_id);					
						if ($menu_items || !empty($menu_items)) {
					?>
					<nav id="nav-utility">
						<?php wp_nav_menu(array('theme_location' => 'utility_navigation', 'walker' => new roots_nav_walker())); ?>
					</nav>
					<?php } ?>		
				<?php } else { ?>
					<nav id="nav-main" role="navigation">
						<?php wp_nav_menu(array('theme_location' => 'primary_navigation')); ?>
					</nav>
					<?php 					
						$utility_nav = wp_get_nav_menu_object('Utility Navigation');
						$utility_nav_term_id = (int) $utility_nav->term_id;
						$menu_items = wp_get_nav_menu_items($utility_nav_term_id);					
						if ($menu_items || !empty($menu_items)) {
					?>
					<nav id="nav-utility">
						<?php wp_nav_menu(array('theme_location' => 'utility_navigation')); ?>
					</nav>
					<?php } ?>								
				<?php } ?>
				<div id="searchbox"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
				<div id="category-list">
				<ul>
				<?php 
				  $categories=  get_categories(); 
				  foreach ($categories as $category) {
				  	$option = '<li><a href="http://data.nasa.gov/category/';
					$option .= $category->slug;
					$option .= '" style="background-color:';
					$option .= $category->description;
					$option .= '">';
					$option .= $category->name;
					$option .= '</a></li>';
					
					echo $option;
				  }
				 ?></ul></div>
			</div>
		</header>
	<?php roots_header_after(); ?>
