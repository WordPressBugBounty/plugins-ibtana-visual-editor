<?php

class WP_Ivecountdown {
	var $plugin_options_slug = 'ive-countdown';

	var $options_name = 'WP_TMC_options';

	/**
	 * @var array
	 */

	var $options = array(
		'displayyears'   => 'false',
		'displaymonths'  => 'false',
		'displayweeks'		=> 'false',
		'displayseconds'	=> 'false',
		'yearlabel'		=> 'Years',
		'monthlabel'	=> 'Months',
		'weeklabel'		=> 'Weeks',
		'daylabel'		=> 'Days',
		'hourlabel'		=> 'Hours',
		'minutelabel' => 'Minutes',
		'secondlabel' => 'Seconds',
		'custom_css' 	=> '',
		'backgroundColor' 	=> '#000000',
		'textColor' 	=> '#ffffff',
		'textColorHov' => '',

		'borderColor' 	=> '#ffffff',
		'borderColorHov' 	=> '',

		'borderRadius' 	=> 5,
		'borderWidth' 	=> 0,
		'typography' 	=> '',
		'fontWeight' 	=> '400',
		'fontStyle' 	=> 'normal',
		'fontSubset' 	=> '',
		'googleFont' 	=> 'false',
		'loadGoogleFont' 	=> 'true',
		'fontVariant' 	=> '',
		'desklabelFontSize' 	=> 11,
		'tablabelFontSize' 	=> 11,
		'moblabelFontSize' 	=> 8,
		'desknumberFontSize' 	=> 24,
		'tabnumberFontSize' 	=> 24,
		'mobnumberFontSize' 	=> 18,
		'letterSpacing' 	=> 0,
		'textTransform'  => '',
		'marginLR' 	=> 5,
		'marginTB' 	=> 5,
		'deskAlign' 	=> 'left',
		'tabAlign' 	=> 'left',
		'mobAlign' 	=> 'left',
		'tabAlignment' 	=> 'left',
		'blockAlignment' 	=> 'center',
		'deskWidth' => 72,
		'tabWidth' => 72,
		'mobWidth' => 72,
		'deskHeight' => 62,
		'tabHeight' => 62,
		'mobHeight' => 62,
	);


	function __construct() {
		$this->_set_options();

		// add actions
		add_action( 'init', array( $this, 'register_ive_block' ) );
		add_action( 'plugin_action_links_' . plugin_basename(__FILE__), array( $this, 'plugin_actions' ) );
		add_action( 'wp_head', array( $this, 'plugin_head_inject' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'countdown_scripts' ) );
		add_action( 'plugins_loaded', array( $this, 'ive_load_textdomain' ) );

		//rest endpoints
		add_action( 'rest_api_init',  array( $this, 'rest_ive_endpoints' ) );

		// the shortcode
		add_shortcode('ive', array( $this, 'ive_shortcode') );
	}

	function ive_load_textdomain() {
		load_plugin_textdomain( 'ive-countdown' );
	}

