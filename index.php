<?php
/**
 * Fallback index template.
 *
 * @package Fisayo_Portfolio
 */

get_header();
?>

<div class="container section">
	<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<article <?php post_class( 'post-entry reveal' ); ?>>
				<h1 class="post-entry__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<div class="post-entry__content"><?php the_excerpt(); ?></div>
			</article>
		<?php endwhile; ?>
		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<p><?php esc_html_e( 'Nothing found.', 'fisayo-portfolio' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
