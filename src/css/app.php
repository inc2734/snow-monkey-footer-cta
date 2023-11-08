<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Inc2734\WP_Customizer_Framework\Style;
use Inc2734\WP_Customizer_Framework\Color;

$background_color   = get_theme_mod( 'footer-cta-background-color' );
$background_opacity = get_theme_mod( 'footer-cta-background-opacity' );

$primary_btn_background_color   = get_theme_mod( 'footer-cta-primary-btn-background-color' );
$secondary_btn_background_color = get_theme_mod( 'footer-cta-secondary-btn-background-color' );
$text_color                     = get_theme_mod( 'footer-cta-text-color' );

$primary_btn_pc_url                = get_theme_mod( 'footer-cta-primary-btn-pc-url' );
$primary_btn_pc_background_color   = get_theme_mod( 'footer-cta-primary-btn-pc-background-color' );
$secondary_btn_pc_url              = get_theme_mod( 'footer-cta-secondary-btn-pc-url' );
$secondary_btn_pc_background_color = get_theme_mod( 'footer-cta-secondary-btn-pc-background-color' );

$text_pc       = get_theme_mod( 'footer-cta-text-pc' );
$text_pc_color = get_theme_mod( 'footer-cta-text-pc-color' );

Style::attach(
	'snow-monkey-footer-cta',
	array(
		array(
			'selectors'  => array( '.p-footer-cta.p-footer-cta' ),
			'properties' => array( 'background-color: ' . Color::rgba( $background_color, $background_opacity / 100 ) ),
		),
	)
);

Style::attach(
	'snow-monkey-footer-cta',
	array(
		array(
			'selectors'  => array( '.p-footer-cta__primary-btn' ),
			'properties' => array( 'background-color: ' . $primary_btn_background_color ),
		),
	)
);

Style::attach(
	'snow-monkey-footer-cta',
	array(
		array(
			'selectors'   => array(
				'.p-footer-cta__primary-btn:hover',
				'.p-footer-cta__primary-btn:active',
				'.p-footer-cta__primary-btn:focus',
			),
			'properties'  => array( 'background-color: ' . Color::darken( $primary_btn_background_color, 0.05 ) ),
			'media_query' => '@media (min-width: 64em)',
		),
	)
);

if ( $primary_btn_pc_url && $primary_btn_pc_background_color ) {
	Style::attach(
		'snow-monkey-footer-cta',
		array(
			array(
				'selectors'  => array( '.p-footer-cta__primary-btn--pc' ),
				'properties' => array( 'background-color: ' . $primary_btn_pc_background_color ),
			),
		)
	);

	Style::attach(
		'snow-monkey-footer-cta',
		array(
			array(
				'selectors'   => array(
					'.p-footer-cta__primary-btn--pc:hover',
					'.p-footer-cta__primary-btn--pc:active',
					'.p-footer-cta__primary-btn--pc:focus',
				),
				'properties'  => array( 'background-color: ' . Color::darken( $primary_btn_pc_background_color, 0.05 ) ),
				'media_query' => '@media (min-width: 64em)',
			),
		)
	);
}

Style::attach(
	'snow-monkey-footer-cta',
	array(
		array(
			'selectors'  => array( '.p-footer-cta__secondary-btn' ),
			'properties' => array( 'background-color: ' . $secondary_btn_background_color ),
		),
	)
);

Style::attach(
	'snow-monkey-footer-cta',
	array(
		array(
			'selectors'   => array(
				'.p-footer-cta__secondary-btn:hover',
				'.p-footer-cta__secondary-btn:active',
				'.p-footer-cta__secondary-btn:focus',
			),
			'properties'  => array( 'background-color: ' . Color::darken( $secondary_btn_background_color, 0.05 ) ),
			'media_query' => '@media (min-width: 64em)',
		),
	)
);

if ( $secondary_btn_pc_url && $secondary_btn_pc_background_color ) {
	Style::attach(
		'snow-monkey-footer-cta',
		array(
			array(
				'selectors'  => array( '.p-footer-cta__secondary-btn--pc' ),
				'properties' => array( 'background-color: ' . $secondary_btn_pc_background_color ),
			),
		)
	);

	Style::attach(
		'snow-monkey-footer-cta',
		array(
			array(
				'selectors'   => array(
					'.p-footer-cta__secondary-btn--pc:hover',
					'.p-footer-cta__secondary-btn--pc:active',
					'.p-footer-cta__secondary-btn--pc:focus',
				),
				'properties'  => array( 'background-color: ' . Color::darken( $secondary_btn_pc_background_color, 0.05 ) ),
				'media_query' => '@media (min-width: 64em)',
			),
		)
	);
}

Style::attach(
	'snow-monkey-footer-cta',
	array(
		array(
			'selectors'  => array( '.p-footer-cta__text' ),
			'properties' => array( 'color: ' . $text_color ),
		),
	)
);

if ( $text_pc && $text_pc_color ) {
	Style::attach(
		'snow-monkey-footer-cta',
		array(
			array(
				'selectors'  => array( '.p-footer-cta__text--pc' ),
				'properties' => array( 'color: ' . $text_pc_color ),
			),
		)
	);
}
