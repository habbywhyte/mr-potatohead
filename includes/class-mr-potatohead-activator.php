<?php

/**
 * Fired during plugin activation
 *
 * @link       webdesignbyhabby.com
 * @since      1.0.0
 *
 * @package    Mr_Potatohead
 * @subpackage Mr_Potatohead/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mr_Potatohead
 * @subpackage Mr_Potatohead/includes
 * @author     Habby Whyte <bahybaj@hotmail.com>
 */
class Mr_Potatohead_Activator
{

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate()
    {
        if (current_user_can('activate_plugins')) {
            $settings = new Mr_Potatohead_Settings();
            $settings->add_option_defaults();
        }

    }
}
