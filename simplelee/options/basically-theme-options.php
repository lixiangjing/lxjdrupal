<?php
/* =============================================================================
Enqueue Script & Style
============================================================================== */
function Basically_admin_enqueue_script( $hook_suffix ) {
	/* Enqueue Style */
	wp_enqueue_style( 'Basically-options-style', get_template_directory_uri() . '/options/style/admin.css', false, '1.0.0');
	wp_enqueue_style( 'Basically-jqueryui-tabs-style', get_template_directory_uri() . '/options/style/jquery.ui.tabs.css', false, '1.8.16');
	wp_enqueue_style('thickbox');
	
	/* Register Script */
	wp_register_script('Basically_my-upload', get_template_directory_uri().'/options/js/theme-options.js', array('jquery','media-upload','thickbox'));
	
	/* Enqueue Script */
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('Basically_my-upload');
	wp_enqueue_script('jquery-ui-tabs');

}
add_action( 'admin_print_styles-appearance_page_theme_options', 'Basically_admin_enqueue_script' );

function Basically_theme_options_init() {

	if ( false === Basically_get_theme_options() )
		add_option( 'Basically_theme_options', Basically_get_default_theme_options() );

	register_setting(
		'Basically_options',
		'Basically_theme_options',
		'Basically_theme_options_validate'
	);
}
add_action( 'admin_init', 'Basically_theme_options_init' );

function Basically_option_page_capability( $capability ) {
	return 'edit_theme_options';
}
add_filter( 'option_page_capability_Basically_options', 'Basically_option_page_capability' );

function Basically_theme_options_add_page() {
	$theme_page = add_theme_page(
		__( 'Basically Theme Options', 'basically' ),
		__( '定制', 'basically' ),
		'edit_theme_options',
		'theme_options',
		'Basically_theme_options_render_page'
	);
}
add_action( 'admin_menu', 'Basically_theme_options_add_page' );

function Basically_color_schemes() {
	$color_scheme_options = array(
		'Default' => array(
			'value' => 'Default',
			'label' => __( 'Default', 'basically' ),
		),
		'Black' => array(
			'value' => 'Black',
			'label' => __( 'Black', 'basically' ),
		),
		'Brown' => array(
			'value' => 'Brown',
			'label' => __( 'Brown', 'basically' ),
		),
		'Green' => array(
			'value' => 'Green',
			'label' => __( 'Green', 'basically' ),
		),
		'Grey' => array(
			'value' => 'Grey',
			'label' => __( 'Grey', 'basically' ),
		),
		'Orange' => array(
			'value' => 'Orange',
			'label' => __( 'Orange', 'basically' ),
		),
		'Pink' => array(
			'value' => 'Pink',
			'label' => __( 'Pink', 'basically' ),
		),
		'Purple' => array(
			'value' => 'Purple',
			'label' => __( 'Purple', 'basically' ),
		),
		'Red' => array(
			'value' => 'Red',
			'label' => __( 'Red', 'basically' ),
		),
	);

	return apply_filters( 'Basically_color_schemes', $color_scheme_options );
}

function Basically_select() {
	$select_option = array(
		'Yes' => array(
			'value' => 'Yes',
			'label' => __( 'Yes', 'basically' ),
		),
		'No' => array(
			'value' => 'No',
			'label' => __( 'No', 'basically' ),
		),
	);
	
	return apply_filters( 'Basically_select', $select_option );
}

function Basically_layouts() {
	$layout_options = array(
		'right-sidebar' => array(
			'value' => 'right-sidebar',
			'label' => __('Content on left', 'basically'),
			'thumbnail' => get_template_directory_uri() . '/options/images/content-sidebar.png',
		),
		'left-sidebar' => array(
			'value' => 'left-sidebar',
			'label' => __('Content on right', 'basically'),
			'thumbnail' => get_template_directory_uri() . '/options/images/sidebar-content.png',
		),
		'one-column' => array(
			'value' => 'one-column',
			'label' => __('One-column - no sidebar', 'basically'),
			'thumbnail' => get_template_directory_uri() . '/options/images/content.png',
		),
	);

	return apply_filters( 'Basically_layouts', $layout_options );
}

