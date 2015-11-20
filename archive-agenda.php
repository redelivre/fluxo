<?php
/**
 * The template for displaying Archive for Post Type Agenda
 *
 * @package Fluxo
 * @since Fluxo 1.0
 */
 
global $paged;
$showingPast = ($paged > 0 || isset($_GET['eventos']) && $_GET['eventos'] == 'passados');
?>
<?php get_header(); ?>
<div class="clearfix"></div>
	<div id="primary" class="content-area row" >
		<?php if ($showingPast): ?>
			<h2 class="clearfix">
				Eventos Passados
				<a class="view-events" href="<?php echo add_query_arg('eventos', ''); ?>">Ver próximos eventos &raquo;</a>
			</h2>
		<?php else: ?>
			<h2 class="clearfix">
				Próximos eventos
				<a class="view-events" href="<?php echo add_query_arg('eventos', 'passados'); ?>">Ver eventos passados &raquo;</a>
			</h2>
		<?php endif; ?>
	    
            <?php if ( have_posts()) : ?>
            
                <?php get_template_part( 'template-parts/content', 'agenda-loop' ); ?>
			
            <?php else : ?>
                    <p class="post"><?php _e('No results found.', 'fluxo'); ?></p>              
            <?php endif; ?>
        
	</div>
	<!-- #content -->
    <aside id="sidebar" class="col-4 clearfix">
		<?php get_sidebar(); ?>
    </aside>
    <!-- #sidebar -->       
<?php get_footer(); ?>