<?php get_header(); ?>  

<div id="content">

	<div class="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
        <div id="post-<?php the_ID(); ?>" class="post<?php sticky_class(); ?><?php if(has_post_thumbnail()){ echo ' has_thumbnail'; } ?>">
            <?php
            if(is_singular()){ 
                if(has_post_thumbnail()){//show medium image on posts and pages ?>
            <div class="thumbnail">
            <?php the_post_thumbnail('scratch-medium'); ?>
            </div>
            <?php }  //closes if has post thumbnail?>
            <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <?php the_content(); ?>
            <?php 
            }else{ //not a singular page/post ?>
            <?php if(has_post_thumbnail()){ //show small thumbnail on all other views?>
            <div class="thumbnail">       
            
                <a href="<?php the_permalink() ?>">
                <?php the_post_thumbnail('scratch-thumbnail'); ?>
                </a>
			<?php 
            if(!is_category()){ ?>
                <h3><?php the_category(', '); ?></h3>
            <?php } ?>
            </div>
            <?php } //closes if has thumbnail ?>	
            <h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
            <?php } //closes else not a singular page/post?>
            <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:' ), 'after' => '</div>' ) ); ?>
     
            <p class="metadata"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?> | <?php the_category(', '); ?> | <?php comments_number('Comment', '1 comment', '% comments'); ?> <?php edit_post_link('Edit', '| '); ?></p>
    
        </div><!--closes .post-->
        
        <?php comments_template(); // Get wp-comments.php template on single pages ?>
        
		
        <?php endwhile; else: ?>
    
        <h2>Woops...</h2>
    
        <p>Sorry, no posts we're found.</p>
    
        <?php endif; ?>
<?php if(!is_singular()){ ?>
        <div class="navigation">
            <div class="alignright"><?php previous_posts_link('Newer &raquo;') ?>
            </div>
            <div class="alignleft"><?php next_posts_link('&laquo; Older') ?>
            </div>
         </div>
         <?php } ?>
	</div><!-- /#main -->
<?php get_sidebar(); ?>  
</div><!-- /#content -->
<?php get_footer(); ?>  