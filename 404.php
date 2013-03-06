<?php
get_header();
 ?>
<div id="content">

	<div class="main">
    <h2>Page not found</h2>
<?php if ( !function_exists('dynamic_sidebar')  
        || !dynamic_sidebar('404 Error Page') ) : ?>        
     <h2>Sorry, the page you requested could not be found. You could try searching instead:</h2>
     
     <?php get_search_form(); ?> 
	
	  
    <?php endif; ?>  

</div><!-- /#main -->
<?php get_sidebar(); ?>  
</div><!-- /#content -->
<?php get_footer(); ?>  