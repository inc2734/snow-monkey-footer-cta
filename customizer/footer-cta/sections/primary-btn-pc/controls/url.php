<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'footer-cta-primary-btn-pc-url',
	array(
		'label'           => __( 'URL', 'snow-monkey-footer-cta' ),
		'default'         => '',
		'priority'        => 120,
		'active_callback' => function() {
			return get_theme_mod( 'footer-cta-primary-btn-url' );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-primary-btn-pc' );
$control = Framework::get_control( 'footer-cta-primary-btn-pc-url' );
$control->join( $section )->join( $panel );
