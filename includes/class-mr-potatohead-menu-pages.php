<?php

/**
 * Created by PhpStorm.
 * User: weskempferjr
 * Date: 12/5/15
 * Time: 10:43 PM
 */
class Mr_Potatohead_Menu_Pages {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */


	public function __construct() {

	}

	public function admin_menu_pages(){
		// Add the top-level admin menu
		$page_title = 'Mr Potatohead Plugin Setings';
		$menu_title = 'Mr Potatohead';
		$capability = 'manage_options';
		$menu_slug = 'mr-potatohead-settings';
		$function = 'mr_potatohead_settings';

		$mrp_settings = new Mr_Potatohead_Settings();

		add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($mrp_settings, 'settings_page')) ;

		// Add submenu page with same slug as parent to ensure no duplicates
		$sub_menu_title = 'Settings';
		add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, array( $mrp_settings, 'settings_page'));


		// Now add the submenu page for Help
		$submenu_page_title = 'Mr_Potatohead Reports';
		$submenu_title = 'Reports';
		$submenu_slug = 'mr-potatohead-reports';
		$submenu_function = 'mr_potatohead_reports';
		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, array($this,$submenu_function));


	}

	public function mr_potatohead_settings() {
		$mrp_settings = new Mr_Potatohead_Settings();
		$mrp_settings->settings_init();
	}

	public function mr_potatohead_reports() {

		echo '<div class="wrap">';
		echo '<h2 class="mrp-report-heading">' . __('Corvomap Reports', GUESTABA_CMP_TEXTDOMAIN ) . '</h2>';

		echo '<h3 class="mrp-report-subheading">' . __('Proposals Ranked by Support', GUESTABA_CMP_TEXTDOMAIN ) . '</h3>';
		$maps = Maps_Post_Type::get_all_maps();

		_e('Select a map ',GUESTABA_CMP_TEXTDOMAIN);

		$output = '<div class="mrp-report-map-select-container" id="mrp-report-map-select-container">';
		$output .= '<select class="mrp-report-map-select">';
		$output .= '<option value=""></option>';
		foreach ( $maps as $map ) {
			$output .= '<option value="'.  $map['id'] . '">' . $map['title'] .  '</option>';
		}

		$output .= '</select>';
		$output .= '</div>';
		$output .= '<div class="mrp-report-export-btn-container"><input class="button-secondary" id="mrp-report-export-btn" type="button" value="' . __('Export', GUESTABA_CMP_TEXTDOMAIN) . '" disabled></div>';
		$output .= '<div class="mrp-report-reset-btn-container"><input class="button-secondary" id="mrp-report-reset-btn" type="button" value="' . __('Reset', GUESTABA_CMP_TEXTDOMAIN) . '" disabled></div>';
		$output .= '<div id="mrp-spinner"></div>';
		$output .= '<div class="mrp-report-output" id="mrp-report-output"></div>';
		$output .= '<iframe id="mrp-download-iframe" style="display:none;"></iframe>';
		$output .= '</div>';

		echo $output;
	}


}