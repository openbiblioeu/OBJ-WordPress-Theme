<?php
/*
Template Name: Stellenangebote Karte
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix map-container'); ?> role="article" itemscope itemtype="http://schema.org/Map">

								<header class="article-header">

									<h1 class="page-title visuallyhidden"><?php the_title(); ?></h1>


								</header> <!-- end article header -->

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <!-- end article section -->
								<!--
								<footer class="article-footer">
									<p class="clearfix"><?php //the_tags('<span class="tags">' . __('Tags:', 'bonestheme') . '</span> ', ', ', ''); ?></p>

								</footer>--> <!-- end article footer -->

								<?php //comments_template(); ?>

							</article> <!-- end article -->

							<?php endwhile; else : ?>

								<div id="post-not-found" class="hentry clearfix">
									<h1><?php _e("Nichts gefunden.", "bonestheme"); ?></h1>
								</div>

							<?php endif; ?>

						</div> <!-- end #main -->

						<?php //get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
