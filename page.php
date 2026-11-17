<?php
/**
 * Default page template.
 *
 * @package Fisayo_Portfolio
 */

get_header();
?>

<div class="container section">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		<article <?php post_class( 'reveal is-visible' ); ?>>
			<h1 class="section-head__title"><?php the_title(); ?></h1>
			<div class="project-single__content"><?php the_content(); ?></div>
		</article>
	<?php endwhile; ?>
</div>

<?php
get_footer();
