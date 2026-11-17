<?php
/**
 * Projects grid with stack filter.
 *
 * @package Fisayo_Portfolio
 */

$stack_filters = fisayo_portfolio_stack_filters();

$projects = new WP_Query(
	array(
		'post_type'      => 'portfolio_project',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
	)
);
?>
<section class="work section" id="work">
	<div class="container">
		<div class="section-head reveal">
			<p class="section-head__label"><?php esc_html_e( 'Selected Work', 'fisayo-portfolio' ); ?></p>
			<h2 class="section-head__title"><?php esc_html_e( 'Projects I\'ve Built', 'fisayo-portfolio' ); ?></h2>
			<p class="section-head__desc"><?php esc_html_e( 'Browse by stack — WordPress, React / Next.js, WooCommerce, and specialized builds.', 'fisayo-portfolio' ); ?></p>
		</div>

		<div class="filter reveal" role="tablist" aria-label="<?php esc_attr_e( 'Filter by stack', 'fisayo-portfolio' ); ?>">
			<button class="filter__btn is-active" type="button" data-filter="all" role="tab" aria-selected="true">
				<?php esc_html_e( 'All', 'fisayo-portfolio' ); ?>
			</button>
			<?php foreach ( $stack_filters as $slug => $label ) : ?>
				<button class="filter__btn" type="button" data-filter="<?php echo esc_attr( $slug ); ?>" role="tab" aria-selected="false">
					<?php echo esc_html( $label ); ?>
				</button>
			<?php endforeach; ?>
		</div>

		<?php if ( $projects->have_posts() ) : ?>
			<div class="projects-grid">
				<?php
				while ( $projects->have_posts() ) :
					$projects->the_post();
					get_template_part( 'template-parts/project', 'card' );
				endwhile;
				?>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p class="empty-state reveal"><?php esc_html_e( 'No projects yet. Add projects from wp-admin → Projects.', 'fisayo-portfolio' ); ?></p>
		<?php endif; ?>
	</div>
</section>
