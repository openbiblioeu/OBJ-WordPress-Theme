<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

					<div id="main" class="first eightcol" role="main">

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

						<?php //$postCounter = 0; ?>

						<?php echo obj_bones_pagination($wp_query); ?>

						<ul class="job-liste">


						<?php while (have_posts()) : the_post(); ?>

							<?php // ++$postCounter ?>

							<li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> >

								<p class="entry-meta">
										<!--<span><?php // echo $postCounter ?></span> -->
										<?php obj_entry_date(); ?>
								</p>

								<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								
								<?php the_content(); ?>

							</li>

						<?php endwhile; ?>

						<?php //$postCounter = 0; ?>

						</ul>

						<?php echo obj_bones_pagination($wp_query); ?>

						<?php else : ?>

							<div id="post-not-found" class="hentry clearfix">
								<h1><?php _e("Nichts gefunden.", "bonestheme"); ?></h1>
							</div>

						<?php endif; ?>

						</div> <!-- end #main -->

						<?php get_sidebar(); ?>

					</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
