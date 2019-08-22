<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

if ( ! is_customize_preview() ) {
	return;
}

Framework::section(
	'footer-cta-text',
	[
		'title'    => __( 'Text', 'snow-monkey-footer-cta' ),
		'priority' => 130,
	]
);
