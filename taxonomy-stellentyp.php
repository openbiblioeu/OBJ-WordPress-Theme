<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first eightcol clearfix" role="main">

							<h1 class="archive-title visuallyhidden"><span><?php _e("Stellenangebote vom Typ ", "bonestheme"); ?></span> <?php single_cat_title(); ?></h1>

							<?php if (have_posts()) : ?>

							<?php $postCounter = 0; ?>

							<ul class="job-liste">

							<?php while (have_posts()) : the_post(); ?>

								<?php $postid = get_the_ID(); ?>
								<?php 
									//nur veroeffentlichte Angebote anzeigen
									if (get_post_status($postid) == 'publish') { 
								?>

									<?php ++$postCounter ?>

									<li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
										<p class="entry-meta"><span><?php echo $postCounter ?></span> <?php obj_entry_date(); ?></p>
										<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
										<?php the_content(); ?>
										<p class="byline vcard"><?php
											//printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F jS, Y', 'bonestheme')), bones_get_the_author_posts_link(), get_the_term_list( get_the_ID(), 'stellentyp', "" ));
										?></p>
									</li>

								<?php } ?>

							<?php endwhile; ?>
							<?php $postCounter = 0; ?>
							</ul>
							<!--
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
							-->

							<?php else : ?>

									<div id="post-not-found" class="hentry clearfix">
											<p class="alert-info"><?php _e("Keine Stellenangebote gefunden.", "bonestheme"); ?></p>
									</div>

							<?php endif; ?>

							<?php //wp_reset_query(); ?>

						</div> <!-- end #main -->

						<?php get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
