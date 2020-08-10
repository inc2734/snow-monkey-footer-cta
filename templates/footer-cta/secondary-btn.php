<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

$label = get_theme_mod( 'footer-cta-secondary-btn-label' );
$url   = get_theme_mod( 'footer-cta-secondary-btn-url' );
$blank = get_theme_mod( 'footer-cta-secondary-btn-blank' );

$label_pc = get_theme_mod( 'footer-cta-secondary-btn-pc-label' );
$url_pc   = get_theme_mod( 'footer-cta-secondary-btn-pc-url' );
$blank_pc = get_theme_mod( 'footer-cta-secondary-btn-pc-blank' );

if ( ! $label || ! $url ) {
	return;
}

$classes = [
	'c-btn',
	'c-btn--full',
	'p-footer-cta__secondary-btn',
];
if ( $label_pc && $url_pc ) {
	$classes[] = 'u-invisible-md-up';
}

$attributes = [];
if ( $blank ) {
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
	'u-invisible-sm',
];

$attributes = [];
if ( $blank_pc ) {
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
