<?php
/*
Template Name: StandWithUkraine
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first eightcol" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										//printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F jS, Y', 'bonestheme')), bones_get_the_author_posts_link());
									?></p>


								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
							</section> <!-- end article section -->

								<footer class="article-footer">
									<?php the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?>

								</footer> <!-- end article footer -->

								<?php comments_template(); ?>

							</article> <!-- end article -->

							<?php endwhile; else : ?>
							
									<article id="post-not-found" class="hentry clearfix">
										<header class="article-header">
											<h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e("This is the error message in the page.php template.", "bonestheme"); ?></p>
										</footer>
									</article>
							
							<?php endif; ?>

							<!-- Offers listing -->
							<?php 
								//query_posts( 'post_type=stellenangebote&post_status=publish');
								$args = array(
									'posts_per_page' => -1,
									'post_type' => 'stellenangebote',
									'post_status' => 'publish',
									'tax_query' =>  array(
										array(
											'taxonomy' => 'stellentyp',
											'field' => 'slug',
											'terms' => 'standwithukraine'
										)
									)
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
								<h1><?php _e("No offers found.", "bonestheme"); ?></h1>
							</div>

							<?php endif; ?>

						</div> <!-- end #main -->

						<?php get_sidebar( 'sidebar2' ); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
