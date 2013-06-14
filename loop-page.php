<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
	<?php roots_post_before(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix article single page'); ?>>
		<?php roots_post_inside_before(); ?>
			<header>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?>
				</a>
				</h2>
			</header>
			<div class="entry-content">
		<?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
			<?php the_excerpt(); ?>
		<?php else : ?>		
		<?php the_content(); ?> 
		<?php endif; ?>
			</div>
			<footer>
				<?php $tag = get_the_tags(); if (!$tag) { } else { ?><p><?php the_tags(); ?></p><?php } ?>
			</footer>
		</div>
		<?php roots_post_inside_after(); ?>
		</div>
	<?php roots_post_after(); ?>		
	<?php endwhile; // End the loop ?>