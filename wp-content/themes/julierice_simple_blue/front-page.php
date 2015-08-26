<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package julierice_simple_blue
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="entry-content">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'julierice_simple_blue' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );
				?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php julierice_simple_blue_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->

	<?php endwhile; // End of the loop.?>

	</main><!-- #main -->
	<div id="upcoming-events">
	<?php
		$args = array( 'posts_per_page' => 5,'post_type' => 'tribe_events');

		$myposts = get_posts( $args );

	</div> <!-- #upcoming-events -->

	<div id="blog">
	<?php
		$args = array( 'posts_per_page' => 5,  'category' => 1 );

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<li>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</li>
		<?php endforeach;
		wp_reset_postdata();
	?>
	</div> <!-- #blog -->

<?php get_footer(); ?>