function Basically_font_stack() {
	$font_stack_options = array(
		'Arial' => array(
			'value' => 'Arial',
			'label' => 'Arial',
		),
		'Yahei' => array(
			'value' => 'Yahei',
			'label' => 'Yahei',
		),
		'Georgia' => array(
			'value' => 'Georgia',
			'label' => 'Georgia',
		),
		'Verdana' => array(
			'value' => 'Verdana',
			'label' => 'Verdana',
		),
		'Helvetica Neue' => array(
			'value' => 'Helvetica Neue',
			'label' => 'Helvetica Neue',
		),
		'Tahoma' => array(
			'value' => 'Tahoma',
			'label' => 'Tahoma',
		),
		'Times New Roman' => array(
			'value' => 'Times New Roman',
			'label' => 'Times New Roman',
		),
		'Trebuchet MS' => array(
			'value' => 'Trebuchet MS',
			'label' => 'Trebuchet MS',
		),
	);

	return apply_filters( 'Basically_font_stack', $font_stack_options );
}

function Basically_get_default_theme_options() {
	$default_theme_options = array(
		'color_scheme' => 'Default',
		'secondary_navigation' => 'Yes',
		'hide_title' => 'No',
		'theme_layout' => 'right-sidebar',
		'font_stack' => 'Georgia',
	);

	return apply_filters( 'Basically_default_theme_options', $default_theme_options );
}

function Basically_get_theme_options() {
	return get_option( 'Basically_theme_options', Basically_get_default_theme_options() );
}

