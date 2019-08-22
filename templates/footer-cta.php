<?php
/**
 * @package snow-monkey-footer-cta
 * @author inc2734
 * @license GPL-2.0+
 */

use Framework\Helper;

$text = get_theme_mod( 'footer-cta-text' );

$primary_btn_label = get_theme_mod( 'footer-cta-primary-btn-label' );
$primary_btn_url   = get_theme_mod( 'footer-cta-primary-btn-url' );
$primary_btn_blank = get_theme_mod( 'footer-cta-primary-btn-blank' ) ? 'blank' : 'self';

$secondary_btn_label = get_theme_mod( 'footer-cta-secondary-btn-label' );
$secondary_btn_url   = get_theme_mod( 'footer-cta-secondary-btn-url' );
$secondary_btn_blank = get_theme_mod( 'footer-cta-secondary-btn-blank' ) ? 'blank' : 'self';

if ( ! $text && ( ! $primary_btn_label || ! $primary_btn_url ) && ( ! $secondary_btn_label || ! $secondary_btn_url ) ) {
	return;
}
?>

<div class="p-footer-cta" id="footer-sticky-nav">
	<div class="c-container">
		<div class="c-row c-row--margin-s c-row--md-margin c-row--middle">
			<?php if ( ! $text ) : ?>
				<?php if ( $primary_btn_label && $primary_btn_url ) : // has primary btn ?>
					<?php if ( $secondary_btn_label && $secondary_btn_url ) : // has primary btn, and secondary btn ?>

						<div class="c-row__col c-row__col--1-2">
							<?php Helper::get_template_part( 'footer-cta/primary-btn' ); ?>
						</div>
						<div class="c-row__col c-row__col--1-2">
							<?php Helper::get_template_part( 'footer-cta/secondary-btn' ); ?>
						</div>

					<?php else : // has primary btn ?>

						<div class="c-row__col c-row__col--1-1">
							<?php Helper::get_template_part( 'footer-cta/primary-btn' ); ?>
						</div>

					<?php endif; ?>

				<?php elseif ( $secondary_btn_label && $secondary_btn_url ) : // has secondary btn ?>

					<div class="c-row__col c-row__col--1-1">
						<?php Helper::get_template_part( 'footer-cta/primary-btn' ); ?>
					</div>

				<?php endif; ?>

			<?php else : // has text ?>
				<?php if ( $primary_btn_label && $primary_btn_url ) : // has text and primary btn ?>
					<?php if ( $secondary_btn_label && $secondary_btn_url ) : // has text, primary btn and secondary btn ?>

							<div class="c-row__col c-row__col--1-1">
								<?php Helper::get_template_part( 'footer-cta/text' ); ?>
							</div>
						</div>
						<div class="c-row c-row--margin-s c-row--md-margin c-row--middle">
							<div class="c-row__col c-row__col--1-2">
								<?php Helper::get_template_part( 'footer-cta/primary-btn' ); ?>
							</div>
							<div class="c-row__col c-row__col--1-2">
								<?php Helper::get_template_part( 'footer-cta/secondary-btn' ); ?>
							</div>

					<?php else : // has text and primary btn ?>

						<div class="c-row__col c-row__col--1-2">
							<?php Helper::get_template_part( 'footer-cta/text' ); ?>
						</div>
						<div class="c-row__col c-row__col--1-2">
							<?php Helper::get_template_part( 'footer-cta/primary-btn' ); ?>
						</div>

					<?php endif; ?>
				<?php elseif ( $secondary_btn_label && $secondary_btn_url ) : // has text and secondary btn ?>

					<div class="c-row__col c-row__col--1-2">
						<?php Helper::get_template_part( 'footer-cta/text' ); ?>
					</div>
					<div class="c-row__col c-row__col--1-2">
						<?php Helper::get_template_part( 'footer-cta/secondary-btn' ); ?>
					</div>

				<?php else : // has text ?>

					<div class="c-row__col c-row__col--1-2">
						<?php Helper::get_template_part( 'footer-cta/text' ); ?>
					</div>

				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
