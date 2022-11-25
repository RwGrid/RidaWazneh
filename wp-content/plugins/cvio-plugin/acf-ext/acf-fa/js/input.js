(function($){


	function initialize_field( $el ) {

		//$el.doStuff();
		var $select = $('.acf-select-fa-fonts');

		$select.select2({
			width: '100%',
			templateResult: function (state) {
				if (!state.id) { return state.text; }
				return '<i class="'+state.id.toLowerCase()+'"></i> '+state.text;
			},
			templateSelection: function (state) {
				if (!state.id) { return state.text; }
				return '<i class="'+state.id.toLowerCase()+'"></i> '+state.text;
			},
			escapeMarkup: function(markup) {
				return markup;
			},
		});
	}


	if( typeof acf.add_action !== 'undefined' ) {

		/*
		*  ready append (ACF5)
		*
		*  These are 2 events which are fired during the page load
		*  ready = on page load similar to $(document).ready()
		*  append = on new DOM elements appended via repeater field
		*
		*  @type	event
		*  @date	20/07/13
		*
		*  @param	$el (jQuery selection) the jQuery element which contains the ACF fields
		*  @return	n/a
		*/

		// Update FontAwesome field previews and init select2 in field edit area
		acf.add_action( 'ready_field/type=font_awesome_font append_field/type=font_awesome_font show_field/type=font_awesome_font', function( $el ) {
			initialize_field( $(this) );
		});


	} else {


		/*
		*  acf/setup_fields (ACF4)
		*
		*  This event is triggered when ACF adds any new elements to the DOM.
		*
		*  @type	function
		*  @since	1.0.0
		*  @date	01/01/12
		*
		*  @param	event		e: an event object. This can be ignored
		*  @param	Element		postbox: An element which contains the new HTML
		*
		*  @return	n/a
		*/

		$(document).live('acf/setup_fields', function(e, postbox){

			$(postbox).find('.field[data-field_type="FIELD_NAME"]').each(function(){

				initialize_field( $(this) );

			});

		});


	}


})(jQuery);
