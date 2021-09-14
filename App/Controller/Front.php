<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\FooterCTA\App\Controller;

use Framework\Helper;

class Front {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, '_wp_enqueue_scripts' ] );
		add_action( 'inc2734_wp_customizer_framework_load_styles', [ $this, '_load_styles' ], 11 );

		add_filter( 'inc2734_wp_view_controller_expand_get_template_part', [ $this, '_expand_get_template_part' ], 11, 2 );
		add_action(
			'after_setup_theme',
			function() {
				foreach ( Helper::glob_recursive( SNOW_MONKEY_FOOTER_CTA_PATH . '/templates' ) as $file ) {
					$slug = rtrim( str_replace( SNOW_MONKEY_FOOTER_CTA_PATH . '/templates/', '', $file ), '.php' );
					add_filter(
						'snow_monkey_template_part_root_hierarchy_' . $slug,
						[ $this, '_template_part_root_hierarchy' ]
					);
				}
			}
		);
		add_filter( 'snow_monkey_pre_template_part_render_template-parts/nav/footer-sticky', '__return_false', 9 );
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
			SNOW_MONKEY_FOOTER_CTA_URL . '/dist/js/app.js',
			[ Helper::get_main_script_handle() . '-footer-sticky-nav' ],
			filemtime( SNOW_MONKEY_FOOTER_CTA_PATH . '/dist/js/app.js' ),
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
	 * Expand get_template_part().
	 *
	 * @param boolean $expand If true, expand get_template_part().
	 * @param array   $args   The template part args.
	 * @return boolean
	 */
	public function _expand_get_template_part( $expand, $args ) {
		if (
			'template-parts/nav/footer-sticky' === $args['slug']
			|| 'footer-cta' === $args['slug']
			|| 0 === strpos( $args['slug'], 'footer-cta/' )
		) {
			return true;
		}
		return $expand;
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
	 * @param array $hierarchy Array of template roots.
	 * @return string
	 */
	public function _template_part_root_hierarchy( $hierarchy ) {
		$hierarchy[] = SNOW_MONKEY_FOOTER_CTA_PATH . '/templates';
		$hierarchy   = array_unique( $hierarchy );
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
