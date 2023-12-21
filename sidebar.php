				<div id="sidebar1" class="sidebar fourcol last clearfix" role="complementary">
				
					<?php 
						//Filter nur auf Startseite anzeigen
						if (is_front_page()) { 
					?>

						<div class="facets">
							<div class="all-jobs">
								<?php $gesamt = wp_count_posts( 'stellenangebote' )->publish; ?> 
								<?php if (is_front_page()) {
									echo '<strong>Alle aktuellen Stellenangebote</strong>';
									} else {
										echo '<a href="';
										echo home_url();
										echo '">Alle aktuellen Angebote</a> ';
									} 
									// echo ' (' . $gesamt . ') '
								?> 

								(<a class="feed-link" href="<?php echo home_url(); ?>/stellenangebote/feed/">RSS</span></a>)

								<?php echo ' (' . $gesamt . ') ' ?>
							</div>
							
							<h4>Filtern nach Einrichtungstyp</h4>
							
							<ul class="job-categories clearfix">
								<?php wp_list_categories('taxonomy=einrichtungstyp&hide_empty=0&show_count=1&title_li=&feed=RSS'); ?>
							</ul>
							
						<!--
							<ul class="job-categories clearfix">
							
							<?php $categories = get_categories(array(
								'taxonomy'=>'einrichtungstyp'
							));
							$mycustomtaxonomy = get_queried_object()->term_id;
							foreach( $categories as $category ) {
								$category_name = sprintf(
									'<strong>%1$s</strong>',
	        						esc_html( $category->name )
	        						);
								$category_link = sprintf(
									'<a href="%1$s">%2$s</a>',
	        						esc_url( get_term_link( $category->term_id ) ),
	        						esc_html( $category->name )
	        						);
								$feed_link = sprintf(
									'<a class="feed-link" href="%1$s/feed"> <i class="fa fa-rss" aria-hidden="true"></i> <span>RSS</span></a>',
	        						esc_url( get_term_link( $category->term_id ) )
	        						);
								if ($mycustomtaxonomy != $category->term_id) {
	        						echo '<li>' . sprintf($category_link) . ' (' . sprintf( $category->count ) . ') ' . sprintf($feed_link) . '</li>';
								} else {
	        						echo '<li class="current-cat">' . sprintf($category_name) . ' (' . sprintf( $category->count ) . ') ' . sprintf($feed_link) . '</li>';
								}
	        				} ?>
							</ul>
						-->
							<h4>Filtern nach Stellentyp</h4>
							
							<ul class="job-categories clearfix">
								<?php wp_list_categories('taxonomy=stellentyp&hide_empty=0&show_count=1&title_li=&feed=RSS'); ?>
							</ul>
							
							<!--
							<ul class="job-categories clearfix">
							
							<?php $categories = get_categories(array(
								'taxonomy'=>'stellentyp',
								'parent'=>0
							));
							$mycustomtaxonomy = get_queried_object()->term_id;
							foreach( $categories as $category ) {
								$category_name = sprintf(
									'<strong>%1$s</strong>',
	        						esc_html( $category->name )
	        						);
								$category_link = sprintf(
									'<a href="%1$s">%2$s</a>',
	        						esc_url( get_term_link( $category->term_id ) ),
	        						esc_html( $category->name )
	        						);
								$feed_link = sprintf(
									'<a class="feed-link" href="%1$s/feed"> <i class="fa fa-rss" aria-hidden="true"></i> <span>RSS</span></a>',
	        						esc_url( get_term_link( $category->term_id ) )
	        						);
								if ($mycustomtaxonomy != $category->term_id) {
	        						echo '<li>' . sprintf($category_link) . ' (' . sprintf( $category->count ) . ') ' . sprintf($feed_link) . '</li>';
								} else {
	        						echo '<li class="current-cat">' . sprintf($category_name) . ' (' . sprintf( $category->count ) . ') ' . sprintf($feed_link) . '</li>';
								}
	        				} ?>
							</ul>
							-->
						</div>

					<?php } ?>

					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->

						<div class="alert alert-help">
							<p><?php _e("Please activate some Widgets.", "bonestheme");  ?></p>
						</div>

					<?php endif; ?>

					<div id="obj-meta">
						<?php 
							$count_posts = wp_count_posts('stellenangebote'); 
							$published_posts = $count_posts->publish;
							$archived_posts = $count_posts->archive;
							$all_posts = $published_posts + $archived_posts + 2078;
						?>
						<p>OpenBiblioJobs ist ein ehrenamtliches Projekt. <br/>Wir haben seit Juli 2012 bis heute <?php echo($all_posts); ?> Stellenangebote veröffentlicht.</p>
					</div>

				</div>