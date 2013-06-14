<?php /* Start loop */ ?>
<?php while (have_posts()) : the_post(); ?>
<?php roots_post_before(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix article single'); ?>>
	<?php roots_post_inside_before(); ?>
	<?php if(get_field('datagov_id')): ?>
	<div class="flag"><a href="http://explore.data.gov/d/<?php the_field('datagov_id'); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/datagovlogo.png" alt="Available on Data.gov" width="75" height="17" /></a></div>
	<?php endif; ?>
		<div class="header">
			<h2>
			<a href="<?php the_field('more_info_link'); ?>"><?php the_title(); ?> <?php if(get_field('acronym')): ?>
			(<?php the_field('acronym'); ?>)
			<?php endif; ?>
			</a>
			<a id="visit-button" href="<?php the_field('more_info_link'); ?>">View</a>
			</h2>
			<?php if(get_field('more_info_link')): ?>
			<a class="more_info_link" href="<?php the_field('more_info_link'); ?>"><?php the_field('more_info_link'); ?></a>
			<?php endif; ?>
		</div>
		<div class="entry-content">
	<?php if (is_archive() || is_search()) : // Only display excerpts for archives and search ?>
		<?php the_excerpt(); ?>
	<?php else : ?>		
	<?php the_content(); ?> 
	<?php endif; ?>
		</div>
		<div class="entry-sidebar">		
		<?php if(get_field('curator_org_name')): ?>
		<h3>Organization</h3>
		<?php if(get_field('curator_url')): ?>
			<a href="<?php the_field('curator_url'); ?>"><?php the_field('curator_org_name'); ?></a><br />
		<?php else: ?>
		<?php the_field('curator_org_name'); ?><br />
		<?php endif; ?>
			<i><?php echo the_field('curator_center'); ?></i>
		<?php endif; ?>
		<?php $emailhash = md5( strtolower( trim( get_field('curator_person_email') ) ) ); ?>
		<?php if(get_field('curator_person_name')): ?>
		<h3>Curator</h3>
			<div class="author_meta">
			<img src="http://www.gravatar.com/avatar/<?php print $emailhash; ?>?s=75&r=g&d=retro" width="75" height="75" alt="<?php echo the_field('curator_person_name'); ?>'s Picture" />
			<span class="author_name"><?php echo the_field('curator_person_name'); ?></span><br />
			<i><?php echo the_field('curator_center'); ?></i><br />
			
			<a href="mailto:<?php echo the_field('curator_person_email'); ?>">Email
			</a>
			</div>
		<?php endif; ?>
		<h3>Category</h3>
		 <?php 
		 $cat_list = get_my_category_list();
		 echo $cat_list;
		  ?>

		<div class="meta">
		<?php if(get_field('datagov_id')): ?>
		<h3>Availability</h3>
			Available on <a href="http://explore.data.gov/d/<?php the_field('datagov_id'); ?>">Data.gov</a><br />
			<?php endif; ?>
		<h3>Share This</h3>
		<span class="st_facebook" ></span>
		<span  class='st_twitter' ></span>
		<div class="g-plusone" data-size="small" data-annotation="none"></div>
			<?php $tag = get_the_tags('<h3>Tags</h3><ul><li>','</li><li>','</li></ul>'); if (!$tag) { } else { ?><?php the_tags('<h3>Tags</h3><ul><li>','</li><li>','</li></ul>'); ?><?php } ?>
			</div>
	</div>
	<?php roots_post_inside_after(); ?>
	</div>
<?php roots_post_after(); ?>		
<?php endwhile; // End the loop ?>
