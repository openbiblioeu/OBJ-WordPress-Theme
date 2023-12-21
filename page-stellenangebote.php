<?php
/*
Template Name: Stellenangebote
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first eightcol" role="main">

							<?php 
								//query_posts( 'post_type=stellenangebote&post_status=publish');
								$args = array(
									'posts_per_page' => -1,
									'post_type' => 'stellenangebote',
									'post_status' => 'publish',
								);
								$myJobs = new WP_Query( $args );
							?>

							<?php if ($myJobs->have_posts()) : ?>

							<?php $postCounter = 0; ?>

							<ul class="job-liste">
							
							<?php while ($myJobs->have_posts()) : $myJobs->the_post(); ?>

								<?php ++$postCounter ?>

								<li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >

									<p class="entry-meta"><span><?php echo $postCounter ?></span> <?php obj_entry_date(); ?></p>

									<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

									<?php the_content(); ?>

								</li>

							<?php endwhile; ?>
							<?php $postCounter = 0; wp_reset_postdata(); ?>

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
								<h1><?php _e("Keine Stellenangebote gefunden.", "bonestheme"); ?></h1>
							</div>

							<?php endif; ?>

						</div> <!-- end #main -->

						<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
