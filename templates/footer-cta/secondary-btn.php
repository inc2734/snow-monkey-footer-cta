<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

$label = get_theme_mod( 'footer-cta-secondary-btn-label' );
$url   = get_theme_mod( 'footer-cta-secondary-btn-url' );
$blank = get_theme_mod( 'footer-cta-secondary-btn-blank' ) ? 'blank' : 'self';

if ( ! $url || ! $label ) {
	return;
}
?>

<a class="c-btn c-btn--full p-footer-cta__secondary-btn" href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $blank ); ?>">
	<?php echo esc_html( $label ); ?>
</a>
