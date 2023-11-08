<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'footer-cta-text-pc',
	array(
		'label'           => __( 'Text', 'snow-monkey-footer-cta' ),
		'default'         => '',
		'priority'        => 100,
		'active_callback' => function() {
			return get_theme_mod( 'footer-cta-text' );
		},
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-text-pc' );
$control = Framework::get_control( 'footer-cta-text-pc' );
$control->join( $section )->join( $panel );
