<?php
add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );
/**
 * Init plugin options to white list our options
 */
function theme_options_init(){
	register_setting( 'scratch_options', 'scratch_theme_options', 'theme_options_validate' );
}

/**
 * Load up the menu page
 */
function theme_options_add_page() {
	add_theme_page( __( 'Scratch Theme Options' ), __( 'Scratch Theme Options' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}



/**
 * Create arrays for our select and radio options
 */
$nav_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'Pages' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'Categories' )
	)
	
);

$layout_options = array(
	'0' => array(
		'value' =>	'0',
		'label' => __( 'List' )
	),
	'1' => array(
		'value' =>	'1',
		'label' => __( 'Grid' )
	)
);

/**
 * Create the options page
 */
function theme_options_do_page() {
	global $nav_options, $layout_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;

	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'scratch_options' ); ?>
           
			<?php $options = get_option( 'scratch_theme_options' ); ?>
         

			<table class="form-table">
            <tr valign="top" >
            <th scope="row"><?php _e( 'Page Background' ); ?></th>
            	<td>To change the background image and color, Use the <a href="?page=custom-background">Background Option Page</a></td>
            </tr>

				<?php
				/**
				 *  Layout CHECKBOK option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Disable layout.css' ); ?></th>
					<td>
						<input id="scratch_theme_options[layout_style]" name="scratch_theme_options[layout_style]" type="checkbox" value="1" <?php checked( '1', $options['layout_style'] ); ?> />
						<label class="description" for="scratch_theme_options[layout_style]"><?php _e( 'Check this box to remove the default layout.css stylesheet. (add your own styles to style.css) ' ); ?></label>
					</td>
				</tr>
                
				<?php
				/**
				 * Reset Layout CHECKBOX option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Disable reset.css' ); ?></th>
					<td>
						<input id="scratch_theme_options[reset_style]" name="scratch_theme_options[reset_style]" type="checkbox" value="1" <?php checked( '1', $options['reset_style'] ); ?> />
						<label class="description" for="scratch_theme_options[reset_style]"><?php _e( 'Check this box to remove the reset.css stylesheet' ); ?></label>
					</td>
				</tr>
                <?php
				/**
				 * LAYOUT TYPE  SELECT input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Home and Archive Layout' ); ?></th>
					<td>
						<select name="scratch_theme_options[layout_type]">
							<?php
								$selected = $options['layout_type'];
								$p = '';
								$r = '';

								foreach ( $layout_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="scratch_theme_options[layout_type]"><?php _e( 'Choose how lists of posts will be displayed. This option works only if layout.css is enabled. ' ); ?></label>
					</td>
				</tr>
                
                <?php
				/**
				 * number of home posts SELECT option
				 */
				?>
                <tr valign="top"><th scope="row"><?php _e( 'Home page posts' ); ?></th>
					<td>
						<input id="scratch_theme_options[home_posts]" style="width:50px;" type="text" name="scratch_theme_options[home_posts]" value="<?php esc_attr_e( $options['home_posts'] ); ?>" />
						<label class="description" for="scratch_theme_options[home_posts]"><?php _e( 'Number of posts to show on the home page - default is 4' ); ?></label>
					</td>
				</tr>
                 <?php
				/**
				 * Read More Text INPUT FIELD
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Read More... Text' ); ?></th>
					<td>
						<input id="scratch_theme_options[read_more]" style="width:100px;" type="text" name="scratch_theme_options[read_more]" value="<?php esc_attr_e( $options['read_more'] ); ?>" />
						<label class="description" for="scratch_theme_options[read_more]"><?php _e( 'Text to appear after excerpts. default is "More"' ); ?></label>
					</td>
				</tr>
                <?php
				/**
				 * header Color INPUT FIELD
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header Text Color' ); ?></th>
					<td>
						<input id="scratch_theme_options[header_color]" style="width:100px;" type="text" name="scratch_theme_options[header_color]" value="<?php esc_attr_e( $options['header_color'] ); ?>" />
						<label class="description" for="scratch_theme_options[header_color]"><?php _e( 'Color of the header text - default: <span style="color:#000;">#000000</span>' ); ?></label>
					</td>
				</tr>
                  <?php
				/**
				 * header Link Color INPUT FIELD
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Navigation Link Color' ); ?></th>
					<td>
						<input id="scratch_theme_options[header_link_color]" style="width:100px;" type="text" name="scratch_theme_options[header_link_color]" value="<?php esc_attr_e( $options['header_link_color'] ); ?>" />
						<label class="description" for="scratch_theme_options[header_link_color]"><?php _e( 'Color of the top Navigation Links - default: <span style="color:#000;">#000000</span>' ); ?></label>
					</td>
				</tr>
                 <?php
				/**
				 * Nav Bar Background Color INPUT FIELD
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Navigation Bar Color' ); ?></th>
					<td>
						<input id="scratch_theme_options[header_bar_color]" style="width:100px;" type="text" name="scratch_theme_options[header_bar_color]" value="<?php esc_attr_e( $options['header_bar_color'] ); ?>" />
						<label class="description" for="scratch_theme_options[header_bar_color]"><?php _e( 'Background Color of the top Navigation Bar - default:<span style="background-color:#EEE;"> #EEEEEE </span>' ); ?></label>
					</td>
				</tr>
                


				<?php
				/**
				 * Body Color INPUT FIELD
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Body Text Color' ); ?></th>
					<td>
						<input id="scratch_theme_options[body_color]" style="width:100px;" type="text" name="scratch_theme_options[body_color]" value="<?php esc_attr_e( $options['body_color'] ); ?>" />
						<label class="description" for="scratch_theme_options[body_color]"><?php _e( 'Color of the body text - default: <span style="color:#000;">#000000</span>' ); ?></label>
					</td>
				</tr>
                <?php
				/**
				 * link Color INPUT FIELD
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Link Color' ); ?></th>
					<td>
						<input id="scratch_theme_options[link_color]" style="width:100px;" type="text" name="scratch_theme_options[link_color]" value="<?php esc_attr_e( $options['link_color'] ); ?>" />
						<label class="description" for="scratch_theme_options[link_color]"><?php _e( 'Color of  Links - default: <span style="color:#06C;">#0066CC</span>' ); ?></label>
					</td>
				</tr>


				<?php
				/**
				 * top Navigation  SELECT input option
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Main Navigation' ); ?></th>
					<td>
						<select name="scratch_theme_options[nav_type]">
							<?php
								$selected = $options['nav_type'];
								$p = '';
								$r = '';

								foreach ( $nav_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="scratch_theme_options[nav_type]"><?php _e( 'Choose whether the top navigation bar is populated by pages or categories. Creating and assigning a <a href="nav-menus.php">Custom Menu</a> will override this.' ); ?></label>
					</td>
				</tr>

			

				<?php
				/**
				 *  header TEXTAREA
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header Additions' ); ?></th>
					<td>
						<label class="description" for="scratch_theme_options[header_stuff]"><?php _e( 'Add any text to the head element of the page' ); ?></label>
                        <textarea id="scratch_theme_options[header_stuff]" class="large-text" cols="50" rows="10" name="scratch_theme_options[header_stuff]"><?php echo stripslashes( $options['header_stuff'] ); ?></textarea>
						
					</td>
				</tr>
                <?php
				/**
				 *  header TEXTAREA
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Footer Additions' ); ?></th>
					<td>
						<label class="description" for="scratch_theme_options[footer_stuff]"><?php _e( 'Add any text just before the body element closes' ); ?></label>
						<textarea id="scratch_theme_options[footer_stuff]" class="large-text" cols="50" rows="10" name="scratch_theme_options[footer_stuff]"><?php echo stripslashes( $options['footer_stuff'] ); ?></textarea>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options' ); ?>" />
			</p>
		</form>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function theme_options_validate( $input ) {
	global $nav_options, $radio_options;

	// Our checkbox value is either 0 or 1
	if ( ! isset( $input['layout_style'] ) )
		$input['layout_style'] = null;
	$input['layout_style'] = ( $input['layout_style'] == 1 ? 1 : 0 );
	
	if ( ! isset( $input['reset_style'] ) )
		$input['reset_style'] = null;
	$input['reset_style'] = ( $input['reset_style'] == 1 ? 1 : 0 );
// Say our text option must be safe text with no HTML tags
	$input['read_more'] = wp_filter_nohtml_kses( $input['read_more'] );
	// Say our text option must be safe text with no HTML tags
	$input['body_color'] = wp_filter_nohtml_kses( $input['body_color'] );
	// Say our text option must be safe text with no HTML tags
	$input['link_color'] = wp_filter_nohtml_kses( $input['link_color'] );
	// Say our text option must be safe text with no HTML tags
	$input['header_color'] = wp_filter_nohtml_kses( $input['header_color'] );
	// Say our text option must be safe text with no HTML tags
	$input['header_bar_color'] = wp_filter_nohtml_kses( $input['header_bar_color'] );
	// Say our text option must be safe text with no HTML tags
	$input['header_link_color'] = wp_filter_nohtml_kses( $input['header_link_color'] );

	// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['nav_type'], $nav_options ) )
		$input['nav_type'] = null;
			// Our select option must actually be in our array of select options
	if ( ! array_key_exists( $input['layout_type'], $nav_options ) )
		$input['layout_type'] = null;

	// Say our textarea option must be safe text with the allowed tags for posts
	$input['header_stuff'] = wp_filter_post_kses( $input['header_stuff'] );
		// Say our textarea option must be safe text with the allowed tags for posts
	$input['footer_stuff'] = wp_filter_post_kses( $input['footer_stuff'] );
	// number of home posts must be a number greater than 0
	$input['home_posts'] = intval( $input['home_posts'] );
	if($input['home_posts'] <= 0){
		$input['home_posts'] = 4;
	}

	return $input;
}

// adapted from http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/