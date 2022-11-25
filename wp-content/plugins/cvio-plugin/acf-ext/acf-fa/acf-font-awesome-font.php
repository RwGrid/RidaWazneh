<?php

/*
 * Advanced Custom Fields: Font Awesome
*/

function include_field_types_font_awesome_font( $version ) {
	include_once( 'acf-font-awesome-font-v5.php' );
}
add_action( 'acf/include_field_types', 'include_field_types_font_awesome_font' );

function cvio_fontawesome_dashboard() {
   wp_enqueue_style( 'fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', '5.15.4' );
}
add_action( 'admin_init', 'cvio_fontawesome_dashboard' );

?>
