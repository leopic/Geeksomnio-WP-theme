<?php
/*
 Plugin Name: WP Theme Switcher
 Description: Automatically switch Wordpress themes on the fly
 Version: 2.1
 Author: Fayçal Tirich
 Author URI: http://agafix.org
 Plugin URI: http://agafix.org/how-to-automatically-switch-wordpress-themes-onthefly/
 */

class WP_Theme_Switcher {

	public $current_theme;
	public $theme_to_apply;
	public $current_page;
	public $wpts_settings;

	public function __construct() {
		$this->current_page = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

		$current_theme_data = get_theme(get_current_theme());
		$this->current_theme = $current_theme_data["Template"];
		$this->theme_to_apply = $this->current_theme ;

		$this->wpts_settings = get_option('wp_theme_switcher_settings');
		if(!$this->wpts_settings || !is_array($this->wpts_settings)) {
			$this->wpts_settings = array();
		} else {
			$this->wpts_settings = stripslashes_deep($this->wpts_settings);
		}
	}

  public function get_theme_to_apply(){
    if (count($this->wpts_settings)){
            foreach ($this->wpts_settings as $theme => $pattern){
                if (!empty($pattern)){
                    if( preg_match("/" . preg_replace( '|/|', '\\/', $pattern ) . "/i", $this->current_page ) ) {
                        $this->theme_to_apply = $theme;
                        break;
                    }
                }
            }
      }
      return $this->theme_to_apply ;
 }

  
	public function switch_theme_when_it_has_to_be(){

		if (count($this->wpts_settings)){
		  add_filter( 'template', array(&$this, 'get_theme_to_apply') );
			add_filter( 'stylesheet', array(&$this, 'get_theme_to_apply') );
		}
	}
	
	public function add_admin_options () {
		if (function_exists('add_options_page')) {
			if( current_user_can('manage_options') ) {
				add_options_page("WP Theme Switcher", "WP Theme Switcher", 'manage_options', __FILE__, array(&$this, 'admin_options_content'));
			}
		}
	}

	public function admin_options_content () {
		include('admin_options.php');
	}
}

$wp_theme_switcher = new WP_Theme_Switcher();

add_action('setup_theme', array(&$wp_theme_switcher,'switch_theme_when_it_has_to_be'));
add_action('admin_menu', array(&$wp_theme_switcher,'add_admin_options'));

?>