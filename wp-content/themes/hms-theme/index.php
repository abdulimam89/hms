<?php
/**
 * Main template fallback: post list.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<ul class="post-list">
<?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <li>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <p class="entry-meta"><?php echo esc_html( get_the_date() ); ?></p>
      <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30 ) ); ?></p>
    </li>
  <?php endwhile; ?>
  <?php the_posts_pagination(); ?>
<?php else : ?>
  <li><p><?php esc_html_e( 'No posts yet.', 'hms-theme' ); ?></p></li>
<?php endif; ?>
</ul>

<?php get_footer(); ?>
