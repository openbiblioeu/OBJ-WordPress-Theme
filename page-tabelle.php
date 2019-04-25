<?php
/*
Template Name: Stellenangebote Tabelle
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first clearfix" role="main">
							<div id="job-table-container">

							<?php 
								//query_posts( 'post_type=stellenangebote&post_status=publish');
								$args = array(
									'posts_per_page' => '-1',
									'post_type' => 'stellenangebote',
									'post_status' => 'publish',
								);
								$myJobs = new WP_Query( $args );
							?>

							<?php if ($myJobs->have_posts()) : ?>

							<?php $postCounter = 0; ?>

							<table id="job-table" class="stripe hover row-border" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Eingang</th>
										<th class="control">Bezeichnung</th>
										<th>Einrichtung</th>
										<!--<th>Ort</th>-->
										<th>Frist</th>
										<th class="none">Einrichtungstyp</th>
										<th class="none">Stellentyp</th>
									</tr>
								</thead>
								<tbody>
							
							<?php while ($myJobs->have_posts()) : $myJobs->the_post(); ?>

								<?php ++$postCounter ?>
								<?php $terms_einrichtungstyp = wp_get_post_terms($post->ID, 'einrichtungstyp', array("fields" => "names")); ?>
								<?php $terms_stellentyp = wp_get_post_terms($post->ID, 'stellentyp', array("fields" => "names")); ?>
									<tr id="post-<?php the_ID(); ?>">
										<td><?php obj_entry_date_only(); ?></td>
										<td class="control"><a href="<?php obj_link(); ?>"><?php the_title(); ?></a></td>
										<td><?php obj_einrichtung(); ?></td>
										<!--<td>Ort</td>-->
										<td><?php obj_bewerbungsfrist(); ?></td>
										<td class="none"><?php foreach($terms_einrichtungstyp as $terms_e) { echo($terms_e); } ?></td>
										<td class="none"><?php foreach($terms_stellentyp as $terms_s) { echo($terms_s); } ?></td>
									</tr>
							<?php endwhile; ?>
							<?php $postCounter = 0; ?>
								</tbody>
							</table>

							<?php else : ?>

							<div id="post-not-found" class="hentry clearfix">
								<h1><?php _e("Keine Stellenangebote gefunden.", "bonestheme"); ?></h1>
							</div>

							<?php endif; ?>

							<?php 
								//wp_reset_query();
								wp_reset_postdata();
							?>
							</div>

						</div> <!-- end #main -->

						<?php //get_sidebar(); ?>

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
