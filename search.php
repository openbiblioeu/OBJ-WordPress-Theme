<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="first clearfix" role="main">

						<?php 
							//query_posts( 'post_type=stellenangebote&post_status=publish');
						?>

						<h1 class="archive-title">
							<span>
								<?php 
									$total_results = $wp_query->found_posts;
									echo $total_results;
									//if ( $total_results == 1 ) {
										_e(' Treffer für Ihre Suche nach: ', 'bonestheme');
									//} else {
									//	_e(' Treffer für Ihre Suche nach: ', 'bonestheme');
									//}
								?>
							</span> <?php echo esc_attr(get_search_query()); ?>
						</h1>

						<?php if (have_posts()) : ?>

						<?php $postCounter = 0; ?>

						<ul class="job-liste">


						<?php while (have_posts()) : the_post(); ?>

							<?php ++$postCounter ?>

							<li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >

								<p class="entry-meta"><span><?php echo $postCounter ?></span> <span>Eingang: <?php obj_entry_date(); ?></span></p>

								<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								
								<?php the_content(); ?>

							</li>

						<?php endwhile; ?>

						<?php $postCounter = 0; ?>

						</ul>

								<?php if (function_exists('bones_page_navi')) { ?>
										<?php bones_page_navi(); ?>
								<?php } else { ?>
										<nav class="wp-prev-next">
												<ul class="clearfix">
													<li class="prev-link"><?php next_posts_link(__('&laquo; Older Entries', "bonestheme")) ?></li>
													<li class="next-link"><?php previous_posts_link(__('Newer Entries &raquo;', "bonestheme")) ?></li>
												</ul>
										</nav>
								<?php } ?>

							<?php else : ?>

									<div id="post-not-found" class="hentry clearfix">
										<h1><?php _e("Nichts gefunden.", "bonestheme"); ?></h1>
									</div>

							<?php endif; ?>

							<?php //wp_reset_postdata(); ?>

						</div> <!-- end #main -->

							<?php //get_sidebar(); ?>

					</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