	/**
 	* Register ive block
 	*/
	function register_ive_block() {
		if ( ! function_exists( 'register_block_type' ) ) {
			// Gutenberg is not active.
			return;
		}

		wp_register_script(
			'wp-blocks',
			plugin_dir_url(__FILE__) . 'block.js',
			array(
				'wp-blocks',
				'wp-element',
				'wp-components',
				'wp-i18n',
				'wp-editor',
			),
			'0.2',
			true
		);

		$ive_options = array(
			'displayyears' => $this->options['displayyears'],
			'displaymonths' => $this->options['displaymonths'],
			'displayweeks' => $this->options['displayweeks'],
			'displayseconds' => $this->options['displayseconds'],
			'yearlabel' => $this->options['yearlabel'],
			'monthlabel' => $this->options['monthlabel'],
			'weeklabel' => $this->options['weeklabel'],
			'daylabel' => $this->options['daylabel'],
			'hourlabel' => $this->options['hourlabel'],
			'minutelabel' => $this->options['minutelabel'],
			'secondlabel' => $this->options['secondlabel'],
			'backgroundColor' => $this->options['backgroundColor'],

			'textColor' => $this->options['textColor'],
			'textColorHov' => $this->options['textColorHov'],

			'borderColor' => $this->options['borderColor'],
			'borderColorHov' => $this->options['borderColorHov'],
			'borderRadius' => $this->options['borderRadius'],
			'borderWidth' => $this->options['borderWidth'],
			'desknumberFontSize' => $this->options['desknumberFontSize'],
			'tabnumberFontSize' => $this->options['tabnumberFontSize'],
			'mobnumberFontSize' => $this->options['mobnumberFontSize'],
			'desklabelFontSize' => $this->options['desklabelFontSize'],
			'tablabelFontSize' => $this->options['tablabelFontSize'],
			'moblabelFontSize' => $this->options['moblabelFontSize'],
			'typography' => $this->options['typography'],
			'fontWeight' => $this->options['fontWeight'],
			'googleFont' => $this->options['googleFont'],
			'loadGoogleFont' => $this->options['loadGoogleFont'],
			'fontVariant' => $this->options['fontVariant'],
			'fontStyle' => $this->options['fontStyle'],
			'fontSubset' => $this->options['fontSubset'],
			'letterSpacing' => $this->options['letterSpacing'],
			'textTransform' => $this->options['textTransform'],
			'marginLR' => $this->options['marginLR'],
			'marginTB' => $this->options['marginTB'],
			'deskAlign' => $this->options['deskAlign'],
			'tabAlign' => $this->options['tabAlign'],
			'mobAlign' => $this->options['mobAlign'],
			'tabAlignment' => $this->options['tabAlignment'],
			'blockAlignment' => $this->options['blockAlignment'],
			'deskWidth' => $this->options['deskWidth'],
			'tabWidth' => $this->options['tabWidth'],
			'mobWidth' => $this->options['mobWidth'],
			'deskHeight' => $this->options['deskHeight'],
			'tabHeight' => $this->options['tabHeight'],
			'mobHeight' => $this->options['mobHeight'],
		);

		//pass default options to js
		wp_localize_script('wp-blocks', 'ive_options', $ive_options );

		register_block_type( 'ive/countdown', array(
			'editor_script' => 'wp-blocks',
			'render_callback' => [$this, 'ive_countdown_callback'],
			'attributes' => array(
														'content' => array('type' => 'string'),
														'id' => array ('type' => 'string'),
														'style' => array ('type' => 'string', 'default' => 'suzuki'),
														't' => array ('type' => 'number'),
														'timestr' => array ('type' => 'string'),
														'launchtarget' => array ('type' => 'string'),
													  'secs' => array ('type' => 'string', 'default' => '00'),
														'displayyears' => array ('type' => 'boolean', 'default' => $this->options['displayyears']),
														'displaymonths' => array ('type' => 'boolean', 'default' => $this->options['displaymonths']),
														'displayweeks' => array ('type' => 'boolean', 'default' => $this->options['displayweeks']),
														'displayseconds' => array ('type' => 'boolean', 'default' => $this->options['displayseconds']),
														'yearlabel' => array ('type' => 'string', 'default' => $this->options['yearlabel']),
														'monthlabel' => array ('type' => 'string', 'default' => $this->options['monthlabel']),
														'weeklabel' => array ('type' => 'string', 'default' => $this->options['weeklabel']),
														'daylabel' => array ('type' => 'string', 'default' => $this->options['daylabel']),
														'hourlabel' => array ('type' => 'string', 'default' => $this->options['hourlabel']),
														'minutelabel' => array ('type' => 'string', 'default' => $this->options['minutelabel']),
														'secondlabel' => array ('type' => 'string', 'default' => $this->options['secondlabel']),
														'backgroundColor' => array ('type' => 'string', 'default' => $this->options['backgroundColor']),
														'textColor' => array ('type' => 'string', 'default' => $this->options['textColor']),

														'textColorHov' => array ('type' => 'string', 'default' => $this->options['textColorHov']),

														'borderColor' => array ('type' => 'string', 'default' => $this->options['borderColor']),
														'borderColorHov' => array ('type' => 'string', 'default' => $this->options['borderColorHov']),
														'borderRadius' => array ('type' => 'number', 'default' => $this->options['borderRadius']),
														'borderWidth' => array ('type' => 'number', 'default' => $this->options['borderWidth']),
														'typography' => array ('type' => 'string', 'default' => $this->options['typography']),
														'fontWeight' => array ('type' => 'number', 'default' => $this->options['fontWeight']),
														'googleFont' => array ('type' => 'boolean', 'default' => $this->options['googleFont']),
														'loadGoogleFont' => array ('type' => 'boolean', 'default' => $this->options['loadGoogleFont']),
														'fontVariant' => array ('type' => 'string', 'default' => $this->options['fontVariant']),
														'fontStyle' => array ('type' => 'string', 'default' => $this->options['fontStyle']),
														'fontSubset' => array ('type' => 'string', 'default' => $this->options['fontSubset']),
														'desklabelFontSize' => array ('type' => 'number', 'default' => $this->options['desklabelFontSize']),
														'tablabelFontSize' => array ('type' => 'number', 'default' => $this->options['tablabelFontSize']),
														'moblabelFontSize' => array ('type' => 'number', 'default' => $this->options['moblabelFontSize']),
														'desknumberFontSize' => array ('type' => 'number', 'default' => $this->options['desknumberFontSize']),
														'tabnumberFontSize' => array ('type' => 'number', 'default' => $this->options['tabnumberFontSize']),
														'mobnumberFontSize' => array ('type' => 'number', 'default' => $this->options['mobnumberFontSize']),
														'letterSpacing' => array ('type' => 'number', 'default' => $this->options['letterSpacing']),
														'textTransform' => array ('type' => 'string', 'default' => $this->options['textTransform']),
														'marginLR' => array ('type' => 'number', 'default' => $this->options['marginLR']),
														'marginTB' => array ('type' => 'number', 'default' => $this->options['marginTB']),
														'deskAlign' => array ('type' => 'string', 'default' => $this->options['deskAlign']),
														'tabAlign' => array ('type' => 'string', 'default' => $this->options['tabAlign']),
														'mobAlign' => array ('type' => 'string', 'default' => $this->options['mobAlign']),
														'tabAlignment' => array ('type' => 'string', 'default' => $this->options['tabAlignment']),
														'blockAlignment' => array ('type' => 'string', 'default' => $this->options['blockAlignment']),
														'deskWidth' => array ('type' => 'number', 'default' => $this->options['deskWidth']),
														'tabWidth' => array ('type' => 'number', 'default' => $this->options['tabWidth']),
														'mobWidth' => array ('type' => 'number', 'default' => $this->options['mobWidth']),
														'deskHeight' => array ('type' => 'number', 'default' => $this->options['deskHeight']),
														'tabHeight' => array ('type' => 'number', 'default' => $this->options['tabHeight']),
														'mobHeight' => array ('type' => 'number', 'default' => $this->options['mobHeight']),
													)
												) );
											}

	//rest  endpoints: /wp-json/ive/v1/now
	function rest_ive_endpoints() {
    $namespace = 'ive/v1';
    register_rest_route( $namespace, '/now', array(
			'methods'   => 'GET',
			'callback'  => array( $this, 'rest_now_handler'),
			'permission_callback' => '__return_true'
    ));
	}

	function rest_now_handler( ) {
		$now = new DateTime( '', $this->get_wp_timezone() );
		$result = new WP_REST_Response( $now, 200 );
		$result->set_headers(array('Cache-Control' => 'no-cache'));
		return $result;
	}

