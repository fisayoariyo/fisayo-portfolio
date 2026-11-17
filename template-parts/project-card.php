<?php
/**
 * Project card partial.
 *
 * @package Fisayo_Portfolio
 */

$post_id      = get_the_ID();
$accent       = fisayo_portfolio_project_meta( $post_id, 'accent_color', '#06B6D4' );
$highlight    = fisayo_portfolio_project_meta( $post_id, 'highlight', '' );
$live_url     = fisayo_portfolio_project_meta( $post_id, 'live_url', '' );
$repo_url     = fisayo_portfolio_project_meta( $post_id, 'repo_url', '' );
$stack_slugs  = fisayo_portfolio_project_stack_slugs( $post_id );
$stack_label  = fisayo_portfolio_primary_stack_label( $post_id );
?>
<article
	class="project-card reveal<?php echo fisayo_portfolio_uses_logo_display( $post_id ) ? ' project-card--logo' : ''; ?>"
	data-stacks="<?php echo esc_attr( implode( ' ', $stack_slugs ) ); ?>"
	style="--project-accent: <?php echo esc_attr( $accent ); ?>"
>
	<a href="<?php the_permalink(); ?>" class="project-card__link">
		<div class="project-card__media">
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'project-card', array( 'class' => 'project-card__img' ) ); ?>
			<?php else : ?>
				<div class="project-card__placeholder">
					<span class="project-card__initial"><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
				</div>
			<?php endif; ?>
			<div class="project-card__overlay">
				<span class="project-card__view"><?php esc_html_e( 'View Project', 'fisayo-portfolio' ); ?></span>
			</div>
		</div>
		<div class="project-card__body">
			<?php if ( $stack_label ) : ?>
				<p class="project-card__category"><?php echo esc_html( $stack_label ); ?></p>
			<?php endif; ?>
			<h3 class="project-card__title"><?php the_title(); ?></h3>
			<?php if ( $highlight ) : ?>
				<p class="project-card__highlight"><?php echo esc_html( $highlight ); ?></p>
			<?php else : ?>
				<p class="project-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
			<?php endif; ?>
			<?php fisayo_portfolio_render_stack( $post_id ); ?>
		</div>
	</a>
	<div class="project-card__actions">
		<a href="<?php the_permalink(); ?>" class="project-card__action"><?php esc_html_e( 'Details', 'fisayo-portfolio' ); ?></a>
		<?php if ( $live_url ) : ?>
			<a href="<?php echo esc_url( $live_url ); ?>" class="project-card__action" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Live', 'fisayo-portfolio' ); ?></a>
		<?php endif; ?>
		<?php if ( $repo_url ) : ?>
			<a href="<?php echo esc_url( $repo_url ); ?>" class="project-card__action" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Code', 'fisayo-portfolio' ); ?></a>
		<?php endif; ?>
	</div>
</article>
