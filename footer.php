			<footer class="footer" role="contentinfo">

				<div id="inner-footer" class="wrap clearfix">

					<?php dynamic_sidebar( 'content-info-block' ); ?>

					<nav role="navigation">
						<p id="you-rock">
							<span class="list-item">
								<i class="fa fa-unlock"></i> OBJ <?php echo date('Y'); ?>
							</span>
							<?php bones_footer_links(); ?>
						</p>
					</nav>

				</div> <!-- end #inner-footer -->

			</footer> <!-- end footer -->

		</div> <!-- end #container -->

		<!-- all js scripts are loaded in library/bones.php -->
		<?php wp_footer(); ?>

	</body>

</html> <!-- end page. what a ride! -->
