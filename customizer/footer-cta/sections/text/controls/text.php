<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'footer-cta-text',
	[
		'label'    => __( 'Text', 'snow-monkey-footer-cta' ),
		'default'  => '',
		'priority' => 100,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-text' );
$control = Framework::get_control( 'footer-cta-text' );
$control->join( $section )->join( $panel );
