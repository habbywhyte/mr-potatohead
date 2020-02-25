<?php

/**
 * 
 * 
 * @link       
 * @since      1.0.0
 * @package    Mr_Potatohead
 * @subpackage Mr_Potatohead/includes
 * @author     
 */
class Mr_Potatohead_Shortcodes {

	/* 
	 * Used to store an instance of Hospitalty_Settings
	 */
	private $settings;

	/*
	 * A list of all of the shortcodes.
	 */
	private static $shortcodes = array(
		'mr_potatohead',
		
	);


	/*
	 * Constructor
	 */

	public function __construct() {
		$this->settings = new Mr_Potatohead_Settings();
	}

	/*
	 * Called to register all shortcodes for the plugin
	 * @since 1.0.0
	 */

	public function register_shortcodes() {

		foreach ( self::$shortcodes as $shortcode ) {
			add_shortcode( $shortcode, array( $this, $shortcode ) );
		}

	}

	/*
	 * Function: get_shortcodes
	 * @return array shortcodes an array of the plugin shortcode names.
	 */

	public static function get_shortcodes() {
		return self::$shortcodes;
	}



/*
*
* @since 1.0.4
* @param array $atts
* @return string shortcode output.
*/
	public function mr_potatohead( $atts ) {

		/** @var $id string */

		$atts_actual = shortcode_atts(
			array(
				'id'   => '1'

			),
			$atts );

		extract( $atts_actual );

		$output = '';

		$options = get_option( MR_POTATOHEAD_OPTIONS_NAME) ;

		$image_path = $options['default_potato_image'];
		$output .= '<img class="mrp-image" src="' . $image_path . '">';
		return $output;
	}


	


}

?>
