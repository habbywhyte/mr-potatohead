<?php 

/**
 * This class defines and maintains access to the plugin 
 * settings. 
 * 
 * @link       http://webdesignbyhabby.com
 * @since      1.0.0
 * @package    Mr_Potatohead
 * @subpackage Mr_Potatohead/includes
 * @author     Habby Whyte <bahybaj@hotmail.com>
 */
class Mr_Potatohead_Settings {
	
	
	/*
	 * Sets the name of plugin option.
	 */
	private $options_name = MR_POTATOHEAD_OPTIONS_NAME;
	
	/*
	 * Default values for plugin options are defined here. 
	 * These values are recorded in wp_option at activation time. 
	 * 
	 */
	private $default_use_widget_area = false;
	private $default_remove_data_on_uninstall = false;
	private $version = GUESTABA_CORVOMAP_VERSION_NUM ;
	
	/**
	 * Constructor
	 * 
	 * @since 1.0.0
	 */
	public function __construct() {

	}
	
	
	/*
	 * Get the plugin option name. 
	 * 
	 * @return string plugin option name.
	 */
	public function get_options_name() {
		return $this->options_name;
	}
	
	
	/*
	 * This function is called at activation time and by the constructor. It records
	 * the plugin settings default values in the wp_options table. 
	 * If the plugin options already exist in the database, they 
	 * are not overwritten. 
	 * 
	 * @since 1.0.0
	 */
	public function add_option_defaults() {
		
		if ( current_user_can('activate_plugins') ) {	
			$options = array();
			$options['remove_data_on_uninstall'] = $this->default_remove_data_on_uninstall;
			$options['version'] = $this->version ;
			$options['default_potato_image'] = plugin_dir_url() . 'mr-potatohead' . '/' . 'public/images/raw_potato.png';
            $options['default_potato_background'] = '#FFFFFF';



            add_option( $this->options_name, $options );
		}
		
	}




	/*
	 * This function was intended to be called to delete the 
	 * options from the database. 
	 * 
	 * @todo Can this delete_options() be removed. 
	 * @since 1.0.0
	 */
	
	public function delete_options() {
		if ( current_user_can('delete_plugins') ) {
			delete_option($this->options_name );			
		}
	}
	


	


	
	/*
	 * Return "remove data on uninstall" flag. If true, all
	 * data and settings associated with the plugin are to be delete.
	 * 
	 * @since 1.0.0
	 * 
	 * @param none
	 * @return boolean remove_plugin_data_on_uninstall
	 */
	public function get_remove_data_on_uninstall() {
		$option = get_option( $this->options_name);
		return $option['remove_data_on_uninstall'];
	}


	

	/*
	 * This method defines the plugin setting page. 
	 * 
	 * @since 1.0.0
	 * 
	 * @param none
	 * @return void
	 */
	public function settings_init(  ) {

		register_setting( 'mrp-settings-group', $this->options_name, array( $this, 'sanitize') );
		
		add_settings_section(
			'mrp-settings-general-section',
			__( 'Mr Potato Head General Settings', MR_POTATOHEAD_TEXTDOMAIN ),
			array($this, 'mrp_settings_general_info'),
			'mrp-settings-page'
		);		
		
		add_settings_field( 
			'mrp_remove_data_at_uninstall',
			__( 'Remove plugin posts, settings, and other data on deactivation.', MR_POTATOHEAD_TEXTDOMAIN ),
			array($this, 'mrp_remove_data_render'),
			'mrp-settings-page',
			'mrp-settings-general-section'
		);


	}
	
	/*
	 * Calls add_options_page to register the page and menu item.
	 * 
	 * @since 1.0.0
	 * 
	 * @param none
	 * @return integer map_desc_excerpt_len
	 */
	public function add_mrp_options_page( ) {

		// Add the top-level admin menu
		$page_title = 'Mr Potato Head Plugin Setings';
		$menu_title = 'Mr Potato Head';
		$capability = 'manage_options';
		$menu_slug = 'mr-potatohead-settings';
		$function = 'settings_page';
		add_options_page($page_title, $menu_title, $capability, $menu_slug, array($this, $function)) ;


	}
	
	/*
	 * Defines and displays the plugin settings page.
	 * @since 1.0.0
	 * 
	 * @param none
	 * @return none
	 */
	public function settings_page(  ) {

		$this->add_option_defaults();
	
		?>
		<div class="wrap">
		<form action='options.php' method='post'>
			
			<h2>Mr Potato Head Settings</h2>
			<div id="mrp-settings-container">
				<?php

				settings_fields( 'mrp-settings-group' );
				do_settings_sections( 'mrp-settings-page' );
				submit_button();
				?>
			</div>
			
		</form>
		</div>
		<?php

	}

	
	
	/*
	 * Render the remove data on unsinstal checkbox field. 
	 * @since 1.0.0
	 */	
	public function mrp_remove_data_render(  ) {
	
		$options = get_option( $this->options_name );
		?>
		<input id="remove_mrp_data_input" type="checkbox" name="guestaba_mrp_settings[mrp_remove_data_on_uninstall]" <?php checked( $options['mrp_remove_data_on_uninstall'], 1 ); ?> value='1'>
		<br><label for="remove_mrp_data_input"><em>Leave this unchecked unless you really want to remove the posts you have created using this plugin.</em></label>
		<?php
	
	}



	/*
	 * Sanitize user input before passing values on to update options.
	 * @since 1.0.0
	 */	
	public function sanitize( $input ) {
		
		$new_input = array();
		
		if( isset( $input['mrp_remove_data_on_uninstall'] ) ) {
        	 $new_input['mrp_remove_data_on_uninstall'] = sanitize_text_field( $input['mrp_remove_data_on_uninstall'] );
        }
        else {
        	// set to default 
        	$new_input['mrp_remove_data_on_uninstall'] = false ;
        }


		if( isset( $input['default_potato_image'] ) )
			$new_input['default_potato_image'] = sanitize_text_field( $input['default_potato_image'] );

		if( isset( $input['default_potato_background'] ) )
			$new_input['default_potato_background'] = sanitize_text_field( $input['default_potato_background'] );


		return $new_input ;
	}
	
	/*
	 * Render general settings section info. 
	 * @since 1.0.0
	 */	
	public function mrp_settings_general_info () {
		echo '<p>' . __("General settings for CorvoMap Plugin", MR_POTATOHEAD_TEXTDOMAIN) . '</p>';
	}




	/*
     * Render location/address settings section info.
     * @since 1.0.4
     */
	public function mrp_settings_address_section_info () {
		echo '<p>' . __("Address settings for location map.", MR_POTATOHEAD_TEXTDOMAIN) . '</p>';
	}



	/*
	 * Places link to settings page under the Plugins->Installed Plugins listing entry.
	 * It is intended to be called via add_filter. 
	 * 
	 * @param array $links an array of existing action links.
	 * 
	 * @return $links with 
	 * @since 1.0.0
	 */
	public function action_links( $links ) {	
	

    	return $links;
		
		
	}

	
}

?>