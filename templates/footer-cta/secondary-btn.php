<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

$label = get_theme_mod( 'footer-cta-secondary-btn-label' );
$url   = get_theme_mod( 'footer-cta-secondary-btn-url' );

$label_pc = get_theme_mod( 'footer-cta-secondary-btn-pc-label' );
$url_pc   = get_theme_mod( 'footer-cta-secondary-btn-pc-url' );

if ( ! $label || ! $url ) {
	return;
}

$classes = [
	'c-btn',
	'c-btn--full',
	'p-footer-cta__secondary-btn',
];
if ( $label_pc && $url_pc ) {
	$classes[] = 'u-hidden-md-up';
}

$attributes = [];
if ( get_theme_mod( 'footer-cta-secondary-btn-blank' ) ) {
	$attributes = [
		'target' => '_blank',
		'rel'    => 'noopener',
	];
}
?>

<a
	class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
	href="<?php echo esc_url( $url ); ?>"
	<?php foreach ( $attributes as $attribute => $value ) : ?>
		<?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
	<?php endforeach; ?>
>
	<?php echo esc_html( $label ); ?>
</a>

<?php
if ( ! $label_pc || ! $url_pc ) {
	return;
}

$classes = [
	'c-btn',
	'c-btn--full',
	'p-footer-cta__secondary-btn',
	'p-footer-cta__secondary-btn--pc',
	'u-hidden',
	'u-visible-md-up',
];

$attributes = [];
if ( get_theme_mod( 'footer-cta-secondary-btn-pc-blank' ) ) {
	$attributes = [
		'target' => '_blank',
		'rel'    => 'noopener',
	];
}
?>

<a
	class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>"
	href="<?php echo esc_url( $url_pc ); ?>"
	<?php foreach ( $attributes as $attribute => $value ) : ?>
		<?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
	<?php endforeach; ?>
>
	<?php echo esc_html( $label_pc ); ?>
</a>
