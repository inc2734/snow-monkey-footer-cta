<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'color',
	'footer-cta-secondary-btn-background-color',
	array(
		'label'    => __( 'Background color', 'snow-monkey-footer-cta' ),
		'default'  => '#fab82b',
		'priority' => 100,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-secondary-btn' );
$control = Framework::get_control( 'footer-cta-secondary-btn-background-color' );
$control->join( $section )->join( $panel );