	// Add link to options page from plugin list
	function plugin_actions($links) {
		$new_links = array();
		$new_links[] = '<a href="options-general.php?page='.$this->plugin_options_slug.'">' . __('Settings', 'ive-countdown') . '</a>';
		return array_merge($new_links, $links);
	}

	//plugin header inject
	function plugin_head_inject() {
		// custom css
		if( !empty( $this->options['custom_css'] ) ) {
			echo "<style>\n";
			echo esc_html( $this->options['custom_css'] );
			echo "\n</style>\n";
		}
	}

	//load front-end countdown scripts
	function countdown_scripts() {

		$post = get_post();
    if ( !is_object( $post ) ) {
      return false;
    }

		$is_ive_countdown_block_exists = false;

		if ( has_blocks( $post->post_content ) ) {
			$blocks = parse_blocks( $post->post_content );

			foreach ( $blocks as $key => $block_single ) {
				$block_single_blockName  = $block_single['blockName'];
				$block_single_blockName_arr = explode( '/', $block_single_blockName ?? '');
				if ( ( $block_single_blockName_arr[0] === 'ive' ) && ( 'countdown' === $block_single_blockName_arr[1] ) ) {
					$is_ive_countdown_block_exists = true;
					break;
				}
			}
		}

		$is_ive_countdown_block_exists = true;

		if ( !$is_ive_countdown_block_exists ) {
			return;
		}

		if (function_exists( 'is_checkout' )) {
			if (is_checkout()) {
				return;
			}
		}
		$plugin_url = plugins_url() .'/'. dirname( plugin_basename(__FILE__) );

		//tCountdown script
		wp_register_script( 'countdown-script', $plugin_url.'/js/jquery.ive-countdown.min.js', array ('jquery'), '2.4.5', 'true' );
		// callback for t(-) events
		$response = array( 'now' => date( 'n/j/Y H:i:s', strtotime(current_time('mysql'))));
		wp_localize_script( 'countdown-script', 'iveCountAjax', array(
			'ajaxurl' 		 =>	admin_url( 'admin-ajax.php' ),
			'api_nonce'		 => wp_create_nonce( 'wp_rest' ),
			'api_url'		 => get_rest_url() . 'ive/v1/',
			'countdownNonce' => wp_create_nonce( 'tountajax-countdownonce-nonce' ),
			'ivenow'         => json_encode($response)
		));
		wp_enqueue_script('countdown-script');
	}


	/**
	 * Admin options page
	 */
	function options_page() {


	}

	function _set_options() {
		// set options
		$saved_options = get_option( $this->options_name );

		// set all options
		if ( ! empty( $saved_options ) ) {
				foreach ( $this->options AS $key => $option ) {
						if(isset($saved_options[ $key ])){
							  if(is_array($saved_options[ $key ])){
									$this->options[ $key ] = ( empty( $saved_options[ $key ][0] ) ) ? '' : $saved_options[ $key ][0];
								}
								else{
									$this->options[ $key ] = ( empty( $saved_options[ $key ] ) ) ? '' : $saved_options[ $key ];
								}
						}
				}
		}
	}

	function get_wp_timezone() {
	    $tzstring = get_option( 'timezone_string' );
	    $offset   = get_option( 'gmt_offset' );

			if( empty( $tzstring ) && 0 != $offset && floor( $offset ) == $offset ){
	        $offset_st = $offset > 0 ? "-$offset" : '+'.absint( $offset );
	        $tzstring  = 'Etc/GMT'.$offset_st;
	    }

	    if( empty( $tzstring ) ){
	        $tzstring = 'UTC';
	    }

	    $timezone = new DateTimeZone( $tzstring );
	    return $timezone;
	}

	/**
	 * Sanitize a CSS-safe identifier (class/id fragment).
	 *
	 * @param mixed  $value   Raw value.
	 * @param string $default Fallback value.
	 *
	 * @return string
	 */
	private function ive_sanitize_css_identifier( $value, $default = '' ) {
		$value = preg_replace( '/[^a-zA-Z0-9_-]/', '', (string) $value );
		return ( '' !== $value ) ? $value : $default;
	}

	/**
	 * Sanitize numeric CSS values.
	 *
	 * @param mixed $value   Raw value.
	 * @param mixed $default Fallback value.
	 *
	 * @return float|int
	 */
	private function ive_sanitize_css_number( $value, $default = 0 ) {
		if ( is_numeric( $value ) ) {
			return 0 + $value;
		}

		return is_numeric( $default ) ? ( 0 + $default ) : 0;
	}

	/**
	 * Sanitize a CSS color value.
	 *
	 * @param mixed  $value   Raw value.
	 * @param string $default Fallback value.
	 *
	 * @return string
	 */
	private function ive_sanitize_css_color( $value, $default = '' ) {
		$value = trim( (string) $value );

		if ( '' === $value ) {
			return $default;
		}

		$hex = sanitize_hex_color( $value );
		if ( ! empty( $hex ) ) {
			return $hex;
		}

		if ( preg_match( '/^(rgba?|hsla?)\(\s*[0-9.%\s,\-]+\)$/i', $value ) ) {
			return $value;
		}

		return $default;
	}

	/**
	 * Sanitize a CSS keyword from an allow-list.
	 *
	 * @param mixed  $value   Raw value.
	 * @param array  $allowed Allowed values.
	 * @param string $default Fallback value.
	 *
	 * @return string
	 */
	private function ive_sanitize_css_keyword( $value, $allowed, $default = '' ) {
		$value = strtolower( trim( (string) $value ) );
		return in_array( $value, $allowed, true ) ? $value : $default;
	}

