<?php
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'IVE_Free_Theme_Support' ) ) {


	class IVE_Free_Theme_Support {


		function __construct() {

			// Free theme support subscription only applies to VW Themes' free theme line.
			// CUSTOM_TEXT_DOMAIN is only defined by the "-pro" themes (see ive-notice.php), so its
			// absence is the working signal for "this is a free theme" in this codebase.
			$ive_fts_theme_author = str_replace( ' ', '', strtolower( wp_get_theme()->get( 'Author' ) ) );

			if ( defined( 'CUSTOM_TEXT_DOMAIN' ) || ( $ive_fts_theme_author !== 'vwthemes' ) ) {
				return;
			}

			add_action( 'admin_notices', array( $this, 'ive_fts_popup' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'ive_fts_scripts' ) );

			add_action( 'wp_ajax_ive_subscribe_free_theme_support', array( $this, 'ive_subscribe_free_theme_support' ) );
			add_action( 'wp_ajax_ive_dismiss_free_theme_support', array( $this, 'ive_dismiss_free_theme_support' ) );
		}


		function ive_fts_scripts() {

			if ( ! $this->ive_fts_should_show_popup() ) {
				return;
			}

			wp_enqueue_style( 'ive-fts-style', IBTANA_PLUGIN_DIR_URL . 'dist/css/ive-fts.css', array(), IVE_VER );
			wp_enqueue_script( 'ive-fts-script', IBTANA_PLUGIN_DIR_URL . 'dist/js/ive-fts.js', array( 'jquery' ), IVE_VER, true );

			$ive_fts_params = array(
				'ajax_url'	=>	esc_url( admin_url( 'admin-ajax.php' ) ),
				'wpnonce'		=>	wp_create_nonce( 'ive_free_theme_support_nonce' ),
				'i18n'			=>	array(
					'loading'	=>	__( 'Subscribing…', 'ibtana-visual-editor' ),
					'success'	=>	__( "You're subscribed!", 'ibtana-visual-editor' ),
					'error'		=>	__( 'Something went wrong. Please try again later.', 'ibtana-visual-editor' )
				)
			);

			wp_localize_script( 'ive-fts-script', 'ive_fts_params', $ive_fts_params );
		}


		function ive_fts_should_show_popup() {

			if ( ! current_user_can( 'manage_options' ) ) {
				return false;
			}

			if ( get_option( 'ive_free_theme_support_subscribed', false ) ) {
				return false;
			}

			if ( get_option( 'ive_free_theme_support_dismissed', false ) ) {
				return false;
			}

			return true;
		}


		function ive_fts_popup() {

			if ( ! $this->ive_fts_should_show_popup() ) {
				return;
			}
			?>
			<div id="ive-fts-overlay" class="ive-fts-overlay">
				<div class="ive-fts-modal" role="dialog" aria-modal="true" aria-labelledby="ive-fts-title">
					<button type="button" class="ive-fts-close" id="ive-fts-close" aria-label="<?php esc_attr_e( 'Dismiss', 'ibtana-visual-editor' ); ?>">
						<span class="dashicons dashicons-no-alt"></span>
					</button>
					<div class="ive-fts-illustration">
						<img src="<?php echo esc_url( IBTANA_PLUGIN_DIR_URL . 'dist/images/admin-popup.png' ); ?>" alt="" />
					</div>
					<div class="ive-fts-content">
						<img class="ive-fts-logo" src="<?php echo esc_url( IBTANA_PLUGIN_DIR_URL . 'dist/images/admin-popup-logo.png' ); ?>" alt="<?php esc_attr_e( 'VW Themes', 'ibtana-visual-editor' ); ?>" />
						<h2 id="ive-fts-title">
							<?php esc_html_e( 'Subscribe for', 'ibtana-visual-editor' ); ?>
							<span class="ive-fts-title-accent"><?php esc_html_e( 'Free Theme Support', 'ibtana-visual-editor' ); ?></span>
						</h2>
						<div class="ive-fts-divider"></div>
						<p class="ive-fts-desc">
							<?php esc_html_e( 'Get theme updates, helpful guides, troubleshooting tips, and support resources.', 'ibtana-visual-editor' ); ?>
						</p>
						<div class="ive-fts-message" id="ive-fts-message"></div>
						<div class="ive-fts-actions" id="ive-fts-actions">
							<button type="button" class="ive-fts-btn ive-fts-btn-primary" id="ive-fts-subscribe">
								<?php esc_html_e( 'Subscribe for Free Theme Support', 'ibtana-visual-editor' ); ?>
								<span class="ive-fts-btn-arrow" aria-hidden="true">&rarr;</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<?php
		}


		function ive_subscribe_free_theme_support() {

			// Check for nonce security
			if ( ! wp_verify_nonce( $_POST['wpnonce'], 'ive_free_theme_support_nonce' ) ) {
				exit;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				exit;
			}

			// Already subscribed, guard against duplicate calls, backend also upserts by email + website_url.
			if ( get_option( 'ive_free_theme_support_subscribed', false ) ) {
				wp_send_json_success( array( 'message' => __( "You're subscribed!", 'ibtana-visual-editor' ) ) );
			}

			$ive_fts_current_user	= wp_get_current_user();
			$ive_fts_name					= $ive_fts_current_user->display_name;
			$ive_fts_email				= $ive_fts_current_user->user_email;

			if ( empty( $ive_fts_name ) || empty( $ive_fts_email ) ) {
				wp_send_json_error( array( 'message' => __( 'Unable to determine your name or email.', 'ibtana-visual-editor' ) ) );
			}

			$ive_fts_args	=	array(
				'name'					=>	$ive_fts_name,
				'email'					=>	$ive_fts_email,
				'website_url'		=>	home_url(),
				'phone'					=>	'',
				'country'				=>	'',
				'theme_name'		=>	wp_get_theme()->get( 'Name' )
			);
			$ive_fts_body			=	wp_json_encode( $ive_fts_args );
			$ive_fts_options	=	array(
				'timeout'			=>	10,
				'body'				=>	$ive_fts_body,
				'headers'			=>	array(
					'Content-Type'	=>	'application/json'
				)
			);

			$ive_fts_response	=	wp_remote_post( IBTANA_SHOPIFY_LICENSE_API_ENDPOINT . '/subscribe_free_theme_support', $ive_fts_options );

			if ( is_wp_error( $ive_fts_response ) ) {
				error_log( 'IVE Free Theme Support subscribe error: ' . $ive_fts_response->get_error_message() );
				wp_send_json_error( array( 'message' => __( 'Something went wrong. Please try again later.', 'ibtana-visual-editor' ) ) );
			}

			$ive_fts_response_body	=	json_decode( wp_remote_retrieve_body( $ive_fts_response ), true );

			if ( empty( $ive_fts_response_body['status'] ) ) {
				$ive_fts_message	=	! empty( $ive_fts_response_body['message'] ) ? $ive_fts_response_body['message'] : __( 'Something went wrong. Please try again later.', 'ibtana-visual-editor' );
				error_log( 'IVE Free Theme Support subscribe failed: ' . $ive_fts_message );
				wp_send_json_error( array( 'message' => $ive_fts_message ) );
			}

			update_option( 'ive_free_theme_support_subscribed', true );

			wp_send_json_success(
				array(
					'message'	=>	! empty( $ive_fts_response_body['message'] ) ? $ive_fts_response_body['message'] : __( "You're subscribed!", 'ibtana-visual-editor' )
				)
			);
		}


		function ive_dismiss_free_theme_support() {

			// Check for nonce security
			if ( ! wp_verify_nonce( $_POST['wpnonce'], 'ive_free_theme_support_nonce' ) ) {
				exit;
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				exit;
			}

			update_option( 'ive_free_theme_support_dismissed', true );
			wp_send_json_success();
		}


	}

	new IVE_Free_Theme_Support();

}