function Basically_theme_options_render_page() {
	?>
	<div class="wrap">
		<?php screen_icon(); ?>
		<h2><?php printf( __( '%s Theme Options', 'Basically' ), get_current_theme() ); ?></h2>
		<?php settings_errors(); ?>
			
		<form method="post" action="options.php" id="options">
			<?php
				settings_fields( 'Basically_options' );
				$options = Basically_get_theme_options();
				$default_options = Basically_get_default_theme_options();
			?>
			
		<div id="theme-options">
			
			<ul>
				<li><a href="#options1"><?php _e('General Options', 'basically'); ?></a></li>
				<li><a href="#options2"><?php _e('Layout Options', 'basically'); ?></a></li>
				<li><a href="#options3"><?php _e('Ads Options', 'basically'); ?></a></li>
			</ul>
			
			<table id="options1" class="form-table">
			
			<!-- Custom Header -->
			<tr valign="top">
				<th scope="row"><?php _e('Upload Custom Header:', 'rumputhijau'); ?></th>
					<td><?php printf( __('If you want to upload your custom header. Please <a href="%1$s">Go to this page</a>', 'rumputhijau'), admin_url('themes.php?page=custom-header') ); ?></td>
			</tr>
			
			<!-- Custom Background -->
			<tr valign="top">
				<th scope="row"><?php _e('Custom Background:', 'rumputhijau'); ?></th>
					<td><?php printf( __('If you want to change the background color or want to upload your background image. Please <a href="%1$s">Go to this page</a>', 'rumputhijau'), admin_url('themes.php?page=custom-background') ); ?></td>
			</tr>
			
			<!-- Custom Menus -->
			<tr valign="top">
				<th scope="row"><?php _e('Custom Menus :', 'rumputhijau'); ?></th>
					<td><?php printf( __('Easily add, edit and delete your menus using custom menus. Please <a href="%1$s">Go to this page</a> to setup your menus', 'rumputhijau'), admin_url('nav-menus.php') ); ?></td>
			</tr>
			
			<!-- Logo -->
			<tr valign="top">
				<th scope="row"><?php _e('Upload Logo:', 'basically'); ?></th>
				<td>
					<?php $l = isset($options['logo'])? $options['logo']: ''; ?>
					<input id="Basically_theme_options[logo]" class="regular-text logo" type="text" name="Basically_theme_options[logo]" value="<?php esc_attr_e( $l ); ?>" />
					<input class="upload_image_button" type="button" value="Upload Logo" />
					<label for="logo">
					<?php 
					if($l == "") { 
					echo "<br /><em>" .__('Enter the URL or upload an image for the <strong>Logo</strong>', 'basically'). "</em>"; 
					} else {
					echo "<img style='clear:both;display:block;margin-top:10px;'";
					echo 'src="'.$l.'" />';
					} ?>
					</label>
				</td>
			</tr>
			
			<!-- Favicon -->
			<tr valign="top">
			<th scope="row"><label for="favicon"><?php _e('Upload Favicon :', 'basically'); ?></label></th>
			<td>
				<?php $fav = isset($options['favicon'])? $options['favicon']: ''; ?>
				<input id="Basically_theme_options[favicon]" class="regular-text favicon" type="text" name="Basically_theme_options[favicon]" value="<?php esc_attr_e( $fav ); ?>" />
				<input class="upload_favicon_button" type="button" value="Upload Favicon" />
				<label for="favicon">
					<?php
					if($fav == "") { 
					echo "<br /><em>" .__('Enter the URL or upload an image for the <strong>Favicon</strong>', 'basically'). "</em>"; 
					} else {
					echo "<img style='clear:both;display:block;margin-top:10px;'";
					echo 'src="'.$fav.'" />';
					} ?>
				</label>
			</td>
			</tr>
			
			<!-- Hide Title -->
			<tr valign="top"><th scope="row"><?php _e('Hide Site Title :', 'basically'); ?></th>
				<td>
				
				<select name="Basically_theme_options[hide_title]">
				<?php
					foreach ( Basically_select() as $hide ) {
				?>
				<option <?php selected ( $options['hide_title'], $hide['value'] ); ?>><?php echo esc_attr( $hide['value'] ); ?></option>
				<?php } ?>
				</select>
				<br /><label><em><?php _e('If you want to hide the site title & description, choose Yes.', 'basically'); ?></em></label>
				</td>
			</tr>
			
			<!-- Show Secondary Navigation -->
			<tr valign="top"><th scope="row"><?php _e('Show secondary navigation ? :', 'basically'); ?></th>
				<td>
				
				<select name="Basically_theme_options[secondary_navigation]">
				<?php
					foreach ( Basically_select() as $secondary ) {
				?>
				<option <?php selected ( $options['secondary_navigation'], $secondary['value'] ); ?>><?php echo esc_attr( $secondary['value'] ); ?></option>
				<?php } ?>
				</select>
				<br /><label><em><?php _e('If you want to show secondary navigation, choose Yes.', 'basically'); ?></em></label>
				</td>
			</tr>
			
			<!-- Header Script -->
			<tr valign="top"><th scope="row"><?php _e('Header Script :', 'basically'); ?></th>
				<td>
					<?php $headscript = isset($options['header-script'])? $options['header-script']: ''; ?>
					<textarea id="Basically_theme_options[header-script]" class="large-text" cols="50" rows="10" name="Basically_theme_options[header-script]"><?php echo esc_textarea( $headscript ); ?></textarea>
					<label class="description" for="Basically_theme_options[header-script]"><em><?php _e('If you need to add scripts to your header (like meta tag verification, perhaps), you should enter them in the box above. They will be added before &lt;/head&gt; tag', 'basically'); ?></em></label>
				</td>
			</tr>
			
			<!-- Tracking Code -->
			<tr valign="top"><th scope="row"><?php _e('Tracking Code :', 'basically'); ?></th>
				<td>
					<?php $tracking = isset($options['tracking-script'])? $options['tracking-script']: ''; ?>
					<textarea id="Basically_theme_options[tracking-script]" class="large-text" cols="50" rows="10" name="Basically_theme_options[tracking-script]"><?php echo esc_textarea( $tracking ); ?></textarea>
					<label class="description" for="Basically_theme_options[tracking-script]"><em><?php _e('Put your tracking script here. Such as google analytic script, they will be added before &lt;/body&gt; tag', 'basically'); ?></em></label>
				</td>
			</tr>
			
			</table>
				
			<table id="options2" class="form-table">
				
				<!-- Color Scheme -->
				<tr valign="top"><th scope="row"><?php _e('Color Scheme:', 'basically'); ?></th>
					<td>
					
					<select name="Basically_theme_options[color_scheme]">
					<?php
						foreach ( Basically_color_schemes() as $scheme ) {
					?>
					<option <?php selected ( $options['color_scheme'], $scheme['value'] ); ?>><?php echo esc_attr( $scheme['value'] ); ?></option>
					<?php } ?>
					</select>
					</td>
				</tr>
				
				<!-- Font- Stack -->
				<tr valign="top"><th scope="row"><?php _e('Font Stack:', 'basically'); ?></th>
					<td>
					
					<select name="Basically_theme_options[font_stack]">
					<?php
						foreach ( Basically_font_stack() as $font ) {
					?>
					<option <?php selected ( $options['font_stack'], $font['value'] ); ?>><?php echo esc_attr( $font['value'] ); ?></option>
					<?php } ?>
					</select>
					<label class="font_stack" for="Basically_theme_options[font_stack]"><em><?php _e('Default: Georgia', 'basically'); ?></em></label>
					</td>
				</tr>
					
				<!-- Theme layout -->
				<tr valign="top"><th scope="row"><?php _e('Theme Layout :', 'basically'); ?></th>
					<td>
					
					<?php
						foreach ( Basically_layouts() as $layout ) {
					?>
					<span class="layouts">
					
						<input class="choose-layout" type="radio" name="Basically_theme_options[theme_layout]" value="<?php echo esc_attr( $layout['value'] ); ?>" <?php checked( $options['theme_layout'], $layout['value'] ); ?> />
						<span>
							<img class="thumbnail-layout" src="<?php echo esc_url( $layout['thumbnail'] ); ?>" width="136" height="122" alt="" />
						</span>
						
					</span>
					<?php } ?>
					
					</td>
				</tr>
				
				
				
			</table>
			
			<table id="options3" class="form-table">
			
			<!-- Header Script -->
			<tr valign="top"><th scope="row"><?php _e('468x60 Header Ad :', 'basically'); ?></th>
				<td>
					<?php $headerad = isset($options['header-ads'])? $options['header-ads']: ''; ?>
					<textarea id="Basically_theme_options[header-ads]" class="large-text" cols="50" rows="10" name="Basically_theme_options[header-ads]"><?php echo esc_textarea( $headerad ); ?></textarea>
					<label class="description" for="Basically_theme_options[header-ads]"><em><?php _e('Put your ads code here. The ads will be added in header.', 'basically'); ?></em></label>
				</td>
			</tr>
			
			<!-- Header Script -->
			<tr valign="top"><th scope="row"><?php _e('Single Post Ads <em>(below post title)</em> :', 'basically'); ?></th>
				<td>
					<?php $singletop = isset($options['single-ads-top'])? $options['single-ads-top']: ''; ?>
					<textarea id="Basically_theme_options[single-ads-top]" class="large-text" cols="50" rows="10" name="Basically_theme_options[single-ads-top]"><?php echo esc_textarea( $singletop ); ?></textarea>
					<label class="description" for="Basically_theme_options[single-ads-top]"><em><?php _e('Put your ads code here. The ads will be added below post title in single post.', 'basically'); ?></em></label>
				</td>
			</tr>
			
			<!-- Header Script -->
			<tr valign="top"><th scope="row"><?php _e('Single Post Ads <em>(below post content)</em> :', 'basically'); ?></th>
				<td>
					<?php $singlebottom = isset($options['single-ads-bottom'])? $options['single-ads-bottom']: ''; ?>
					<textarea id="Basically_theme_options[single-ads-bottom]" class="large-text" cols="50" rows="10" name="Basically_theme_options[single-ads-bottom]"><?php echo esc_textarea( $singlebottom ); ?></textarea>
					<label class="description" for="Basically_theme_options[single-ads-bottom]"><em><?php _e('Put your ads code here. The ads will be added below post content in single post.', 'basically'); ?></em></label>
				</td>
			</tr>
			
			</table>
			

			<?php submit_button(); ?>
			
			
			</div><!-- end #theme-options -->
		</form>
		
		<div id="admin_side">



		</div>
		
	</div>
	<?php
}

