	<?php roots_footer_before(); ?>
		<footer id="content-info" class="<?php global $roots_options; echo $roots_options['container_class']; ?>" role="contentinfo">
			<?php roots_footer_inside(); ?>
			<div class="container">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer") ) : ?>
				<?php endif; ?>
				<p class="copy"><small>
				<img src="<?php echo get_template_directory_uri(); ?>/img/meatball.png" width="60px" height="51px" alt="<?php bloginfo('name'); ?>">
				Page Editor: <a href="mailto:<?php echo get_option('page-editor'); ?>"><?php echo get_option('page-editor'); ?></a><br />
				NASA Official: <a href="mailto:<?php echo get_option('page-editor'); ?>"><?php echo get_option('nasa-official'); ?></a><br />				
				Last Updated: 22 December 2011<br />		
				<a href="http://www.nasa.gov/about/highlights/HP_Privacy.html">Privacy Policy and Important Notices</a><br /> 
				<a href="http://open.nasa.gov/credits">Website Credits</a></small></p>
				<a href="http://www.nasa.gov/open" class="nasaopenlink">A NASA Open Government Initiative Website</a>
			</div>	
		</footer>
		<?php roots_footer_after(); ?>	
	</div><!-- /#wrap -->

<?php wp_footer(); ?>
<?php roots_footer(); ?>

	<!--[if lt IE 7]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
		<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
	<![endif]-->

<script type="text/javascript">var switchTo5x=false;</script><script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script><script type="text/javascript">stLight.options({publisher:'98f231d9-cc4f-4340-a25e-fb3d830c81ce'});</script>
<!-- Place this render call where appropriate -->
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>


</body>
</html>