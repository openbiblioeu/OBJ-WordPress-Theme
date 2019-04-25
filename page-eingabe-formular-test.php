<?php
/*
Template Name: Eingabe-Formular Test
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="first clearfix" role="main">

							<form class="eingabe-formular">
								<fieldset>
									<legend>Neues Stellenangebot eingeben</legend>

									<div class="stellentypen">
										<span class="label">Kategorie</span>
										<?php 
											$stellentypen = get_categories('taxonomy=stellentyp&hide_empty=0');
											foreach($stellentypen as $stellentyp) {
												$ausgabe = '<label class="radio">';
												$ausgabe .= '<input type="radio" name="stellentypen" id="' . $stellentyp->cat_ID . '" /> ';
												$ausgabe .= $stellentyp->cat_name;
												$ausgabe .= '</label>';
												echo $ausgabe;
											}
										?>
									</div>

									<div>
										<label>Bezeichnung</label>
										<input type="text" />
										<span class="help-block">Diplom-Bibliothekar/in, E 10 TVöD, unbefristet in Vollzeit; ggfs. Referenznummer angegeben</span>
									</div>
									
									<div>
										<label>Einrichtung</label>
										<input type="text" />
										<span class="help-block">Daisy Duck Zentralbibliothek, 012345 Entenhausen</span>
									</div>
									
									<div>
										<label>Bewerbungsfrist</label>
										<input type="date" />
										<span class="help-block">Bitte leer lassen, wenn keine Frist gesetzt oder angegeben ist</span>
									</div>
									
									<div>
										<label>Link zum Angebot</label>
										<input type="url" />
									</div>

									<div>
										<?php 
											if( is_user_logged_in() ) {
												echo '<button type="submit" class="button">Absenden und sofort veröffentlichen</button>';
											} else {
												echo '<button type="submit" class="button">Absenden</button>';
											}
										?>
									</div>
								</fieldset>
							</form>

						</div> <!-- end #main -->

				</div> <!-- end #inner-content -->

			</div> <!-- end #content -->

<?php get_footer(); ?>
