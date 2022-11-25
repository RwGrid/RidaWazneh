<?php 
/**
 *  Cvio Elementor Layout Builder
 *
 * @package cvio
 * @since 1.0
 */

// We check if the Elementor plugin has been installed / activated.

if( !in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) return;

class Cvio_Elementor_Widget {
 
	private static $instance = null;

	/**
	 * @since 1.0
	 */
	public static function get_instance() {
	    if ( ! self::$instance )
	       self::$instance = new self;
	    return self::$instance;
	}

	/**
	 * @since 1.0
	 */
	public function init(){
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'cvio_elementor_register_widgets' ) );
		
		add_action('elementor/frontend/after_register_styles', array($this, 'cvio_elementor_frontend_styles'), 10);
		
		add_action('elementor/frontend/after_register_scripts', array($this, 'cvio_elementor_frontend_scripts'), 10);

		add_action( 'elementor/elements/categories_registered', array( $this, 'cvio_elementor_widgets_category' ) );
	}

	/**
	 * @since 1.0
	 */
	public function cvio_elementor_register_widgets() {
		//Require all PHP files in the /elementor/widgets directory
		foreach( glob( plugin_dir_path( __FILE__ ) . "widgets/*.php" ) as $file ) {
		    require $file; 
		} 
	}

	/**
	 * @since 1.0
	 */
	public function cvio_elementor_frontend_scripts() {
		wp_enqueue_script( 'cvio-plugin-frontend-widget-scripts',  plugin_dir_url( __FILE__ ) . 'assets/js/front-end-widget.js', array('jquery'), false, true);
	}

	/**
	 * @since 1.0
	 */
	public function cvio_elementor_frontend_styles() {
		wp_enqueue_style( 'cvio-plugin-frontend-widget-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', null, 1.0 );
	}

	/**
	 * @since 1.0
	 */
	public function cvio_elementor_widgets_category( $elements_manager ) {
		$elements_manager->add_category(
			'cvio-category',
			[
				'title' => esc_html__( 'Cvio Theme', 'cvio-plugin' ),
				'icon' => 'fa fa-plug',
			]
		);  
	}
}
 
Cvio_Elementor_Widget::get_instance()->init();