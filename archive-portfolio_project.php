<?php
/**
 * Projects archive template.
 *
 * @package Fisayo_Portfolio
 */

get_header();
?>

<div class="container section">
	<header class="section-head reveal">
		<p class="section-head__label"><?php esc_html_e( 'Portfolio', 'fisayo-portfolio' ); ?></p>
		<h1 class="section-head__title"><?php post_type_archive_title(); ?></h1>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="projects-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/project', 'card' );
			endwhile;
			?>
		</div>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'No projects found.', 'fisayo-portfolio' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
