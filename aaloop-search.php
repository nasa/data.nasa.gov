<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
	<div class="notice">
		<h1>Sorry! No results were found.</h1>
		<p class="bottom">
		Here's what astronauts are tweeting right now...FROM SPACE!
		<div id="noresult-list"></div>
		</p>
	</div>
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php roots_post_before(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		<?php roots_post_inside_before(); ?>
			<header>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <?php if(get_field('acronym')): ?>
				(<?php the_field('acronym'); ?>)
				<?php endif; ?>
				</a>
				</h2>
			</header>
			<div class="entry-content">
		<?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
			<?php if(has_post_thumbnail()) {
				the_post_thumbnail();
			} else {
				echo '<img width="150" height="100" src="../img/default-thumbnail.jpg" />';
			} ?>
			<?php the_excerpt(); ?>
		<?php else : ?>
		<?php if(has_post_thumbnail()) {
			the_post_thumbnail();
		} else {
			echo '<img width="150" height="100" src="img/default-thumbnail.jpg" />';
		} ?>
			<?php the_excerpt(); ?> 
		<?php endif; ?>
			</div>
			<div class="entry-sidebar">
			<h3>Categories</h3>
			 <?php 
			 $cat_list = get_my_category_list();
			 
			 echo $cat_list;
			  ?>
			<div class="meta">Available in: <?php echo get_field('formats'); ?><br />
			<?php if(get_field('datagov_availability')): ?>
			Available on <a href="http://explore.data.gov/d/<?php the_field('datagov_id'); ?>">Data.gov</a></div>
			<?php endif; ?>
			</div>
			<footer>
				<?php $tag = get_the_tags(); if (!$tag) { } else { ?><p><?php the_tags(); ?></p><?php } ?>
			</footer>
		</div>
		<?php roots_post_inside_after(); ?>
		</article>
	<?php roots_post_after(); ?>		
	<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) : ?>
	<nav id="post-nav">
		<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'roots' ) ); ?></div>
		<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'roots' ) ); ?></div>
	</nav>
<?php endif; ?>
