<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'footer-cta-text-pc-color',
	array(
		'label'           => __( 'Text color', 'snow-monkey-footer-cta' ),
		'default'         => false,
		'priority'        => 110,
		'active_callback' => function () {
			return (bool) get_theme_mod( 'footer-cta-text' );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-text-pc' );
$control = Framework::get_control( 'footer-cta-text-pc-color' );
$control->join( $section )->join( $panel );
