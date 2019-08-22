<?php
/**
* @package snow-monkey-footer-cta
* @author inc2734
* @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\FooterCTA\App\Controller;

use Framework\Helper;

class Customizer {

	public function __construct() {
		add_action( 'snow_monkey_post_load_customizer', [ $this, '_load_customizer' ] );
	}

	/**
	 * Loads customizer
	 */
	public function _load_customizer() {
		Helper::include_files( SNOW_MONKEY_FOOTER_CTA_PATH . '/customizer' );
	}
}
