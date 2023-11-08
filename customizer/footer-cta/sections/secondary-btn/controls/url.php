<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Framework;

Framework::control(
	'text',
	'footer-cta-secondary-btn-url',
	array(
		'label'    => __( 'URL', 'snow-monkey-footer-cta' ),
		'default'  => '',
		'priority' => 120,
	)
);

if ( ! is_customize_preview() ) {
	return;
}

$panel   = Framework::get_panel( 'footer-cta' );
$section = Framework::get_section( 'footer-cta-secondary-btn' );
$control = Framework::get_control( 'footer-cta-secondary-btn-url' );
$control->join( $section )->join( $panel );
