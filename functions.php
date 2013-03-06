<?php
require_once ( get_template_directory() . '/theme-options.php' );
$options = get_option('scratch_theme_options'); 

//supports custom background - visit wp-admin > appearance > background to change
add_custom_background();

//supports featured post thumbnails - visit the edit a post to change this
add_theme_support( 'post-thumbnails' );

//Adds Custom Menu Support
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'scratch_nav', 'Scratch theme top Navigation Menu' );
}
//adds 4 widget zones - navigation, sidebar, footer, and a "featured" area on the home page
if ( function_exists('register_sidebar') ){
	

	register_sidebar(array(
		'name' => 'sidebar',
		'description' => 'A column alongside the content. called in sidebar.php',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'footer',
		'description' => 'the area at the bottom of the page. called in footer.php',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => 'Home Featured Image',
		'description' => 'the area at the top of the home page. called in index.php',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => '404 Error Page',
		'description' => 'the area in the contents of the 404 error page. put something cool on your 404 file not found page! called in 404.php',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}
function is_sidebar_active($index){
	$sidebars	= wp_get_sidebars_widgets();
	$key		= (string) 'sidebar-'.$index;

	return (isset($sidebars[$key]));
}
//changes length of excerpt for a prettier home page
function new_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

//changes the [...] in excerpts
function new_excerpt_more($more) {
	 $options = get_option('scratch_theme_options');
	 global $post;
	 if($options['read_more'] != ''){
		 $readmore = $options['read_more'];
	 }else{
		 $readmore = 'More';
	 }
	return ' <a class="read-more" href="'. get_permalink($post->ID) . '">' . $readmore. '</a>';

}
add_filter('excerpt_more', 'new_excerpt_more');


//feature widget - large featured post image

//sets up image sizes for home page (name, width, height, crop)
add_image_size( 'scratch-feature-image', 960, 360, true );
add_image_size( 'scratch-thumbnail', 300, 135, true );
add_image_size( 'scratch-medium', 650, 400, true);

//home feature widget
class scratch_feature_widget extends WP_Widget {
	function scratch_feature_widget() {
		$widget_ops = array('classname' => 'widget-feature', 'description' => 'Shows the latest large image from a specific category of posts. put this in the Home Featured Image area for best results' );
		$this->WP_Widget('widget_feature', 'Feature Image', $widget_ops);

	}
 
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
	 
			echo $before_widget;
			
			$category = empty($instance['category']) ? '&nbsp;' : apply_filters('widget_category', $instance['category']);
			
			
			?>
            <div class="scratch_slider">
            <?php 
				//first loop
				
				query_posts("category_name=$category&showposts=3"); ?>
				
				<?php while (have_posts()) : the_post(); ?>
				<div id="featurepost-<?php the_ID(); ?>" class="post">
				<div class="thumbnail">
				<a href="<?php the_permalink() ?>">
				<?php the_post_thumbnail('scratch-feature-image'); ?>
				</a>
				</div>
				<div class="postinfo">
				<h3><?php
					$category = get_the_category(); 
					echo $category[0]->cat_name;
					?></h3>
				<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				</div> 
				</div>
				<?php endwhile;?>
            </div><!--closes .scratch_slider -->
            <?php 
			echo $after_widget;

	}
 
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['category'] = strip_tags($new_instance['category']);
	
 
		return $instance;

	}
 
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'category' => '') );
		$category = strip_tags($instance['category']);
		
?>
			
			<p>
           
           <label for="<?php echo $this->get_field_id('cateogry'); ?>">Category Name: <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="text" value="<?php echo esc_attr($category); ?>" />

</label>
          
          </p>
			

<?php

	}
}
register_widget('scratch_feature_widget');

// Add Scratch theme options link to admin bar
function scratch_admin_bar_render() {
        global $wp_admin_bar;
        // we add a submenu item 
        $wp_admin_bar->add_menu( array(
         'id' => 'scratch_options',
        'title' => __('Scratch Theme Options'),
        'href' => admin_url( 'themes.php?page=theme_options')
    ) );
}
// and we hook our function via
add_action( 'wp_before_admin_bar_render', 'scratch_admin_bar_render' );


// add jquery
function scratch_jquery(){
?>
<script type="text/javascript" src="<?php echo get_theme_root_uri()?>/scratch/scripts/jquery-1.4.3.min.js"></script>
<?php	
}
/// add fancybox
function scratch_fancybox(){?>
	<link type="text/css" rel="stylesheet" media="screen" href="<?php echo get_theme_root_uri()?>/scratch/scripts/fancybox/jquery.fancybox-1.3.4.css" /><script type="text/javascript" src="<?php echo get_theme_root_uri()?>/scratch/scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			$("a[href$=.jpg],a[href$=.png],a[href$=.gif]").fancybox();
		});
	</script>
<?php } //add cycle javascript for featured image widget
function scratch_jq_cycle(){?>
		<script type="text/javascript" src="<?php echo get_theme_root_uri()?>/scratch/scripts/cycle.js"></script>
    <script type="text/javascript">
		$('.scratch_slider').cycle({ 
    		fx: 'fade',
			speed:    300, 
    		timeout:  6000  
		});
	</script>
<?php } 
add_action('wp_head', 'scratch_jquery');
add_action( 'wp_head', 'scratch_fancybox' );
add_action( 'wp_head', 'scratch_jq_cycle' );
?>