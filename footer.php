<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Fluxo
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row">
			<div class="small-6 columns">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fluxo' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'fluxo' ), 'WordPress' ); ?></a>
				</div><!-- .site-info -->
			</div>
			<div class="small-6 columns">
				<div class="site-social text-right">
					<a href="#">GitHub</a>
					<a href="#">GitHub</a>
					<a href="#">GitHub</a>
					<a href="#">GitHub</a>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
