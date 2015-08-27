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
		//https://theeventscalendar.com/knowledgebase/custom-event-list-pagination/

		// Build our query, adopt the default number of events to show per page
		$upcoming = new WP_Query( array(
			'post_type' => Tribe__Events__Main::POSTTYPE,
			'paged'     => 1,
			'posts_per_page' => 3
		) );

		// If we got some results, let's list 'em
		while ( $upcoming->have_posts() ) {

			$upcoming->the_post();

			// this is copied from events calendar plugin /src/views/list/loop.php
	 		do_action( 'tribe_events_inside_before_loop' ); ?>

			<!-- Month / Year Headers -->
			<?php tribe_events_list_the_date_headers(); ?>

			<!-- Event  -->
			<?php
			$post_parent = '';
			if ( $post->post_parent ) {
				$post_parent = ' data-parent-post-id="' . absint( $post->post_parent ) . '"';
			}
			?>
			<div id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?>" <?php echo $post_parent; ?>>
				<?php tribe_get_template_part( 'list/single', 'event' ) ?>
			</div><!-- .hentry .vevent -->

			<?php do_action( 'tribe_events_inside_after_loop' );
		}

			// Clean up
			wp_reset_query();
	?>
	</div> <!-- #upcoming-events -->

	<div id="blog">
	<?php
		$args = array( 'posts_per_page' => 2,  'category' => 1 );

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<?php get_template_part( 'template-parts/post', 'excerpt' ); ?>
		<?php endforeach;
		wp_reset_postdata();
	?>
	</div> <!-- #blog -->

<?php get_footer(); ?>
