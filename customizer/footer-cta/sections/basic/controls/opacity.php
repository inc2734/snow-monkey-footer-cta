<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'number',
	'footer-cta-background-opacity',
	[
		'label'    => __( 'Opacity (%)', 'snow-monkey-footer-cta' ),
		'default'  => 100,
		'priority' => 110,
		'input_attrs' => [
			'min'  => 10,
			'step' => 10,
			'max'  => 100,
		],
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-basic' );
$control = Framework::get_control( 'footer-cta-background-opacity' );
$control->join( $section )->join( $panel );