function Basically_theme_options_validate( $input ) {
	$output = $defaults = Basically_get_default_theme_options();

	if ( isset( $input['color_scheme'] ) && array_key_exists( $input['color_scheme'], Basically_color_schemes() ) )
		$output['color_scheme'] = $input['color_scheme'];
		
	if ( isset( $input['font_stack'] ) && array_key_exists( $input['font_stack'], Basically_font_stack() ) )
		$output['font_stack'] = $input['font_stack'];
		
	$output['logo'] = esc_url($input['logo']);
	
	$output['favicon'] = esc_url($input['favicon']);
	
	if ( isset( $input['secondary_navigation'] ) && array_key_exists( $input['secondary_navigation'], Basically_select() ) )
		$output['secondary_navigation'] = $input['secondary_navigation'];
		
	if ( isset( $input['hide_title'] ) && array_key_exists( $input['hide_title'], Basically_select() ) )
		$output['hide_title'] = $input['hide_title'];
		
	if ( isset( $input['theme_layout'] ) && array_key_exists( $input['theme_layout'], Basically_layouts() ) )
		$output['theme_layout'] = $input['theme_layout'];
		
	$output['header-script'] = stripslashes($input['header-script']);
	
	$output['tracking-script'] = stripslashes($input['tracking-script']);
	
	$output['header-ads'] = stripslashes($input['header-ads']);
	
	$output['single-ads-top'] = stripslashes($input['single-ads-top']);
	
	$output['single-ads-bottom'] = stripslashes($input['single-ads-bottom']);

	return apply_filters( 'Basically_theme_options_validate', $output, $input, $defaults );
}