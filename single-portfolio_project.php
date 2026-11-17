<?php
/**
 * Single project template.
 *
 * @package Fisayo_Portfolio
 */

get_header();

while ( have_posts() ) :
	the_post();
	$post_id   = get_the_ID();
	$accent    = fisayo_portfolio_project_meta( $post_id, 'accent_color', '#06B6D4' );
	$live_url  = fisayo_portfolio_project_meta( $post_id, 'live_url', '' );
	$repo_url  = fisayo_portfolio_project_meta( $post_id, 'repo_url', '' );
	$client    = fisayo_portfolio_project_meta( $post_id, 'client', '' );
	$role      = fisayo_portfolio_project_meta( $post_id, 'role', '' );
	$year      = fisayo_portfolio_project_meta( $post_id, 'year', '' );
	$highlight = fisayo_portfolio_project_meta( $post_id, 'highlight', '' );
	$terms     = get_the_terms( $post_id, 'project_category' );
	?>

	<article <?php post_class( 'project-single' ); ?> style="--project-accent: <?php echo esc_attr( $accent ); ?>">
		<div class="container project-single__inner">
			<header class="project-single__header reveal">
				<a href="<?php echo esc_url( home_url( '/#work' ) ); ?>" class="project-single__back">&larr; <?php esc_html_e( 'All Projects', 'fisayo-portfolio' ); ?></a>

				<?php if ( $terms && ! is_wp_error( $terms ) ) : ?>
					<p class="project-single__category"><?php echo esc_html( $terms[0]->name ); ?></p>
				<?php endif; ?>

				<h1 class="project-single__title"><?php the_title(); ?></h1>

				<?php if ( $highlight ) : ?>
					<p class="project-single__highlight"><?php echo esc_html( $highlight ); ?></p>
				<?php endif; ?>

				<dl class="project-single__meta">
					<?php if ( $client ) : ?>
						<div class="project-single__meta-item">
							<dt><?php esc_html_e( 'Client', 'fisayo-portfolio' ); ?></dt>
							<dd><?php echo esc_html( $client ); ?></dd>
						</div>
					<?php endif; ?>
					<?php if ( $role ) : ?>
						<div class="project-single__meta-item">
							<dt><?php esc_html_e( 'Role', 'fisayo-portfolio' ); ?></dt>
							<dd><?php echo esc_html( $role ); ?></dd>
						</div>
					<?php endif; ?>
					<?php if ( $year ) : ?>
						<div class="project-single__meta-item">
							<dt><?php esc_html_e( 'Year', 'fisayo-portfolio' ); ?></dt>
							<dd><?php echo esc_html( $year ); ?></dd>
						</div>
					<?php endif; ?>
				</dl>

				<div class="project-single__actions">
					<?php if ( $live_url ) : ?>
						<a href="<?php echo esc_url( $live_url ); ?>" class="btn btn--primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View Live Site', 'fisayo-portfolio' ); ?></a>
					<?php endif; ?>
					<?php if ( $repo_url ) : ?>
						<a href="<?php echo esc_url( $repo_url ); ?>" class="btn btn--ghost" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'View Code', 'fisayo-portfolio' ); ?></a>
					<?php endif; ?>
				</div>
			</header>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="project-single__hero reveal">
					<?php the_post_thumbnail( 'large', array( 'class' => 'project-single__img' ) ); ?>
				</div>
			<?php endif; ?>

			<div class="project-single__content reveal">
				<?php the_content(); ?>
			</div>

			<div class="project-single__stack reveal">
				<h2><?php esc_html_e( 'Tech Stack', 'fisayo-portfolio' ); ?></h2>
				<?php fisayo_portfolio_render_stack( $post_id ); ?>
			</div>
		</div>
	</article>

<?php endwhile; ?>

<?php
get_footer();
