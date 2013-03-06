<?php $options = get_option('scratch_theme_options'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes() ?>>
<head profile="http://gmpg.org/xfn/11">
<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<style type="text/css">
/* dynamic colors  - change in the theme options panel */
<!--
<?php if($options['body_color'] != ''){ ?>
body{ color:<?php  echo $options['body_color'];?> !important; }
<?php } ?>
<?php if($options['link_color'] != ''){ ?>
a{ color:<?php  echo $options['link_color'];?> !important; }
<?php } ?>
<?php if($options['header_color'] != ''){ ?>
#header{ color:<?php  echo $options['header_color'];?> !important; }
<?php } ?>
<?php if($options['header_link_color'] != ''){ ?>
#header a{ color:<?php  echo $options['header_link_color'];?> !important; }
<?php } ?>
<?php if($options['header_bar_color'] != ''){ ?>
#nav{ background-color:<?php  echo $options['header_bar_color'];?> !important; }
<?php } ?>
-->
</style>
<?php 
//default style sheets - enable or disable in the theme options panel
if( $options['reset_style'] != 1){ ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/stylesheets/reset.css" type="text/css" media="screen,projection" />
<?php } ?>
<?php  
if( $options['layout_style'] != 1){ ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/stylesheets/layout.css" type="text/css" media="screen,projection" />
<?php } ?>
<?php if( $options['layout_type'] == 1){ ?>
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/stylesheets/grid.css" type="text/css" media="screen,projection" />
<?php } ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" />

<link rel="shortcut icon" href="<?php echo get_option('siteurl'); ?>/favicon.ico"  />
<?php  //header stuff. customize in the theme options panel ?>
<?php if($options['header_stuff'] != ''){echo $options['header_stuff'];} ?>

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="wrapper">
    <ul id="nav"> 
                <?php 
                //change the type of navigation displayed in the theme options page
				if(has_nav_menu('scratch_nav')){
		wp_nav_menu( array( 'theme_location' => 'scratch_nav', 'container' => 'ul', 'container_id' => 'nav','items_wrap' => '%3$s' ) );
				}else{ ?>
					
                <?php if($options['nav_type'] == 1){
                    wp_list_categories('title_li=');
                }else{
                    wp_list_pages('sort_column=menu_order&title_li='); ?>
                <?php } ?>   
                <?php } ?>         
     </ul>
	<div id="header">
    
        <h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
                
        <h2 class="description"><?php bloginfo('description'); ?></h2>
                
        

	</div><!-- /#header  -->