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

	<footer id="colophon" class="site-footer small-only-text-center" role="contentinfo">
		<div class="row">
			<div class="medium-6 columns">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fluxo' ) ); ?>"><?php printf( esc_html__( 'Orgulhosamente desenvolvido com %s', 'fluxo' ), 'WordPress' ); ?></a>
				</div><!-- .site-info -->
			</div>
			<div class="medium-6 columns">
				<div class="site-social site-navigation site-navigation--footer medium-text-right">
					<a href="<?php echo 'mailto:' . antispambot('contato@redelivre.org.br'); ?>">Contato</a>
					<a href="https://github.com/redelivre">GitHub</a>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
