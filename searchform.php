<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<label class="visuallyhidden" for="s"><?php _e('Search for:', 'roots'); ?></label>
	<input type="text" value="" name="s" id="s" x-webkit-speech placeholder="<?php if(get_search_query()): ?><?php print get_search_query(); ?><?php else: ?>What type of data are you looking for?<?php endif; ?>">
	<input type="submit" id="searchsubmit" value="<?php _e('Search', 'roots'); ?>" class="button">
</form>