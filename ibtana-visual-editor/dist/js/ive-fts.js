( function( $ ) {
	$( function() {

		var $overlay = $( '#ive-fts-overlay' );

		if ( ! $overlay.length ) {
			return;
		}

		var $subscribe = $( '#ive-fts-subscribe' );
		var $close     = $( '#ive-fts-close' );
		var $message   = $( '#ive-fts-message' );
		var $actions   = $( '#ive-fts-actions' );
		var is_busy    = false;
		var is_done    = false;

		setTimeout( function() {
			$overlay.addClass( 'is-visible' );
		}, 400 );

		function ive_fts_close_popup() {
			$overlay.removeClass( 'is-visible' );
		}

		function ive_fts_dismiss_popup() {
			if ( is_done ) {
				return;
			}

			ive_fts_close_popup();

			$.post(
				ive_fts_params.ajax_url,
				{
					action:  'ive_dismiss_free_theme_support',
					wpnonce: ive_fts_params.wpnonce
				}
			);
		}

		$close.on( 'click', ive_fts_dismiss_popup );

		$overlay.on( 'click', function( e ) {
			if ( e.target === this ) {
				ive_fts_dismiss_popup();
			}
		} );

		$subscribe.on( 'click', function() {

			if ( is_busy || is_done ) {
				return;
			}
			is_busy = true;

			var subscribe_html = $subscribe.html();

			$subscribe.prop( 'disabled', true ).addClass( 'is-loading' ).text( ive_fts_params.i18n.loading );

			$.post(
				ive_fts_params.ajax_url,
				{
					action:  'ive_subscribe_free_theme_support',
					wpnonce: ive_fts_params.wpnonce
				}
			).done( function( response ) {

				if ( response && response.success ) {
					is_done = true;

					var success_message = ( response.data && response.data.message ) ? response.data.message : ive_fts_params.i18n.success;

					$message.removeClass( 'is-error' ).addClass( 'is-success' ).text( success_message );
					$actions.hide();

					setTimeout( ive_fts_close_popup, 2500 );
				} else {
					is_busy = false;

					var error_message = ( response && response.data && response.data.message ) ? response.data.message : ive_fts_params.i18n.error;

					$message.removeClass( 'is-success' ).addClass( 'is-error' ).text( error_message );
					$subscribe.prop( 'disabled', false ).removeClass( 'is-loading' ).html( subscribe_html );
				}

			} ).fail( function() {

				is_busy = false;

				$message.removeClass( 'is-success' ).addClass( 'is-error' ).text( ive_fts_params.i18n.error );
				$subscribe.prop( 'disabled', false ).removeClass( 'is-loading' ).html( subscribe_html );

			} );

		} );

	} );
} )( jQuery );
