<?php
/*
Template Name: Stellenangebote Archiv
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first eightcol" role="main">

							<?php 
								$args = array(
									'paged' => get_query_var('paged', 1),
									'posts_per_page' => '20',
									'post_type' => 'stellenangebote',
									'post_status' => 'archive',
								);
								$myArchivedJobs = new WP_Query( $args );
							?>

							<?php if ($myArchivedJobs->have_posts()) : ?>

								<?php //$postCounter = 0; ?>

								<?php echo obj_bones_pagination($myArchivedJobs); ?>

								<ul class="job-liste">
								
								<?php while ($myArchivedJobs->have_posts()) : $myArchivedJobs->the_post(); ?>

									<?php // ++$postCounter ?>

									<li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >

										<p class="entry-meta">
											<!--<span>-->
												<?php // echo $postCounter ?>
											<!-- </span> -->
											<?php obj_entry_date(); ?>
										</p>

										<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>

										<?php the_content(); ?>

									</li>

								<?php endwhile; ?>
								<?php // $postCounter = 0; ?>
								
								</ul>

								<?php echo obj_bones_pagination($myArchivedJobs); ?>

							<?php else : ?>

							<div id="post-not-found" class="hentry clearfix">
								<h1><?php _e("Keine Stellenangebote gefunden.", "bonestheme"); ?></h1>
							</div>

							<?php endif; ?>

							<?php wp_reset_postdata(); ?>


						</div> <!-- end #main -->

						<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
