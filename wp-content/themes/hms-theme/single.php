<?php
/**
 * Single post template.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class(); ?>>
    <h1><?php the_title(); ?></h1>
    <p class="entry-meta">
      <?php
      printf(
          /* translators: %s: published date */
          esc_html__( 'Published %s', 'hms-theme' ),
          esc_html( get_the_date() )
      );
      ?>
    </p>

    <?php if ( has_tag( 'affiliate' ) || hms_post_has_affiliate_links() ) : ?>
      <p class="disclosure-box">
        <?php esc_html_e( 'Disclosure: this post contains affiliate links. If you make a purchase through one of these links, we may earn a commission at no extra cost to you.', 'hms-theme' ); ?>
        <a href="<?php echo esc_url( home_url( '/affiliate-disclosure/' ) ); ?>"><?php esc_html_e( 'Learn more.', 'hms-theme' ); ?></a>
      </p>
    <?php endif; ?>

    <div class="entry-content">
      <?php the_content(); ?>
    </div>
  </article>
<?php endwhile; ?>

<?php get_footer(); ?>
