<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if (!have_posts()) : ?>
	<div class="notice">
		<p class="bottom"><?php _e('Sorry, no results were found. Instead, here are the latest tweets....<i>FROM SPACE!!!</i>', 'roots'); ?></p>
		<div id="noresult-tweet"></div>
	</div>
<?php endif; ?>

<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php roots_post_before(); ?>
		<div class="post-entry-single">
		<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix article'); ?>>
		<?php roots_post_inside_before(); ?>
		<?php if(get_field('datagov_id')): ?>
		<div class="flag"><a href="http://explore.data.gov/d/<?php the_field('datagov_id'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/datagovlogo.png" alt="Available on Data.gov" width="75" height="17" /></a></div>
		<?php endif; ?>
			<div class="header">
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?> <?php if(get_field('acronym')): ?>
				(<?php the_field('acronym'); ?>)
				<?php endif; ?>
				</a>
				</h2>
			</div>
			<div class="catbar">
			<div style="background-color:<?php
			$category = get_the_category(); 
			echo $category[0]->description;
			?>"></div>
			</div>
			<div class="entry-content">
		<?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
			<?php the_excerpt(); ?>
		<?php else : ?>
			<?php the_excerpt(); ?> 
		<?php endif; ?>
			</div>
	<div class="entry-sidebar">
			 <?php 
			 $cat_list = get_my_category_list();
			 
			 echo $cat_list;
			  ?>
			<div class="meta">
				<?php $tag = get_the_tags('<ul><li>','</li><li>','</li></ul>'); if (!$tag) { } else { ?><?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?><?php } ?>
			</div>
		</div>

		<?php roots_post_inside_after(); ?>
		</div>
		</div>
	<?php roots_post_after(); ?>		
<?php endwhile; // End the loop ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ($wp_query->max_num_pages > 1) : ?>
	<nav id="post-nav" class="infinite">
		<div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'roots' ) ); ?></div>
		<div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'roots' ) ); ?></div>
	</nav>

<?php endif; ?>
