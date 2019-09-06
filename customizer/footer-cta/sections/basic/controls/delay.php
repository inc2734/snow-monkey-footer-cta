<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'number',
	'footer-cta-delay',
	[
		'label'    => __( 'Scroll amount(px) to display', 'snow-monkey-footer-cta' ),
		'default'  => 0,
		'priority' => 120,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-basic' );
$control = Framework::get_control( 'footer-cta-delay' );
$control->join( $section )->join( $panel );
