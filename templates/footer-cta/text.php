<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

$text = get_theme_mod( 'footer-cta-text' );

if ( ! $text ) {
	return;
}

echo wp_kses_post( $text );
