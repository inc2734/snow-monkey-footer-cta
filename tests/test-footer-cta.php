<?php

use Snow_Monkey\Plugin\FooterCTA\App\Controller\Front;

class Footer_CTA_Test extends WP_UnitTestCase {

	private function render_template( $name ) {
		ob_start();
		try {
			include SNOW_MONKEY_FOOTER_CTA_PATH . '/templates/' . $name . '.php';
			return ob_get_contents();
		} finally {
			ob_end_clean();
		}
	}

	public function test_snow_monkey_and_front_controller_are_loaded() {
		$this->assertTrue( class_exists( 'Framework\Helper' ) );
		$this->assertSame( 'snow-monkey', get_template() );
		$this->assertSame( 9, has_filter( 'snow_monkey_pre_template_part_render_template-parts/nav/footer-sticky', '__return_false' ) );
	}

	public function test_empty_settings_do_not_render_cta() {
		$this->assertSame( '', $this->render_template( 'footer-cta' ) );
	}

	public function test_text_renders_hidden_cta() {
		set_theme_mod( 'footer-cta-text', 'Contact us' );
		$html = $this->render_template( 'footer-cta' );
		$this->assertStringContainsString( 'id="footer-sticky-nav"', $html );
		$this->assertStringContainsString( 'aria-hidden="true"', $html );
		$this->assertStringContainsString( 'p-footer-cta__close-btn', $html );
	}

	public function test_primary_button_preserves_mobile_and_desktop_links() {
		set_theme_mod( 'footer-cta-primary-btn-label', 'Mobile <CTA>' );
		set_theme_mod( 'footer-cta-primary-btn-url', 'https://example.org/mobile' );
		set_theme_mod( 'footer-cta-primary-btn-blank', true );
		set_theme_mod( 'footer-cta-primary-btn-pc-label', 'Desktop CTA' );
		set_theme_mod( 'footer-cta-primary-btn-pc-url', 'https://example.org/desktop' );
		$html = $this->render_template( 'footer-cta/primary-btn' );
		$this->assertStringContainsString( 'href="https://example.org/mobile"', $html );
		$this->assertStringContainsString( 'href="https://example.org/desktop"', $html );
		$this->assertStringContainsString( 'Mobile &lt;CTA&gt;', $html );
		$this->assertStringContainsString( 'target="_blank"', $html );
		$this->assertStringContainsString( 'rel="noopener"', $html );
		$this->assertStringContainsString( 'u-invisible-md-up', $html );
		$this->assertStringContainsString( 'u-invisible-sm', $html );
	}

	public function test_secondary_button_requires_label_and_url() {
		set_theme_mod( 'footer-cta-secondary-btn-label', 'Secondary CTA' );
		$this->assertSame( '', $this->render_template( 'footer-cta/secondary-btn' ) );
		set_theme_mod( 'footer-cta-secondary-btn-url', 'https://example.org/secondary' );
		$this->assertStringContainsString( 'href="https://example.org/secondary"', $this->render_template( 'footer-cta/secondary-btn' ) );
	}

	public function test_text_preserves_markup_and_responsive_variants() {
		set_theme_mod( 'footer-cta-text', '<strong>Mobile</strong><script>alert(1)</script>' );
		set_theme_mod( 'footer-cta-text-pc', 'Desktop' );
		$html = $this->render_template( 'footer-cta/text' );
		$this->assertStringContainsString( '<strong>Mobile</strong>', $html );
		$this->assertStringNotContainsString( '<script>', $html );
		$this->assertStringContainsString( 'Desktop', $html );
		$this->assertStringContainsString( 'u-invisible-md-up', $html );
		$this->assertStringContainsString( 'u-invisible-sm', $html );
	}

	public function test_built_assets_and_scroll_delay_are_registered() {
		set_theme_mod( 'footer-cta-delay', 300 );
		$front = new Front();
		$front->_wp_enqueue_scripts();
		$script = wp_scripts()->registered['snow-monkey-footer-cta'];
		$style  = wp_styles()->registered['snow-monkey-footer-cta'];
		$this->assertStringEndsWith( '/dist/js/app.js', $script->src );
		$this->assertStringEndsWith( '/dist/css/app.css', $style->src );
		$this->assertFileExists( SNOW_MONKEY_FOOTER_CTA_PATH . '/dist/js/app.js' );
		$this->assertFileExists( SNOW_MONKEY_FOOTER_CTA_PATH . '/dist/css/app.css' );
		$this->assertStringContainsString( '"delay":"300"', $script->extra['data'] );
	}
}
