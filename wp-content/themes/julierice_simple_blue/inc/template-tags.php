<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package julierice_simple_blue
 */

if ( ! function_exists( 'julierice_simple_blue_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function julierice_simple_blue_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'julierice_simple_blue' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'julierice_simple_blue' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'julierice_simple_blue_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function julierice_simple_blue_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'julierice_simple_blue' ) );
		if ( $categories_list && julierice_simple_blue_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'julierice_simple_blue' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'julierice_simple_blue' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'julierice_simple_blue' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( esc_html__( 'Leave a comment', 'julierice_simple_blue' ), esc_html__( '1 Comment', 'julierice_simple_blue' ), esc_html__( '% Comments', 'julierice_simple_blue' ) );
		echo '</span>';
	}

	edit_post_link( esc_html__( 'Edit', 'julierice_simple_blue' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function julierice_simple_blue_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'julierice_simple_blue_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'julierice_simple_blue_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so julierice_simple_blue_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so julierice_simple_blue_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in julierice_simple_blue_categorized_blog.
 */
function julierice_simple_blue_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'julierice_simple_blue_categories' );
}
add_action( 'edit_category', 'julierice_simple_blue_category_transient_flusher' );
add_action( 'save_post',     'julierice_simple_blue_category_transient_flusher' );

if ( ! function_exists( 'julierice_simple_blue_custom_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function julierice_simple_blue_custom_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'julierice_simple_blue' ),
		$time_string
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'julierice_simple_blue' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'julierice_simple_blue_excerpt_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function julierice_simple_blue_excerpt_entry_footer() {

	edit_post_link( esc_html__( 'Edit', 'julierice_simple_blue' ), '<span class="edit-link">', '</span>' );
}
endif;

function new_excerpt_more( $more ) {
	return '...</p><div> <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Continue reading', 'your-text-domain' ) . '</a></div>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );