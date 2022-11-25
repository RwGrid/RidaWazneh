<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if( ! class_exists( 'acf_field_cvio_ui_google_font' ) ) :

class acf_field_cvio_ui_google_font extends acf_field {
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function __construct() {
		
		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/
		
		$this->name = 'ui_google_font';
		$json = file_get_contents( plugin_dir_path( __FILE__ ) . 'webfonts.json' );

		$UM_GOOGLEFONTS = json_decode( $json, true );
		
		$none_font = array(
			"kind" => "webfonts#webfont",
			"family" => "",
			"variants" => array
			(
				0 => "",
			),
			"subsets" => array
			(
				0 => "",
			),			
			"version" => "",
		    "lastModified" => "",
		    "files" => array
		    (
		        "regular" => "",
		    ),
		    "category" => ""
		);

		array_unshift( $UM_GOOGLEFONTS['items'], $none_font );

		$this->font = $UM_GOOGLEFONTS['items'];
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __( 'Google Font', 'cvio-plugin' );
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'basic';
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
			'font_size'	=> 14,
		);
		
		/*
		*  l10n (array) Array of strings that are used in JavaScript. This allows JS strings to be translated in PHP and loaded via:
		*/
		
		$this->l10n = array(
			'error'	=> __( 'Error! Please enter a higher value', 'cvio-plugin' ),
		);
				
		// do not delete!
		parent::__construct();
		
	}
	
	/*
	*  render_field_settings()
	*
	*  Create extra settings for your field. These are visible when editing a field
	*/
	
	function render_field_settings( $field ) {
		
		/*
		*  acf_render_field_setting
		*
		*  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
		*  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
		*
		*  More than one setting can be added by copy/paste the above code.
		*  Please note that you must also have a matching $defaults value for the field name (font_size)
		*/

	}
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*/
	
	function render_field( $field ) {
		?>
		<select name="<?php echo esc_attr( $field['name'] ); ?>" class="acf-select-google-fonts">
			<?php foreach ( $this->font as $key => $font ) : ?>
			<option <?php if ( $field['value'] == $key ) : ?>selected="selected"<?php endif; ?> value="<?php echo esc_attr( $key ); ?>">
				<?php 
				if ( $font["family"] ) :
					echo esc_html( $font["family"] ); 
				else :
					echo esc_html__( '- Default -', 'cvio-plugin' );
				endif;
				?>
			</option>
			<?php endforeach; ?>
		</select>
		<script>
			jQuery(document).ready(function($) {
				var $select = $('.acf-select-google-fonts');

				$select.select2({
					width: '100%'
				});
			});
		</script>
		<?php
	}
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*/

	function format_value( $value, $post_id, $field ) {
		$font_obj = array();
		$cur_font = isset( $this->font[ $value ] ) && $this->font[ $value ] ? $this->font[ $value ] : "";
		
		if ( $cur_font ) {
			if ( $cur_font["family"] == '' ) {
				return "";
			}

			$font_families = $cur_font["family"];
			
			if ( $cur_font["variants"] ) {
				$font_families .= ':' . implode( ",", $cur_font["variants"] );
			}

			$query_args = array(
				'family' => urlencode( $font_families ),
				'subset' => implode( ",", $cur_font["subsets"] ),
				'display' => urlencode( 'swap' ),
			);
			
			$font_obj['font_name'] = $cur_font["family"];
			$font_obj['url'] = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

			return $font_obj;
		} else {
			return "";
		}
	}

}

// initialize
new acf_field_cvio_ui_google_font();

// class_exists check
endif;

?>
