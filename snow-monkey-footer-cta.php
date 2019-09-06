<?php
/**
 * Plugin name: Snow Monkey Footer CTA
 * Description: Display CTA to the site footer. When this plug-in is activated, the sticky footer navigation is not displayed.
 * Version: 0.2.1
 * Author: inc2734
 * Author URI: https://2inc.org
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: snow-monkey-footer-cta
 *
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

namespace Snow_Monkey\Plugin\FooterCTA;

use Snow_Monkey\Plugin\FooterCTA\App\Controller;
use Framework\Helper;

define( 'SNOW_MONKEY_FOOTER_CTA_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'SNOW_MONKEY_FOOTER_CTA_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

class Bootstrap {

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, '_plugins_loaded' ] );
	}

	public function _plugins_loaded() {
		load_plugin_textdomain( 'snow-monkey-footer-cta', false, basename( __DIR__ ) . '/languages' );

		add_action( 'init', [ $this, '_activate_autoupdate' ] );

		$theme = wp_get_theme( get_template() );
		if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
			add_action( 'admin_notices', [ $this, '_admin_notice_no_snow_monkey' ] );
			return;
		}

		if ( ! version_compare( $theme->get( 'Version' ), '7.10.5', '>=' ) ) {
			add_action( 'admin_notices', [ $this, '_admin_notice_invalid_snow_monkey_version' ] );
			return;
		}

		new Controller\Front();
		new Controller\Customizer();
	}

	/**
	 * Activate auto update using GitHub
	 *
	 * @return void
	 */
	public function _activate_autoupdate() {
		new \Inc2734\WP_GitHub_Plugin_Updater\Bootstrap(
			plugin_basename( __FILE__ ),
			'inc2734',
			'snow-monkey-footer-cta'
		);
	}

	/**
	 * Admin notice for no Snow Monkey
	 *
	 * @return void
	 */
	public function _admin_notice_no_snow_monkey() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( '[Snow Monkey Footer CTA] Needs the Snow Monkey.', 'snow-monkey-footer-cta' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Admin notice for invalid Snow Monkey version
	 *
	 * @return void
	 */
	public function _admin_notice_invalid_snow_monkey_version() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p>
				<?php esc_html_e( '[Snow Monkey Footer CTA] Needs the Snow Monkey v7.9 or more.', 'snow-monkey-footer-cta' ); ?>
			</p>
		</div>
		<?php
	}
}

require_once( SNOW_MONKEY_FOOTER_CTA_PATH . '/vendor/autoload.php' );
new Bootstrap();
