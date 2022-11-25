<?php

/*
 * Advanced Custom Fields: Contact Form 7
*/

function include_field_types_cf7( $version ) {
	include_once( 'acf-cf7-v5.php' );
}
add_action( 'acf/include_field_types', 'include_field_types_cf7' );
	
?>