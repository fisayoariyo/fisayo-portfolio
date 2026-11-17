<?php
/**
 * Skills section.
 *
 * @package Fisayo_Portfolio
 */

$skills_raw = fisayo_portfolio_mod( 'fisayo_skills_list', '' );
$lines      = array_filter( array_map( 'trim', explode( "\n", $skills_raw ) ) );
?>
<section class="skills section" id="skills">
	<div class="container">
		<div class="section-head reveal">
			<p class="section-head__label"><?php esc_html_e( 'Skills', 'fisayo-portfolio' ); ?></p>
			<h2 class="section-head__title"><?php esc_html_e( 'Technologies I Work With', 'fisayo-portfolio' ); ?></h2>
		</div>

		<?php if ( $lines ) : ?>
			<div class="skills-grid">
				<?php foreach ( $lines as $line ) : ?>
					<?php
					$parts    = explode( ':', $line, 2 );
					$category = trim( $parts[0] );
					$items    = isset( $parts[1] ) ? array_map( 'trim', explode( ',', $parts[1] ) ) : array();
					?>
					<div class="skill-group reveal">
						<h3 class="skill-group__title"><?php echo esc_html( $category ); ?></h3>
						<ul class="skill-group__list">
							<?php foreach ( $items as $item ) : ?>
								<?php if ( $item ) : ?>
									<li class="skill-group__item"><?php echo esc_html( $item ); ?></li>
								<?php endif; ?>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
