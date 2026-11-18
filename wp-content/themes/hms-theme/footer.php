<?php
/**
 * Theme footer.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</main>

<footer class="site-footer">
  <div class="wrap">
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'footer',
            'container'      => false,
            'fallback_cb'    => false,
        )
    );
    ?>
    <?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
      <?php dynamic_sidebar( 'footer-1' ); ?>
    <?php endif; ?>
    <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
