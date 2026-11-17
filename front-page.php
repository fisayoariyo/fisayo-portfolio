<?php
/**
 * Front page template.
 *
 * @package Fisayo_Portfolio
 */

get_header();
?>

<?php get_template_part( 'template-parts/hero' ); ?>
<?php get_template_part( 'template-parts/projects-grid' ); ?>
<?php get_template_part( 'template-parts/about' ); ?>
<?php get_template_part( 'template-parts/skills' ); ?>
<?php get_template_part( 'template-parts/contact' ); ?>

<?php
get_footer();
