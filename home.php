<?php $options = get_option('scratch_theme_options'); ?>
<?php get_header(); ?>  

<div id="content">

<div class="feature"> 
<?php if ( !function_exists('dynamic_sidebar')  
        || !dynamic_sidebar('Home Featured Image') ) : ?>        
     
	
	  
    <?php endif; ?>  
  
  </div>


  <?php 
 //change the number of posts on the home page in the theme options admin page 
 // rewind_posts();
 wp_reset_query();
  if($options['home_posts'] == '' ){
	  $options['home_posts'] = 3;	  
  }
  $page = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $qp= 'post_type=post&paged='.$page.'&posts_per_page='.$options['home_posts'];
  
  query_posts("$qp");
  ?>


 <div class="main"> <?php 
  //second loop
  
  while (have_posts()) : the_post(); ?>
     <div id="post-<?php the_ID(); ?>" class="post<?php sticky_class(); ?><?php if(has_post_thumbnail()):
	echo ' has_thumbnail';
	endif; ?>">
    <?php if(has_post_thumbnail()):?>
		 <div class="thumbnail">       
         <a href="<?php the_permalink() ?>">
		 <?php the_post_thumbnail('scratch-thumbnail'); ?>
         </a>
         <h3><?php the_category(', '); ?></h3>
         </div>
     <?php 	else: ?>
     <h3><?php the_category(', '); ?></h3>
     <?php endif;?>
         <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?>
        <?php edit_post_link('Edit'); ?>

        </div>
  <?php endwhile; ?>
   <div class="navigation">
      <div class="alignright"><?php previous_posts_link('Newer &raquo;') ?></div>
      <div class="alignleft"><?php next_posts_link('&laquo; Older') ?></div>
    </div>
      <?php
 
wp_reset_query();
?>
  

  </div>

<?php get_sidebar(); ?>  
	
		
	

</div><!-- /#content -->

  
<?php get_footer(); ?>  