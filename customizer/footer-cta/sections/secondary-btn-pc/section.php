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
	'footer-cta-secondary-btn-pc',
	array(
		'title'       => __( 'Secondary button (Tablet & PC)', 'snow-monkey-footer-cta' ),
		'description' => __( 'If set, use this button on PCs and tablets. This button is not used if either the label or the URL has not been entered.', 'snow-monkey-footer-cta' ),
		'priority'    => 121,
	)
);
