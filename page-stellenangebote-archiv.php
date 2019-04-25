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
								query_posts( 'posts_per_page=10&post_type=stellenangebote&post_status=archive');
/*								$args = array(
									'posts_per_page' => '10',
									'post_type' => 'stellenangebote',
									'post_status' => 'archive',
								);
								$myJobs = new WP_Query( $args );*/
							?>

							<?php if (have_posts()) : //if ($myJobs->have_posts()) : ?>

							<?php $postCounter = 0; ?>

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

							<ul class="job-liste">
							
							<?php while (have_posts()) : the_post(); //$myJobs->have_posts()) : $myJobs->the_post(); ?>

								<?php ++$postCounter ?>

								<li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >

									<p class="entry-meta"><span><?php echo $postCounter ?></span> <?php obj_entry_date(); ?></p>

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
								<h1><?php _e("Keine Stellenangebote gefunden.", "bonestheme"); ?></h1>
							</div>

							<?php endif; ?>


						</div> <!-- end #main -->

						<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
