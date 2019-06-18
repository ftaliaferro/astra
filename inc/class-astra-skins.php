<?php
/**
 * Skins of Astra Theme.
 *
 * @package     Astra
 * @subpackage  Class
 * @author      Astra
 * @copyright   Copyright (c) 2019, Astra
 * @link        https://wpastra.com/
 * @since       Astra x.x.x
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Skins
 */
if ( ! class_exists( 'Astra_Skins' ) ) {

	/**
	 * Astra_Skins
	 */
	class Astra_Skins {

		/**
		 * Constructor
		 */
		public function __construct() {
			add_filter( 'astra_theme_assets', array( $this, 'add_styles' ), 100 );
			add_filter( 'astra_attr_ast-comment-meta', array( $this, 'comment_meta_attributes' ) );
			add_filter( 'astra_comment_avatar_size', array( $this, 'comment_avatar_size' ) );
			add_filter( 'astra_theme_defaults', array( $this, 'set_default_skin' ) );
			add_filter( 'astra_comment_form_title', array( $this, 'comment_form_title' ) );
		}

		/**
		 * Add assets in theme
		 *
		 * @param array $assets list of theme assets (JS & CSS).
		 * @return array List of updated assets.
		 * @since x.x.x
		 */
		public function add_styles( $assets ) {
			if ( 'modern-skin' === self::astra_get_selected_skin() ) {
				$assets['css']['astra-modern-skin'] = 'skin-1';
			}

			if ( 'classic-skin' === self::astra_get_selected_skin() ) {
				$assets['css']['astra-classic-skin'] = 'skin-classic';
			}

			return $assets;
		}

		/**
		 * Add HTML attributes to comment markup.
		 *
		 * Conditionally add capitialize class to the comment markup.
		 *
		 * @since x.x.x
		 * @param Array $attr HTML attributes for the comments markup.
		 * @return void
		 */
		public function comment_meta_attributes( $attr ) {
			// Capitilize the Author name for the classic skin.
			if ( 'classic-skin' === self::astra_get_selected_skin() ) {
				$attr['class'] .= ' capitalize';
			}

			return $attr;
		}

		/**
		 * Change comment avatar size based on the skin that is selected.
		 *
		 * Classic skin uses smaller avatar, size 50.
		 *
		 * @since x.x.x
		 * @param int $size Avatar size.
		 * @return void
		 */
		public function comment_avatar_size( $size ) {
			// Reduce the avatar size when classic skin is used.
			if ( 'classic-skin' === self::astra_get_selected_skin() ) {
				$size = 50;
			}

			return $size;
		}

		/**
		 * Set default skin for the ocntent layout.
		 *
		 * @since x.x.x
		 * @param Array $defaults Array of default customizer settings
		 * @return Array
		 */
		public function set_default_skin( $defaults ) {
			$defaults['site-content-skin'] = 'modern-skin';

			return $defaults;
		}

		/**
		 * Change comment form title in case of Classic Skin.
		 * 
		 * @since x.x.x
		 * @param String $form_title HTML markup for the Comments Form title.
		 * @return String
		 */
		public function comment_form_title( $form_title ) {
			// Reduce the avatar size when classic skin is used.
			if ( 'classic-skin' === self::astra_get_selected_skin() ) {
				$form_title = sprintf( // WPCS: XSS OK.
					/* translators: 1: number of comments */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'astra' ) ),
					number_format_i18n( get_comments_number() ),
					get_the_title()
				);
			}

			return $form_title;
		}

		/**
		 * Get the skin selected from customizer for the site.
		 *
		 * @since x.x.x
		 * @return string Selected skin.
		 */
		public static function astra_get_selected_skin() {
			// If Addon is not updated to version 1.9.0-beta.1 then fallback to Classic Skin.
			if ( class_exists( 'Astra_Addon_Update' ) ) {
				$saved_version = Astra_Addon_Update::astra_addon_stored_version();
				if ( version_compare( $saved_version, '1.9.0-beta.1', '<' ) ) {
					return 'classic-skin';
				}
			}

			return apply_filters( 'astra_skin_switch', astra_get_option( 'site-content-skin' ) );
		}
	}
}

new Astra_Skins();
