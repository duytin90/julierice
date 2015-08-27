<article id="post-<?php the_ID(); ?>" class='<?php echo (++$j % 2 == 0) ? 'evenpost' : 'oddpost'; ?>' <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php julierice_simple_blue_custom_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
		<div class="view-all"><a href="blog">View all posts</a></div>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php julierice_simple_blue_excerpt_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
