<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'checkbox',
	'footer-cta-primary-btn-blank',
	[
		'label'    => __( 'Open new tab', 'snow-monkey-footer-cta' ),
		'default'  => false,
		'priority' => 130,
	]
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-primary-btn' );
$control = Framework::get_control( 'footer-cta-primary-btn-blank' );
$control->join( $section )->join( $panel );
