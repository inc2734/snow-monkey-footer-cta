<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'footer-cta-secondary-btn-pc-label',
	[
		'label'           => __( 'Label', 'snow-monkey-footer-cta' ),
		'default'         => __( 'Button', 'snow-monkey-footer-cta' ),
		'priority'        => 110,
		'active_callback' => function() {
			return get_theme_mod( 'footer-cta-secondary-btn-url' );
		},
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-secondary-btn-pc' );
$control = Framework::get_control( 'footer-cta-secondary-btn-pc-label' );
$control->join( $section )->join( $panel );
