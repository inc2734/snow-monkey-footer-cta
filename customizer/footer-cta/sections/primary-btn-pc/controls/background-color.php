<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'footer-cta-primary-btn-pc-background-color',
	array(
		'label'           => __( 'Background color', 'snow-monkey-footer-cta' ),
		'default'         => false,
		'priority'        => 100,
		'active_callback' => function () {
			return (bool) get_theme_mod( 'footer-cta-primary-btn-url' )
					&& (bool) get_theme_mod( 'footer-cta-primary-btn-label' );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-primary-btn-pc' );
$control = Framework::get_control( 'footer-cta-primary-btn-pc-background-color' );
$control->join( $section )->join( $panel );
