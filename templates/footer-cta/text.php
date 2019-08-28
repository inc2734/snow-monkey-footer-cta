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
?>

<div class="p-footer-cta__text">
	<?php echo wp_kses_post( $text ); ?>
</div>
