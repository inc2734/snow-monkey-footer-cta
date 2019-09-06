<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

$label = get_theme_mod( 'footer-cta-secondary-btn-label' );
$url   = get_theme_mod( 'footer-cta-secondary-btn-url' );

if ( ! $url || ! $label ) {
	return;
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
	class="c-btn c-btn--full p-footer-cta__secondary-btn"
	href="<?php echo esc_url( $url ); ?>"
	<?php foreach ( $attributes as $attribute => $value ) : ?>
		<?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
	<?php endforeach; ?>
>
	<?php echo esc_html( $label ); ?>
</a>
