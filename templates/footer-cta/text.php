<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

$text    = get_theme_mod( 'footer-cta-text' );
$text_pc = get_theme_mod( 'footer-cta-text-pc' );

if ( ! $text ) {
	return;
}

$classes = [
	'p-footer-cta__text',
];
if ( $text_pc ) {
	$classes[] = 'u-invisible-md-up';
}
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php echo wp_kses_post( $text ); ?>
</div>

<?php
if ( ! $text_pc ) {
	return;
}

$classes = [
	'p-footer-cta__text',
	'p-footer-cta__text--pc',
	'u-invisible-sm',
];
?>

<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<?php echo wp_kses_post( $text_pc ); ?>
</div>
