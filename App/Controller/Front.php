<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\FooterCTA\App\Controller;

use Framework\Helper;

class Front {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, '_wp_enqueue_scripts' ] );
		add_action( 'inc2734_wp_customizer_framework_load_styles', [ $this, '_load_styles' ], 11 );

		add_filter( 'snow_monkey_template_part_root_hierarchy', [ $this, '_template_part_root_hierarchy' ], 10, 2 );
		add_action( 'snow_monkey_get_template_part_template-parts/nav/footer-sticky', '__return_false' );
		add_action( 'wp_footer', [ $this, '_display_footer_cta' ] );
	}

	/**
	 * Enqueue assets
	 *
	 * @return void
	 */
	public function _wp_enqueue_scripts() {
		wp_enqueue_style(
			'snow-monkey-footer-cta',
			SNOW_MONKEY_FOOTER_CTA_URL . '/dist/css/app.min.css',
			[ Helper::get_main_style_handle() ],
			filemtime( SNOW_MONKEY_FOOTER_CTA_PATH . '/dist/css/app.min.css' )
		);

		wp_enqueue_script(
			'snow-monkey-footer-cta',
			SNOW_MONKEY_FOOTER_CTA_URL . '/dist/js/app.min.js',
			[ Helper::get_main_script_handle() . '-footer-sticky-nav' ],
			filemtime( SNOW_MONKEY_FOOTER_CTA_PATH . '/dist/js/app.min.js' ),
			true
		);

		wp_localize_script(
			'snow-monkey-footer-cta',
			'snow_monkey_footer_cta',
			[
				'delay' => get_theme_mod( 'footer-cta-delay' ),
			]
		);
	}

	/**
	 * Load PHP files for styles
	 *
	 * @return void
	 */
	public function _load_styles() {
		Helper::include_files( SNOW_MONKEY_FOOTER_CTA_PATH . '/dist/css' );
	}

	/**
	 * Add hierarchy for footer-cta templates
	 *
	 * @param array $hierarchy
	 * @param string $slug
	 * @return string
	 */
	public function _template_part_root_hierarchy( $hierarchy, $slug ) {
		if ( 'footer-cta' === $slug || 0 === strpos( $slug, 'footer-cta/' ) ) {
			$hierarchy[] = SNOW_MONKEY_FOOTER_CTA_PATH . '/templates';
			$hierarchy   = array_unique( $hierarchy );
		}
		return $hierarchy;
	}

	/**
	 * Display CTA to the site footer
	 *
	 * @return void
	 */
	public function _display_footer_cta() {
		Helper::get_template_part( 'footer-cta' );
	}
}
