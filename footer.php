<?php
	$options = get_option('scratch_theme_options');	
?>
<div id="footer">

<?php if(is_active_sidebar(3)): ?>
    <ul> 
    <?php if ( !function_exists('dynamic_sidebar')  
        || !dynamic_sidebar('footer') ) : ?>  
     	
	<?php endif; ?>  
    </ul>
<?php endif; ?>  
    

	<p class="copyright">© <?php the_time('Y'); ?> <?php bloginfo('name'); ?> | Built from <a href="http://scratch.melissacabral.com">Scratch</a> | Powered by <a href="http://wordpress.org">Wordpress</a><br />
	<a href="<?php bloginfo('rss2_url'); ?>">Grab the feed</a>
    </p>

</div><!--/#footer-->

</div><!--/#wrapper-->
<?php  //footer stuff ?>
<?php if($options['footer_stuff'] != ''){echo $options['footer_stuff'];} ?>

<?php wp_footer(); ?>

</body>
</html>