	/**
	 * Sanitize a CSS font family string.
	 *
	 * @param mixed  $value   Raw value.
	 * @param string $default Fallback value.
	 *
	 * @return string
	 */
	private function ive_sanitize_css_font_family( $value, $default = 'Open Sans' ) {
		$value = trim( (string) $value );
		$value = preg_replace( '/[^a-zA-Z0-9\s,\-\+]/', '', $value );

		return ( '' !== $value ) ? $value : $default;
	}

	/**
	 * Sanitize Google font family query value.
	 *
	 * @param mixed  $value   Raw value.
	 * @param string $default Fallback value.
	 *
	 * @return string
	 */
	private function ive_sanitize_google_font_family_query( $value, $default = 'Open+Sans' ) {
		$value = trim( (string) $value );
		$value = str_replace( ' ', '+', $value );
		$value = preg_replace( '/[^a-zA-Z0-9\+\-]/', '', $value );

		return ( '' !== $value ) ? $value : $default;
	}

	function ive_countdown_callback($atts) {

		if(empty($atts['content'])){
			$atts['content'] = '';
		}
		if(empty($atts['launchtarget'])){
			$atts['launchtarget'] = 'countdown';
		}
		$style = $atts['style'];
		$timestamp = new DateTime( '', $this->get_wp_timezone() );

		/*
		$timezone = get_option('timezone_string');
		if(!empty($atts['timezone'])){
			$timezone = $atts['timezone'];
		}
		*/

		if(!empty($atts['timestr'])){
			$t = $atts['timestr'];
		}
		else if(!empty($atts['t'])){
			$timestamp->setTimestamp($atts['t']);
			$t = $timestamp->format('Y-m-d H:i').':'.$atts['secs'];
		}
		else{
			$t = '+ 1 day';
		}

		$display_str = '';
		if($atts['displayyears'] === true){
			$display_str .= 'displayyears="true"';
		}
		if($atts['displaymonths'] === true){
			$display_str .= ' displaymonths="true"';
		}
		if($atts['displayweeks'] === true){
			$display_str .= ' displayweeks="true"';
		}
		if($atts['displayseconds'] === true){
			$display_str .= ' displayseconds="true"';
		}
		//var_dump($display_str);

		return do_shortcode('[ive t="'.$t.'" style="'.$style.'" '.$display_str.' years="'.$atts['yearlabel'].'" months="'.$atts['monthlabel'].'" weeks="'.$atts['weeklabel'].'" days="'.$atts['daylabel'].'" hours="'.$atts['hourlabel'].'" minutes="'.$atts['minutelabel'].'" seconds="'.$atts['secondlabel'].'" launchtarget="'.$atts['launchtarget'].'" backgroundcolor="'.$atts['backgroundColor'].'" textcolor="'.$atts['textColor'].'" textcolorhov="'.$atts['textColorHov'].'" bordercolor="'.$atts['borderColor'].'"  bordercolorhov="'.$atts['borderColorHov'].'" borderradius="'.$atts['borderRadius'].'" borderwidth="'.$atts['borderWidth'].'" desklabelfontsize="'.$atts['desklabelFontSize'].'" typography="'.$atts['typography'].'" fontweight="'.$atts['fontWeight'].'" fontstyle="'.$atts['fontStyle'].'" desknumberfontsize="'.$atts['desknumberFontSize'].'" letterspacing="'.$atts['letterSpacing'].'" texttransform="'.$atts['textTransform'].'" marginlr="'.$atts['marginLR'].'" margintb="'.$atts['marginTB'].'" deskalign="'.$atts['deskAlign'].'" mobalign="'.$atts['mobAlign'].'" tabalign="'.$atts['tabAlign'].'" tabalignment="'.$atts['tabAlignment'].'" blockalignment="'.$atts['blockAlignment'].'" tablabelfontsize="'.$atts['tablabelFontSize'].'" tabnumberfontsize="'.$atts['tabnumberFontSize'].'" moblabelfontsize="'.$atts['moblabelFontSize'].'" mobnumberfontsize="'.$atts['mobnumberFontSize'].'"  deskwidth="'.$atts['deskWidth'].'" deskheight="'.$atts['deskHeight'].'" tabwidth="'.$atts['tabWidth'].'"  tabheight="'.$atts['tabHeight'].'"  mobwidth="'.$atts['mobWidth'].'" mobheight="'.$atts['mobHeight'].'"]'.$atts['content'].'[/ive]');
	}
	//the shortcode
	function ive_shortcode($atts, $content=null) {
		//find a random number, if no id was assigned
		$ran = uniqid();
	    extract(shortcode_atts(array(
			'id' 									=> sanitize_text_field($ran),
			't' 									=> '',
			// 'timezone' 						=> get_option('timezone_string'),
			'years' 							=> sanitize_text_field($this->options['yearlabel']),
			'months' 							=> sanitize_text_field($this->options['monthlabel']),
			'weeks' 							=> sanitize_text_field($this->options['weeklabel']),
			'days'								=> sanitize_text_field($this->options['daylabel']),
			'hours'								=> sanitize_text_field($this->options['hourlabel']),
			'minutes' 						=> sanitize_text_field($this->options['minutelabel']),
			'seconds' 						=> sanitize_text_field($this->options['secondlabel']),
			'displayyears' 				=> sanitize_text_field($this->options['displayyears']),
			'displaymonths' 			=> sanitize_text_field($this->options['displaymonths']),
			'displayweeks' 				=> sanitize_text_field($this->options['displayweeks']),
			'displayseconds'			=> sanitize_text_field($this->options['displayseconds']),
			'backgroundcolor' 		=> sanitize_text_field($this->options['backgroundColor']),
			'textcolor' 					=> sanitize_text_field($this->options['textColor']),
			'textcolorhov' 				=> sanitize_text_field($this->options['textColorHov']),
			'bordercolor' 				=> sanitize_text_field($this->options['borderColor']),
			'bordercolorhov' 			=> sanitize_text_field($this->options['borderColorHov']),
			'borderradius' 				=> sanitize_text_field($this->options['borderRadius']),
			'borderwidth' 				=> sanitize_text_field($this->options['borderWidth']),
			'typography' 					=> sanitize_text_field($this->options['typography']),
			'fontstyle' 					=> sanitize_text_field($this->options['fontStyle']),
			'fontweight' 					=> sanitize_text_field($this->options['fontWeight']),
			'desklabelfontsize' 	=> sanitize_text_field($this->options['desklabelFontSize']),
			'tablabelfontsize' 		=> sanitize_text_field($this->options['tablabelFontSize']),
			'moblabelfontsize' 		=> sanitize_text_field($this->options['moblabelFontSize']),
			'desknumberfontsize' 	=> sanitize_text_field($this->options['desknumberFontSize']),
			'tabnumberfontsize' 	=> sanitize_text_field($this->options['tabnumberFontSize']),
			'mobnumberfontsize'		=> sanitize_text_field($this->options['mobnumberFontSize']),
			'marginlr' 						=> sanitize_text_field($this->options['marginLR']),
			'margintb' 						=> sanitize_text_field($this->options['marginTB']),
			'deskalign' 					=> sanitize_text_field($this->options['deskAlign']),
			'tabalign' 						=> sanitize_text_field($this->options['tabAlign']),
			'mobalign' 						=> sanitize_text_field($this->options['mobAlign']),
			'letterspacing' 			=> sanitize_text_field($this->options['letterSpacing']),
			'texttransform'				=> sanitize_text_field($this->options['textTransform']),
			'tabalignment' 				=> sanitize_text_field($this->options['tabAlignment']),
			'blockalignment' 			=> sanitize_text_field($this->options['blockAlignment']),
			'deskwidth' 					=> sanitize_text_field($this->options['deskWidth']),
			'tabwidth' 						=> sanitize_text_field($this->options['deskWidth']),
			'mobwidth' 						=> sanitize_text_field($this->options['deskWidth']),
			'deskheight'					=> sanitize_text_field($this->options['deskHeight']),
			'tabheight' 					=> sanitize_text_field($this->options['deskHeight']),
			'mobheight' 					=> sanitize_text_field($this->options['deskHeight']),
			'style' 							=> 'suzuki',
			'before' 							=> '',
			'after' 							=> '',
			'width' 							=> 'auto',
			'height' 							=> 'auto',
			'launchwidth' 				=> 'auto',
			'launchheight' 				=> 'auto',
			'launchtarget' 				=> 'countdown',
			'event_id' 						=> '',
			'debug' 							=> '',
		), IVE_Loader::ive_sanitize_array($atts), 'ive' ));

		if(empty($t)){
			return;
		}

		//insert some style into your life
		$style_file_url = plugins_url('/css/'.$style.'/style.css', __FILE__);

		if ( file_exists( __DIR__ .'/css/'.$style.'/style.css' ) ) {
			if (! wp_style_is( 'countdown-'.$style.'-css', 'registered' )) {
				wp_register_style( 'countdown-'.$style.'-css', $style_file_url, array(), '2.0');
			}
			wp_enqueue_style( 'countdown-'.$style.'-css' );
		}

		//$now = new DateTime( );
		$now = new DateTime( '', $this->get_wp_timezone() );

		// deal with this_year and this_easter
		if(stristr($t, '%') != FALSE){
			$scode = array('%this_year%', '%this_easter%');
			$swap = array(date('Y'), date('Y-m-d', easter_date(date('Y'))));

			if( strtotime( str_replace($scode, $swap, $t)) <  strtotime("now") ){
				$swap = array(date('Y', strtotime('+1 year')), date('Y-m-d', easter_date(date('Y', strtotime('+1 year')))));
			}
			$t = str_replace($scode, $swap, $t);
		}


		$target = new DateTime( $t, $this->get_wp_timezone() );
		$tomorrow_target = $target;

		$diffSecs = $target->getTimestamp() - $now->getTimestamp();

		$day = $target->format('d');
		$month = $target->format('m');
		$year = $target->format('Y');
		$hour = $target->format('H');
		$min = $target->format('i');
		$sec = $target->format('s');

		// interval
		$interval = $now->diff($target);

		// next digits
		$pop_day = new DateInterval('P1D');

		$tomorrow_target->sub($pop_day);
		$tomorrow_interval = $now->diff($tomorrow_target);

		// countdown digits
		$date_arr = array(
			'secs' => $interval->s,
			'mins' => $interval->i,
			'hours' => $interval->h,
			'days' => $interval->d,
			'months' => $interval->m,
			'years' => $interval->y,
	 	);

		$current_hours = $interval->h;
		$current_minutes = $interval->i;

		$next_arr = array(
			'next_day' => $tomorrow_interval->d
		);

		if($interval->m != $tomorrow_interval->m){
			$next_arr['next_month'] = $tomorrow_interval->m;
		}

		if($interval->y != $tomorrow_interval->y){
			$next_arr['next_year'] = $tomorrow_interval->y;
		}

	  // deal with display years
		if(!empty($interval->y) && $displayyears != 'true'){
			// if no months, calculate everyting with total days
			if($displaymonths != 'true'){
				$date_arr['days'] = $interval->days;
				$next_arr['next_day'] = $tomorrow_interval->days;
			}
			// add years to months.
			else{
				$date_arr['months'] = $date_arr['months'] + ($interval->y * 12);
				if(isset($next_arr['next_month'])){
					$next_arr['next_month'] = $next_arr['next_month'] + ($tomorrow_interval->y * 12);
				}
				else{
					$next_arr['next_month'] = ($tomorrow_interval->y * 12);
				}

			}
		}

		// deal with display months
		if(!empty($date_arr['months']) && $displaymonths != 'true'){
			if(!empty($interval->y) && $displayyears == 'true'){
				$pop_years = new DateInterval('P'.$interval->y.'Y');
				$adjusted_target = $target->sub($pop_years);
				$interval = $now->diff($adjusted_target);

				if(!empty($next_arr['next_year'])){
					$pop_tomorrow_time = new DateInterval('P'.$interval->y.'Y1D');
					$adjusted_tomorrow = $target->sub($pop_tomorrow_time);
					$tomorrow_interval = $now->diff($adjusted_tomorrow);
				}
			}
			$date_arr['days'] = $interval->days;
			$next_arr['next_day'] = $tomorrow_interval->days;
		}

		//but what if months where empty, but next day we have months...
		else if(!empty($next_arr['next_month']) && $displaymonths != 'true'){
			$next_arr['next_day'] = $tomorrow_interval->days;
		}

		// adjust days if weeks are being displayed
		if($displayweeks == 'true'){
			$date_arr['weeks'] = (int) floor( $date_arr['days'] / 7 );
			$date_arr['daysT-'] = (int) floor($date_arr['days'] %7);

			$next_week = (int) floor( $next_arr['next_day'] / 7 );
			if($date_arr['weeks'] != $next_week ){
				$next_arr['next_week'] = $next_week;
			}
			$next_arr['next_day'] = (int) floor($next_arr['next_day'] %7);
		}

		if( $diffSecs <= 0 && $launchtarget != 'countup'){
			$date_arr = array(
				'secs' => 0,
				'mins' => 0,
				'hours' => 0,
				'days' => 0,
				'weeks' => 0,
				'months' => 0,
				'years' => 0,
		 	);
		}

		// break numbers into digit elements
		foreach ($date_arr as $i => $d) {
			if($i == 'days' && $next_arr['next_day'] > 99){
				if($d > 9){
					$d = sprintf("%02d", $d);
				}
				if($d < 10){
					$d = sprintf("%03d", $d);
				}
			}
			//single digits get a padding zero
			else if($d < 10){
				$d = sprintf("%02d", $d);
			}
			$date_arr[$i] = array_map('intval', str_split($d));
		}


		if(is_numeric($width)){
			$width .= 'px';
		}
		if(is_numeric($height)){
			$height .= 'px';
		}
		$id = uniqid();

		$css_id = $this->ive_sanitize_css_identifier( $id );
		$css_background_color = $this->ive_sanitize_css_color( $backgroundcolor, '#000000' );
		$css_text_color = $this->ive_sanitize_css_color( $textcolor, '#ffffff' );
		$css_text_color_hover = $this->ive_sanitize_css_color( $textcolorhov, $css_text_color );
		$css_border_color = $this->ive_sanitize_css_color( $bordercolor, '#ffffff' );
		$css_border_color_hover = $this->ive_sanitize_css_color( $bordercolorhov, $css_border_color );
		$css_border_width = $this->ive_sanitize_css_number( $borderwidth, 0 );
		$css_border_radius = $this->ive_sanitize_css_number( $borderradius, 0 );
		$css_margin_tb = $this->ive_sanitize_css_number( $margintb, 0 );
		$css_margin_lr = $this->ive_sanitize_css_number( $marginlr, 0 );
		$css_font_family = $this->ive_sanitize_css_font_family( $typography, 'Open Sans' );
		$css_google_font_family = $this->ive_sanitize_google_font_family_query( $typography, 'Open+Sans' );
		$css_google_font_weight = $this->ive_sanitize_css_keyword( $fontweight, array( '100', '200', '300', '400', '500', '600', '700', '800', '900' ), '400' );
		$css_font_weight = $this->ive_sanitize_css_keyword( $fontweight, array( '100', '200', '300', '400', '500', '600', '700', '800', '900', 'normal', 'bold', 'bolder', 'lighter' ), '400' );
		$css_font_style = $this->ive_sanitize_css_keyword( $fontstyle, array( 'normal', 'italic', 'oblique' ), 'normal' );
		$css_letter_spacing = $this->ive_sanitize_css_number( $letterspacing, 0 );
		$css_text_transform = $this->ive_sanitize_css_keyword( $texttransform, array( 'none', 'capitalize', 'uppercase', 'lowercase' ), 'none' );
		$css_mobile_align = $this->ive_sanitize_css_keyword( $mobalign, array( 'left', 'right', 'center', 'justify', 'start', 'end' ), 'left' );
		$css_tablet_align = $this->ive_sanitize_css_keyword( $tabalign, array( 'left', 'right', 'center', 'justify', 'start', 'end' ), 'left' );
		$css_desktop_align = $this->ive_sanitize_css_keyword( $deskalign, array( 'left', 'right', 'center', 'justify', 'start', 'end' ), 'left' );
		$css_justify_content = $this->ive_sanitize_css_keyword( $tabalignment, array( 'flex-start', 'flex-end', 'center', 'space-between', 'space-around', 'space-evenly', 'start', 'end', 'left', 'right' ), 'left' );
		$css_mobile_label_size = $this->ive_sanitize_css_number( $moblabelfontsize, 8 );
		$css_mobile_number_size = $this->ive_sanitize_css_number( $mobnumberfontsize, 18 );
		$css_tablet_label_size = $this->ive_sanitize_css_number( $tablabelfontsize, 11 );
		$css_tablet_number_size = $this->ive_sanitize_css_number( $tabnumberfontsize, 24 );
		$css_desktop_label_size = $this->ive_sanitize_css_number( $desklabelfontsize, 11 );
		$css_desktop_number_size = $this->ive_sanitize_css_number( $desknumberfontsize, 24 );
		$css_desk_width = $this->ive_sanitize_css_number( $deskwidth, 72 );
		$css_desk_height = $this->ive_sanitize_css_number( $deskheight, 62 );

		$ive = '<div id="'.esc_attr( $id."-countdown").'" class="'.esc_attr("ive-title countdown_main_".$id." align".$blockalignment." ive_countdown").'" style="width:'. esc_attr($width) .'; height:'. esc_attr($height) .';">';
		$ive .= '<div class="'.esc_attr($style."-countdown").'">';
		$ive .= '<div id="'.esc_attr($id."-tophtml").'" class="'.esc_attr($style."-tophtml").'">';
	    if($before){
	        $ive .=  wp_kses_post($before);
	    }
		$ive .=  '</div>';
		$ive .= '<style>';
		$ive .= '@import url("https://fonts.googleapis.com/css2?family=' . $css_google_font_family . ':wght@' . $css_google_font_weight . '&display=swap");';
		$ive .= '
		.countdown-style-' . $css_id . '{
			background: ' . $css_background_color . ' !important;
			color: ' . $css_text_color . ' !important;
			border: ' . $css_border_width . 'px solid ' . $css_border_color . ' !important;
			border-radius: ' . $css_border_radius . 'px !important;
			margin: ' . $css_margin_tb . 'px ' . $css_margin_lr . 'px !important;
		}
		.countdown-width-height' . $css_id . ':hover{
		  color: ' . $css_text_color_hover . ' !important;
		}
		.countdown-style-' . $css_id . ':hover{
			border: ' . $css_border_width . 'px solid ' . $css_border_color_hover . ' !important;
		}
		.countdown-title-color-' . $css_id . '{
			color: ' . $css_text_color . ' !important;
			font-family: "' . $css_font_family . '" !important;
			font-weight: ' . $css_font_weight . ' !important;
			font-style: ' . $css_font_style . ' !important;
			letter-spacing: ' . $css_letter_spacing . 'px !important;
			text-transform: ' . $css_text_transform . ' !important;
		}
		@media screen and (max-width: 767px){
			.countdown-title-color-' . $css_id . '{
				text-align: ' . $css_mobile_align . ' !important;
				font-size:' . $css_mobile_label_size . 'px !important;
			}
			.countdown-number-fontsize-' . $css_id . '{
				font-size:' . $css_mobile_number_size . 'px !important;
			}
		}
		@media screen and (min-width: 768px) and (max-width: 1023px){
			.countdown-title-color-' . $css_id . '{
				text-align: ' . $css_tablet_align . ' !important;
				font-size:' . $css_tablet_label_size . 'px !important;
			}
			.countdown-number-fontsize-' . $css_id . '{
				font-size:' . $css_tablet_number_size . 'px !important;
			}
		}
		@media screen and (min-width: 1024px){
			.countdown_main_' . $css_id . '{
				justify-content:' . $css_justify_content . ';
				display:flex;
			}
			.countdown-title-color-' . $css_id . '{
				text-align: ' . $css_desktop_align . ' !important;
				font-size:' . $css_desktop_label_size . 'px !important;
			}
			.countdown-width-height' . $css_id . '{
				width:' . $css_desk_width . 'px !important;
				height:' . $css_desk_height . 'px !important;
			}
			.countdown-number-fontsize-' . $css_id . '{
				font-size:' . $css_desktop_number_size . 'px !important;
			}
		}
		';
		$ive .= '</style>';
		//drop in the dashboard
		$ive .=  '<div id="'.esc_attr($id."-dashboard").'" class="'.esc_attr($style."-dashboard").'">';

		if(!empty($date_arr['years']) && $displayyears == 'true'){
			$class = $style.'-dash '.$style.'-years_dash';
			$next_year = '';
			if(isset($next_arr['next_year'])){
				$next_year = 'data-next="'.esc_attr($next_arr['next_year']).'"';
			}
			$ive .=  '<div class="'.esc_attr("countdown-width-height".$id." countdown-style-".$id." ".$class).'" '.$next_year.'"><div class="'.esc_attr("countdown-title-color-".$id." ".$style."-dash_title").'">'.esc_html($years).'</div>';
			foreach( $date_arr['years'] AS $digit ){
				$ive .=  '<div class="'.esc_attr("countdown-number-fontsize-".$id." ".$style."-digit").'" data-digit="'.esc_attr($digit).'">'.esc_html($digit).'</div>';
			}
			$ive .= '</div>';
		}

		if(!empty($date_arr['months']) && $displaymonths == 'true'){
			$class = $style.'-dash '.$style.'-months_dash';
			$next_month = '';
			if(isset($next_arr['next_month'])){
				$next_month = 'data-next="'.esc_attr($next_arr['next_month']).'"';
			}
			$ive .=  '<div class="'.esc_attr("countdown-width-height".$id." countdown-style-".$id." ".$class).'" '.$next_month.'><div class="'.esc_attr("countdown-title-color-".$id." ".$style."-dash_title").'">'.esc_html($months).'</div>';
			foreach( $date_arr['months'] AS $digit ){
				$ive .=  '<div class="'.esc_attr("countdown-number-fontsize-".$id." ".$style."-digit").'" data-digit="'.esc_attr($digit).'">'.esc_html($digit).'</div>';
			}
			$ive .= '</div>';
		}

		if($displayweeks == 'true'){
			$wclass = $style.'-dash '.$style.'-weeks_dash';
			$next_week = '';
			if(isset($next_arr['next_week'])){
				$next_week = 'data-next="'.esc_attr($next_arr['next_week']).'"';
			}
			$ive .=  '<div class="'.esc_attr("countdown-width-height".$id." countdown-style-".$id." ".$wclass).'" '.$next_week.'><div class="'.esc_attr("countdown-title-color-".$id." ".$style."-dash_title").'">'.esc_html($weeks).'</div>';
			foreach( $date_arr['weeks'] AS $digit ){
				$ive .=  '<div class="'.esc_attr('countdown-number-fontsize-'.$id.' '.$style.'-digit').'" data-digit="'.esc_attr($digit).'">'.esc_html($digit).'</div>';
			}
			$ive .= '</div>';
		}

		$dclass = $style.'-dash '.$style.'-days_dash';
		$ive .= '<div class="'.esc_attr('countdown-width-height'.$id.' countdown-style-'.$id.' '.$dclass).'" data-next="'.esc_attr($next_arr['next_day']).'"><div class="'.esc_attr("countdown-title-color-".$id." ".$style."-dash_title").'">'.esc_html($days).'</div>';
		foreach( $date_arr['days'] AS $digit ){
			$ive .=  '<div class="'.esc_attr('countdown-number-fontsize-'.$id.' '.$style.'-digit').'" data-digit="'.esc_attr($digit).'">'.esc_html($digit).'</div>';
		}
		$ive .= '</div>';

		$ive .= '<div class="'.esc_attr('countdown-width-height'.$id.' countdown-style-'.$id.' '.$style.'-dash '.$style.'-hours_dash').'" data-current="'.esc_attr($current_hours).'">';
			$ive .= '<div class="'.esc_attr("countdown-title-color-".$id." ".$style."-dash_title").'">'.esc_html($hours).'</div>';
			foreach( $date_arr['hours'] AS $digit ){
				$ive .=  '<div class="'.esc_attr('countdown-number-fontsize-'.$id.' '.$style.'-digit').'" data-digit="'.esc_attr($digit).'">'.esc_html($digit).'</div>';
			}
		$ive .= '</div>';

		$ive .= '<div class="'.esc_attr('countdown-width-height'.$id.' countdown-style-'.$id.' '.$style.'-dash '.$style.'-minutes_dash').'" data-current="'.esc_attr($current_minutes).'">';
			$ive .= '<div class="'.esc_attr("countdown-title-color-".$id." ".$style."-dash_title").'">'.esc_html($minutes).'</div>';
			foreach( $date_arr['mins'] AS $digit ){
				$ive .=  '<div class="'.esc_attr('countdown-number-fontsize-'.$id.' '.$style.'-digit').'" data-digit="'.esc_attr($digit).'">'.esc_html($digit).'</div>';
			}
		$ive .= '</div>';

		if($displayseconds == 'true'){
				$ive .= '<div class="'.esc_attr('countdown-width-height'.$id.' countdown-style-'.$id.' '.$style.'-dash '.$style.'-seconds_dash').'">';
					$ive .= '<div class="'.esc_attr("countdown-title-color-".$id." ".$style."-dash_title").'">'.esc_html($seconds).'</div>';
					foreach( $date_arr['secs'] AS $digit ){
						$ive .=  '<div class="'.esc_attr('countdown-number-fontsize-'.$id.' '.$style.'-digit').'" data-digit="'.esc_attr($digit).'">'.esc_html($digit).'</div>';
					}
				$ive .= '</div>';
		}

		$ive .= '</div>'; //close the dashboard

		$ive .= '<div id="'.esc_attr($id.'-bothtml').'" class="'.esc_attr($style.'-bothtml').'">';
		if($after){
			$ive .= wp_kses_post($after);
		}
		$ive .= '</div></div></div>';

		if(is_numeric($launchwidth)){
			$launchwidth .= 'px';
		}
		if(is_numeric($launchheight)){
			$launchheight .= 'px';
		}
		$content = json_encode(do_shortcode($content));
		$content = str_replace(array('\r\n', '\r', '\n<p>', '\n', '""'), '', $content);
		
		$ive .= "<script language='javascript' type='text/javascript'>
		jQuery(document).ready(function($) {
				$('#".esc_js($id)."-dashboard').iveCountDown({
					targetDate: {
						'day': 	".esc_js($day).",
						'month': ".esc_js($month).",
						'year': ".esc_js($year).",
						'hour': ".esc_js($hour).",
						'min': 	".esc_js($min).",
						'sec': 	".esc_js($sec).",
						'localtime': '".esc_js($lt)."'
					},
					style: '".esc_js($style)."',
					id: '".esc_js($id)."',
					event_id: '".esc_js($event_id)."',
					debug: '".esc_js($debug)."',
					launchtarget: '".esc_js($launchtarget)."'";
					
					if(!empty($content)){
						$ive .= ", onComplete: function() {
							$('#".esc_js($id)."-".esc_js($launchtarget)."').css({'width' : '". esc_js($launchwidth)."', 'height' : '".esc_js($launchheight)."'});
							$('#".esc_js($id)."-".esc_js($launchtarget)."').html(".wp_kses_post($content).");
							}";
		}
		$ive .= "});
			});
		</script>";

		if(!empty($debug)){
			$ive .= '<pre>Now: ' . $now->format('Y-m-d H:i:s e');
			$formated_target = new DateTime($t, $this->get_wp_timezone());
			$ive .= '<br/>Target: ' . $formated_target->format('Y-m-d H:i:s e');

			$interval = $formated_target->diff($now);
			$ive .= '<br/>Time to Target: ' . $interval->format('%a days %h hours %i mins. %s secs.');

			//rest now values
			$ive .= '<br/>Browser Now (JS): <span id="'.esc_attr($id.'-jsnow').'">loading...</span>';
			$ive .= '<br/>Timezone Delta: <span id="'.esc_attr($id.'-jstzone').'">loading...</span>';
			$ive .= '<br/>Rest Now (JS): <span id="'.esc_attr($id.'-jstime').'">loading...</span>';
			$ive .= '<br/>Time to Target: <span id="'.esc_attr($id.'-jsdiff').'">loading...</span>';
			$ive .= '<br/>Time Cached: <span id="'.esc_attr($id.'-jscached').'">loading...</span>';

			$ive .= '</pre>';
		}

		return $ive;
	}

}
$WP_Ivecountdown = new WP_Ivecountdown;