<?php
/*
This is the custom post type post template.
If you edit the post type name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom post type is called
register_post_type( 'bookmarks',
then your single template should be
single-bookmarks.php

*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

								<p class="entry-meta">
									<?php obj_entry_status(); ?>
								</p>

								<header class="article-header">

									<h1 class="single-title custom-post-type-title"><?php the_title(); ?></h1>

								</header> <!-- end article header -->

								<section class="entry-content clearfix">

									<?php the_content(); ?>

								</section> <!-- end article section -->

								<footer class="article-footer">

									<p class="byline vcard"><?php
										//printf(__('Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span> <span class="amp">&</span> filed under %4$s.', 'bonestheme'), get_the_time('Y-m-j'), get_the_time(__('F jS, Y', 'bonestheme')), bones_get_the_author_posts_link(), get_the_term_list( $post->ID, 'stellentyp', ' ', ', ', '' ));
									?></p>
									<p><?php 
										$posttags = get_the_tags();
										if ($posttags) {
											echo 'Schlagwörter/Tags: ';
											foreach($posttags as $tag) {
												$tag_names[] = $tag->name;
												//echo $tag->name . ', '; 
											}
											echo implode( ', ', $tag_names );
											echo '.';
										}
									?></p>
									<p><?php 
										obj_custom_data(); 
									?></p>

								</footer> <!-- end article footer -->

								<?php //comments_template(); ?>

							</article> <!-- end article -->

				<nav class="nav-single">
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'bonestheme' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'bonestheme' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->

							<?php endwhile; ?>

							<?php else : ?>

									<div id="post-not-found" class="hentry clearfix">
										<p class="alert-info"><?php _e("Stellenangebot nicht gefunden.", "bonestheme"); ?></p>
									</div>

							<?php endif; ?>

						</div> <!-- end #main -->

						<?php //get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
