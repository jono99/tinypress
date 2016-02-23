<?php


	/*==========  SVG  ==========*/
	
		/* get */
		function svg($file) {
			require(TEMPLATEPATH.'/images/svg/'.$file.'.svg');
		}
		function get_svg($file) {
			return file_get_contents($file);
		}

		/* allow */
		function cc_mime_types( $mimes ){
			$mimes['svg'] = 'image/svg+xml';
			return $mimes;
		}
		add_filter( 'upload_mimes', 'cc_mime_types' );



	/*==========  Tiled Gallery Widths  ==========*/
		
		if ( !isset( $content_width ))
			$content_width = 970;

	
	/*==========  User Info  ==========*/
	
	
		if (is_user_logged_in()) {
			global $current_user;
			get_currentuserinfo();
			define('USERID', $current_user->ID);
		}


	/*==============================================
	=            Advanced Custom Fields            =
	==============================================*/
	
		/*==========  Move menu item to top right menu  ==========*/
					
			if (USERID == '1') {
				function custom_field_menubar() {
				    global $wp_admin_bar;
				
				    $wp_admin_bar->add_menu( array(
				        'parent' => 'my-account-with-avatar',
				        'id' => 'custom_field_stuff',
				        'title' => __('CF'),
				        'href' => admin_url( 'edit.php?post_type=acf-field-group')
				    ) );
				}
				add_action( 'wp_before_admin_bar_render', 'custom_field_menubar' );
			}

			add_filter('acf/settings/path', 'my_acf_settings_path');
			function my_acf_settings_path( $path ) {
			    $path = get_stylesheet_directory() . '/includes/functions/advanced-custom-fields-pro/';
			    return $path;
			}
			 
			add_filter('acf/settings/dir', 'my_acf_settings_dir');
			function my_acf_settings_dir( $dir ) {
			    $dir = get_stylesheet_directory_uri() . '/includes/functions/advanced-custom-fields-pro/';
			    return $dir;
			}
			//add_filter('acf/settings/show_admin', '__return_false');
	
			get_template_part('includes/functions/advanced-custom-fields-pro/acf');


		/*==========  Options Page  ==========*/
				
			$global_themename = array_reverse(explode('/', get_bloginfo('template_directory')));
			$page = acf_add_options_page(array(
				'page_title' 	=> get_bloginfo('name').' Settings',
				'menu_title' 	=> get_bloginfo('name'),
				'menu_slug' 	=> $global_themename[0].'-settings',
				'icon_url' => get_field('favicon', 'option')
			));
			
	/*-----  End of Advanced Custom Fields  ------*/


	/*==========  Get Sections  ==========*/
	

		

	/*==========  Hide Admin Bar  ==========*/	

		add_filter( 'show_admin_bar', '__return_false' );


	/*==========  Thumbnail Support  ==========*/
	
		add_theme_support( 'post-thumbnails' );


	/*==========  Register Menus  ==========*/

		if ( function_exists( 'register_nav_menus' ) ) {
			register_nav_menus(
				array(
				  'topmenu' => 'Main Menu',
				)
			);
		}


	/*==========  Excerpts  ==========*/	

		function custom_excerpt($count, $syntax) {
			$return = get_the_content($id);
			$return = preg_replace('`\[[^\]]*\]`','',$return);
			$return = strip_tags($return);
			$return = substr($return, 0, $count);
			$return = substr($return, 0, strripos($return, " "));
			$return = $return.$syntax;
			return $return;
		}

	/*==========  Register Sidebars  ==========*/	

		register_sidebar(array(
			'name'=>'Sidebar',
			'before_widget' => '<div class="widget %s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>',
		));