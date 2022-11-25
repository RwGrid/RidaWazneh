<?php

/*
 * Advanced Custom Fields: Google Fonts UI
*/

function include_field_types_ui_google_font( $version ) {
	include_once( 'acf-ui-google-font-v5.php' );
}
add_action( 'acf/include_field_types', 'include_field_types_ui_google_font' );

?>