<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://catchplugins.com
 * @since      1.0.0
 *
 * @package    Essential_Widgets
 * @subpackage Essential_Widgets/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Essential_Widgets
 * @subpackage Essential_Widgets/admin
 * @author     Catch Plugins <info@catchplugins.com>
 */
class Essential_Widgets_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Essential_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Essential_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/essential-widgets-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Essential_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Essential_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/essential-widgets-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Catch Instagram Feed Gallery Widget: action_links
	 * Catch Instagram Feed Gallery Widget Settings Link function callback
	 *
	 * @param arrray $links Link url.
	 *
	 * @param arrray $file File name.
	 */
	public function action_links( $links, $file ) {
		if ( $file === $this->plugin_name . '/' . $this->plugin_name . '.php' ) {
			$settings_link = '<a href="' . esc_url( admin_url( 'admin.php?page=essential_widgets' ) ) . '">' . esc_html__( 'Settings', 'essential-widgets' ) . '</a>';

			array_unshift( $links, $settings_link );
		}
		return $links;
	}

	/**
	 * Catch Instagram Feed Gallery Widget: add_plugin_settings_menu
	 * add Catch Instagram Feed Gallery Widget to menu
	 */
	public function add_plugin_settings_menu() {
		add_menu_page(
			esc_html__( 'Essential Widgets', 'essential-widgets' ),
			esc_html__( 'Essential Widgets', 'essential-widgets' ),
			'manage_options',
			'essential_widgets',
			array( $this, 'settings_page' ),
			'',
			'99.01564'
		);
	}

	/**
	 * Catch Instagram Feed Gallery Widget: catch_web_tools_settings_page
	 * Catch Instagram Feed Gallery Widget Setting function
	 */
	public function settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.' ) );
		}

		require plugin_dir_path( __FILE__ ) . 'partials/essential-widgets-admin-display.php';
	}

	/**
	 * Catch Instagram Feed Gallery Widget: register_settings
	 * Catch Instagram Feed Gallery Widget Register Settings
	 */
	public function register_settings() {
		register_setting(
			'essential-widgets-group',
			'essential_widgets_options',
			array( $this, 'sanitize_callback' )
		);
	}


}
