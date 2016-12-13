<?php

/**
 * The Enable Disabled Serbian Latin Google Fonts Plugin
 *
 * Enable enqueuing of Google fonts disabled in Serbian language package.
 *
 * @package Enable_Disabled_Serbian_Latin_Google_Fonts
 * @subpackage Main
 */

/**
 * Plugin Name: Enable Disabled Serbian Latin Google Fonts
 * Plugin URI:  http://blog.milandinic.com/wordpress/plugins/
 * Description: Enable enqueuing of Google fonts disabled in Serbian language package.
 * Author:      Milan Dinić
 * Author URI:  http://blog.milandinic.com/
 * Version:     1.0-beta-1
 * Text Domain: enable-disabled-serbian-latin-google-fonts
 * Domain Path: /languages/
 * License:     GPL
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * Initialize a plugin.
 *
 * Load class when all plugins are loaded
 * so that other plugins can overwrite it.
 */
add_action( 'plugins_loaded', array( 'Enable_Disabled_Serbian_Latin_Google_Fonts', 'get_instance' ), 10 );

class Enable_Disabled_Serbian_Latin_Google_Fonts {
	/**
	 * Constructor.
	 * 
	 * @since 1.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'register_theme_fonts_enabler' ), 1 );
	}

	/**
	 * Instantiate called class.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @return Enable_Disabled_Serbian_Latin_Google_Fonts $instance Instance of called class.
	 */
	public static function get_instance() {
		static $instance = false;

		if ( false === $instance ) {
			$instance = new self;
		}

		return $instance;
	}

	/**
	 * Force 'on' as a result of Source Sans Pro font toggler string translation.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param  string $translations Translated text.
	 * @param  string $text         Text to translate.
	 * @param  string $context      Context information for the translators.
	 * @param  string $domain       Text domain. Unique identifier for retrieving translated strings.
	 * @return string $translations Translated text.
	 */
	public function enable_source_sans_pro( $translations, $text, $context, $domain ) {
		if ( 'Source Sans Pro font: on or off' == $context && 'on' == $text ) {
			$translations = 'on';
		}

		return $translations;
	}

	/**
	 * Force 'on' as a result of Inconsolata font toggler string translation.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param  string $translations Translated text.
	 * @param  string $text         Text to translate.
	 * @param  string $context      Context information for the translators.
	 * @param  string $domain       Text domain. Unique identifier for retrieving translated strings.
	 * @return string $translations Translated text.
	 */
	public function enable_inconsolata( $translations, $text, $context, $domain ) {
		if ( 'Inconsolata font: on or off' == $context && 'on' == $text ) {
			$translations = 'on';
		}

		return $translations;
	}

	/**
	 * Force 'on' as a result of Libre Franklin font toggler string translation.
	 *
	 * @since 1.0
	 * @access public
	 *
	 * @param  string $translations Translated text.
	 * @param  string $text         Text to translate.
	 * @param  string $context      Context information for the translators.
	 * @param  string $domain       Text domain. Unique identifier for retrieving translated strings.
	 * @return string $translations Translated text.
	 */
	public function enable_libre_franklin( $translations, $text, $context, $domain ) {
		if ( 'Libre Franklin font: on or off' == $context && 'on' == $text ) {
			$translations = 'on';
		}

		return $translations;
	}

	/**
	 * Register filters that enable fonts for bundled themes.
	 *
	 * @since 1.0
	 * @access public
	 */
	public function register_theme_fonts_enabler() {
		$template = get_template();

		switch ( $template ) {
			case 'twentyseventeen' :
				add_filter( 'gettext_with_context', array( $this, 'enable_libre_franklin'  ), 888, 4 );
				break;
			case 'twentysixteen' :
			case 'twentyfifteen' :
				add_filter( 'gettext_with_context', array( $this, 'enable_inconsolata'     ), 888, 4 );
				break;
			case 'twentythirteen' :
				add_filter( 'gettext_with_context', array( $this, 'enable_source_sans_pro' ), 888, 4 );
				break;
		}
	}
}
