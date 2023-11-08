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
	'footer-cta-text-pc',
	array(
		'title'       => __( 'Text (Tablet & PC)', 'snow-monkey-footer-cta' ),
		'description' => __( 'If set, use this text on PCs and tablets. This is not used if either the text has not been entered.', 'snow-monkey-footer-cta' ),
		'priority'    => 131,
	)
);
