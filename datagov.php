<?php get_header(); ?>
<h3>Datasets not on data.gov</h3>
<ul>
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('showposts=1000'.'&paged='.$paged);
?>
<?php
$with_meta = array();

// Loop over posts just to find out which posts have the meta key
while(have_posts()) :
	the_post();

	$has_my_meta = get_post_meta( $post->ID, 'datagov_id', true );
	if( $has_my_meta )
		// Foreach post that has the key, store the ID into the array
		$with_meta[] = $post->ID;

endwhile;

// Rewind the query
rewind_posts();

// If no IDs, just do the loop as normal
if( empty( $with_meta ) ) : 

	while(have_posts()) : the_post();
	?>

	<?php if(get_field('datagov_id')): ?>
		<?php else: ?>
		<div class="articleContent">
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 			 <small><?php the_excerpt_rss(); ?></small>
		</div>
		<?php endif; ?>
	<?php
	endwhile;

// Else if we have some IDs, loop over the posts skipping those not in the array
else :

	while(have_posts()) : the_post();
		if( !in_array( $post->ID, $with_meta ) )
			continue;
	?>
		<?php if(get_field('datagov_id')): ?>
			<?php else: ?>
			<div class="articleContent">
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
	 			 <small><?php the_excerpt_rss(); ?></small>
			</div>
			<?php endif; ?>

	<?php
	endwhile; 

	// Now rewind the query again so we can iterate over the posts that don't have the key
	rewind_posts();

	while(have_posts()) : the_post();
		if( in_array( $post->ID, $with_meta ) )
			continue;
	?>

	<?php if(get_field('datagov_id')): ?>
		<?php else: ?>
		<div class="articleContent">
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
 			 <small><?php the_excerpt_rss(); ?></small>
		</div>
		<?php endif; ?>

	<?php
	endwhile;

endif;
?>
<?php $wp_query = null; $wp_query = $temp;?>
<?php get_footer(); ?>