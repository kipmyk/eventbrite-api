<?php
/**
 * Template Name: Eventbrite Events
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<header class="page-header">
				<h1 class="page-title">
					<?php esc_html_e( 'Eventbrite Events', 'eventbrite-api' ); ?>
				</h1>
			</header><!-- .page-header -->

			<?php
				// Set up and call our Eventbrite query.
				$events = new Eventbrite_Query( apply_filters( 'eventbrite_query_args', array(
					// 'display_private' => false, // boolean
					// 'limit' => null,            // integer
					// 'organizer' => null,        // string
					// 'p' => null,                // integer
					// 'post__not_in' => null,     // array of integers
					// 'venue' => null,            // string
				) ) );

				if ( $events->have_posts() ) :
					while ( $events->have_posts() ) : $events->the_post(); ?>

						<article id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php the_post_thumbnail(); ?>

								<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

								<div class="entry-meta">
									<?php eventbrite_event_info(); ?>
								</div><!-- .entry-meta -->
							</header><!-- .entry-header -->

							<div class="entry-content">
								<?php eventbrite_ticket_form_widget(); ?>
							</div><!-- .entry-content -->

							<footer class="entry-footer">
								<?php eventbrite_entry_footer(); ?>
							</footer><!-- .entry-footer -->
						</article><!-- #post-## -->

					<?php endwhile;

					// Previous/next post navigation.
					eventbrite_paging_nav( $events );

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;

				// Return $post to its rightful owner.
				wp_reset_postdata();
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
