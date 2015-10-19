<?php

if ( ! defined( 'ABSPATH' ) ) {		
	exit; // Exit if accessed directly.		
}

locate_template(array('inc/roots-activation.php'), true, true);	// activation
locate_template(array('inc/roots-admin.php'), true, true);		// admin additions/mods
locate_template(array('inc/roots-options.php'), true, true);	// theme options menu
locate_template(array('inc/roots-cleanup.php'), true, true);	// code cleanup/removal
locate_template(array('inc/roots-htaccess.php'), true, true);	// h5bp htaccess
locate_template(array('inc/roots-hooks.php'), true, true);		// hooks
locate_template(array('inc/roots-actions.php'), true, true);	// actions
locate_template(array('inc/roots-widgets.php'), true, true);	// widgets
locate_template(array('inc/roots-custom.php'), true, true);		// custom functions

$roots_options = roots_get_theme_options();

// set the maximum 'Large' image width to the maximum grid width
if (!isset($content_width)) {
	global $roots_options;
	$roots_css_framework = $roots_options['css_framework'];
	switch ($roots_css_framework) {
	    case 'blueprint': 	$content_width = 950;	break;
	    case '960gs_12': 	$content_width = 940;	break;
	    case '960gs_16': 	$content_width = 940;	break;
	    case '960gs_24': 	$content_width = 940;	break;
	    case '1140': 		$content_width = 1140;	break;
	    default: 			$content_width = 950;	break;
	}
}

// tell the TinyMCE editor to use editor-style.css
// if you have issues with getting the editor to show your changes then use the following line:
// add_editor_style('editor-style.css?' . time());
add_editor_style('editor-style.css');

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 150, 100, true ); // 50 pixels wide by 50 pixels tall, hard crop mode
add_image_size('Thumbnail', 150, 100, true);

// http://codex.wordpress.org/Post_Formats
// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

add_theme_support('menus');
register_nav_menus(array(
	'primary_navigation' => __('Primary Navigation', 'roots'),
	'utility_navigation' => __('Utility Navigation', 'roots')
));

// create widget areas: sidebar, footer
$sidebars = array('Sidebar', 'Footer');
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar,
		'before_widget' => '<article id="%1$s" class="widget %2$s"><div class="container">',
		'after_widget' => '</div></article>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

// add to robots.txt
// http://codex.wordpress.org/Search_Engine_Optimization_for_WordPress#Robots.txt_Optimization
add_action('do_robots', 'roots_robots');

function roots_robots() {
	echo "Disallow: /cgi-bin\n";
	echo "Disallow: /wp-admin\n";
	echo "Disallow: /wp-includes\n";
	echo "Disallow: /wp-content/plugins\n";
	echo "Disallow: /plugins\n";
	echo "Disallow: /wp-content/cache\n";
	echo "Disallow: /wp-content/themes\n";
	echo "Disallow: /trackback\n";
	echo "Disallow: /feed\n";
	echo "Disallow: /comments\n";
	echo "Disallow: /category/*/*\n";
	echo "Disallow: */trackback\n";
	echo "Disallow: */feed\n";
	echo "Disallow: */comments\n";
	echo "Disallow: /*?*\n";
	echo "Disallow: /*?\n";
	echo "Allow: /wp-content/uploads\n";
	echo "Allow: /assets";
}

function roots_author_link($link) {
  return str_replace('<a ', '<a class="fn" rel="author"', $link);
}

add_filter('the_author_posts_link', 'roots_author_link');

function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );


//Custom Theme Settings
add_action('admin_menu', 'add_gcf_interface');

function add_gcf_interface() {
	add_options_page('Global Custom Fields', 'Global Custom Fields', '8', 'functions', 'editglobalcustomfields');
}

function editglobalcustomfields() {
	?>
	<div class='wrap'>
	<h2>Global Custom Fields</h2>
	<form method="post" action="options.php">
	<?php wp_nonce_field('update-options') ?>

	<p><strong>Page Editor:</strong><br />
	<input type="text" name="page-editor" size="45" value="<?php echo get_option('page-editor'); ?>" /></p>
	
	<p><strong>Page Editor Email:</strong><br />
	<input type="text" name="page-editor-email" size="45" value="<?php echo get_option('page-editor-email'); ?>" /></p>
	
	<p><strong>NASA Official:</strong><br />
	<input type="text" name="nasa-official" size="45" value="<?php echo get_option('nasa-official'); ?>" /></p>

	<p><strong>NASA Official Email:</strong><br />
	<input type="text" name="nasa-official-email" size="45" value="<?php echo get_option('nasa-official-email'); ?>" /></p>
	
	<p><input type="submit" name="Submit" value="Update Options" /></p>

	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="page-editor,page-editor-email,nasa-official,nasa-official-email" />

	</form>
	</div>
	<?php
}

function get_my_category_list( $separator = '', $parents='', $post_id = false ) {

	global $wp_rewrite;

	$categories = get_the_category( $post_id );

	if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) )

		return apply_filters( 'the_category', '', $separator, $parents );



	if ( empty( $categories ) )

		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );



	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';



	$thelist = '';

	if ( '' == $separator ) {

		$thelist .= '<ul class="post-categories">';

		foreach ( $categories as $category ) {

			$thelist .= "\n\t<li>";

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

					break;

				case 'single':

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= $category->name.'</a></li>';

					break;

				case '':

				default:

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

			}

		}

		$thelist .= '</ul>';

	} else {

		$i = 0;

		foreach ( $categories as $category ) {

			if ( 0 < $i )

				$thelist .= $separator;

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

					break;

				case 'single':

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= "$category->name</a>";

					break;

				case '':

				default:

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

			}

			++$i;

		}

	}

	return apply_filters( 'the_category', $thelist, $separator, $parents );

}

function get_all_categories( $separator = '', $parents='', $post_id = false ) {

	global $wp_rewrite;

	$categories = get_the_category( $post_id );

	if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) )

		return apply_filters( 'the_category', '', $separator, $parents );



	if ( empty( $categories ) )

		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );



	$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';



	$thelist = '';

	if ( '' == $separator ) {

		$thelist .= '<ul class="post-categories">';

		foreach ( $categories as $category ) {

			$thelist .= "\n\t<li>";

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

					break;

				case 'single':

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= $category->name.'</a></li>';

					break;

				case '':

				default:

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';

			}

		}

		$thelist .= '</ul>';

	} else {

		$i = 0;

		foreach ( $categories as $category ) {

			if ( 0 < $i )

				$thelist .= $separator;

			switch ( strtolower( $parents ) ) {

				case 'multiple':

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, true, $separator );

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

					break;

				case 'single':

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';

					if ( $category->parent )

						$thelist .= get_category_parents( $category->parent, false, $separator );

					$thelist .= "$category->name</a>";

					break;

				case '':

				default:

					$thelist .= '<a class="category-'.$category->category_nicename.'" style="background-color: '.$category->category_description.'" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';

			}

			++$i;

		}

	}

	return apply_filters( 'the_category', $thelist, $separator, $parents );

}

// Remove the default Contact Form 7 Stylesheet
function remove_wpcf7_stylesheet() {
    remove_action( 'wp_head', 'wpcf7_wp_head' );
}

?>
