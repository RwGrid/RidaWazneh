<?php

// exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if( ! class_exists( 'acf_field_cvio_cf7' ) ) :

class acf_field_cvio_cf7 extends acf_field {
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*/
	
	function __construct() {
		
		/*
		*  name (string) Single word, no spaces. Underscores allowed
		*/
		
		$this->name = 'cf7';
		
		/*
		*  label (string) Multiple words, can include spaces, visible when selecting a field type
		*/
		
		$this->label = __( 'Contact Form 7', 'cvio-plugin' );
		
		/*
		*  category (string) basic | content | choice | relational | jquery | layout | CUSTOM GROUP NAME
		*/
		
		$this->category = 'relational';
		
		/*
		*  defaults (array) Array of default settings which are merged into the field object. These are used later in settings
		*/
		
		$this->defaults = array(
			'allow_null'	=> 0,
			'multiple'		=> 0,
			'disable'		=> ''
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
		
		acf_render_field_setting( $field, array(
			'label'			=> __( 'Allow Null?', 'cvio-plugin' ),
			'type'			=> 'radio',
			'name'			=> 'allow_null',
			'choices' =>  array(
			  	1 =>  __( 'Yes', 'cvio-plugin' ),
			  	0 =>  __( 'No', 'cvio-plugin' ),
			),
			'layout'  =>  'horizontal'
		));

		acf_render_field_setting( $field, array(
			'label'			=> __( 'Select Multiple?', 'cvio-plugin' ),
			'type'			=> 'radio',
			'name'			=> 'multiple',
			'choices' =>  array(
				1 =>  __( 'Yes', 'cvio-plugin' ),
				0 =>  __( 'No', 'cvio-plugin' ),
			),
			'layout'  =>  'horizontal'
		));

		//Get form names
		$forms = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'orderby' => 'id', 'order' => 'ASC', 'posts_per_page' => 999, 'numberposts' => 999 ) );  
		$choices = array();
		$choices[0] = '---';
		$k = 1;
		foreach ( $forms as $f ) {
			$choices[ $k ] = $f->post_title;
			$k++;
		} 
		acf_render_field_setting( $field, array(
			'label'			=> __( 'Disable Forms?', 'cvio-plugin' ),
			'instructions'	=> __( 'User will not be able to select these forms', 'cvio-plugin' ),
			'type'			=> 'select',
			'name'			=> 'disable',
			'multiple'		=> '1',
			'allow_null'  =>  '0',
			'choices' =>  $choices
		));

	}
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*/
	
	function render_field( $field ) {
		$field['multiple'] = isset( $field['multiple'] ) ? $field['multiple'] : false;
		$field['disable'] = isset( $field['disable'] ) ? $field['disable'] : false;
			
		// Add multiple select functionality as required
		$multiple = '';
		if ( $field['multiple'] == '1' ) {
			$multiple = ' multiple="multiple" size="5" ';
			$field['name'] .= '[]';
		} 
		
		// Begin HTML select field
		echo '<select id="' . $field['name'] . '" class="' . $field['class'] . ' cf7-select" name="' . $field['name'] . '" ' . $multiple . ' >';
		
		// Add null value as required
		if ( $field['allow_null'] == '1' ) {
			echo '<option value="null"> - Select - </option>';
		}

		// Display all contact form 7 forms
		$forms = get_posts( array( 'post_type' => 'wpcf7_contact_form', 'orderby' => 'id', 'order' => 'ASC', 'posts_per_page' => -1, 'numberposts' => -1 ) );	   
		if ( $forms ) {  
			foreach ( $forms as $k => $form ) {
				$key = $form->ID;
				$value = $form->post_title; 
				$selected = '';
			
				// Mark form as selected as required
				if ( is_array( $field['value'] ) ) {
					// If the value is an array (multiple select), loop through values and check if it is selected
					if( in_array( $key, $field['value'] ) ) {
						$selected = 'selected="selected"';
					}
					//Disable form selection as required
					if ( in_array( ($k+1), $field['disable'] ) ) {
						$selected = 'disabled="disabled"';
					}
				} else {
					// If not a multiple select, just check normaly
					if ( $key == $field['value'] ) {
						$selected = 'selected="selected"';
					}
					if ( in_array( ($k+1), $field['disable'] ) ) {
						$selected = 'disabled="disabled"';
					}
				}
				echo '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
			} 
		}	

		echo '</select>';
	}
	
	/*
	*  input_admin_head()
	*
	*  This action is called in the admin_head action on the edit screen where your field is created.
	*  Use this action to add CSS and JavaScript to assist your render_field() action.
	*/

	function input_admin_head() {
	?>
		<script>
			jQuery(document).ready(function($) { 
				$(".cf7-select").select2({
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
		if ( ! $value || $value == 'null' ){
			return false;
		}
		
		//If there are multiple forms, construct and return an array of form markup
		if ( is_array( $value ) ) {
			foreach ( $value as $k => $v ) {
				$form = get_post( $v );
				$f = do_shortcode( '[contact-form-7 id="'.$form->ID.'" title="'.$form->post_title.'"]' );
				$value[ $k ] = array();
				$value[ $k ] = $f;
			}
		//Else return single form markup
		} else {
			$form = get_post( $value );
			$value = do_shortcode( '[contact-form-7 id="'.$form->ID.'" title="'.$form->post_title.'"]' );
		}

		return $value;
	}
	
}

// initialize
new acf_field_cvio_cf7();

// class_exists check
endif;

?>
