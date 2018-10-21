<?php
/**
 * Register customizer panels & sections for Easy Digital Downloads.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2018, Astra
 * @link        https://wpastra.com/
 * @since       Astra x.x.x
 */

if ( ! class_exists( 'Astra_Customizer_Register_Edd_Section' ) ) {

	/**
	 * Customizer Sanitizes Initial setup
	 */
	class Astra_Customizer_Register_Edd_Section extends Astra_Customizer_Config_Base {

		/**
		 * Register Panels and Sections for Customizer.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since x.x.x
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {

			$configs = array(
				/**
				 * WooCommerce
				 */
				array(
					'name'     => 'section-edd-group',
					'type'     => 'section',
					'title'    => __( 'Easy Digital Downloads', 'astra' ),
					'panel'    => 'panel-layout',
					'priority' => 70,
				),

				array(
					'name'     => 'section-edd-archive',
					'title'    => __( 'Product Archive', 'astra' ),
					'type'     => 'section',
					'panel'    => 'panel-layout',
					'section'  => 'section-edd-group',
					'priority' => 10,
				),

				array(
					'name'     => 'section-edd-single',
					'type'     => 'section',
					'title'    => __( 'Single Product', 'astra' ),
					'panel'    => 'panel-layout',
					'section'  => 'section-edd-group',
					'priority' => 15,
				),
			);

			return array_merge( $configurations, $configs );
		}
	}
}


new Astra_Customizer_Register_Edd_Section();
