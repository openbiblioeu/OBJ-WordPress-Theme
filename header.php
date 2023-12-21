<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<meta name="referrer" content="no-referrer">

		<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

		<meta name="google-site-verification" content="ticQufqGBb51cxCw7_dMz2GxUBHq6dqmpyIEjZAxHk0" />

		<!-- mobile meta (hooray!) -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<!-- icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) -->
		<link rel="logo" href="<?php echo get_template_directory_uri(); ?>/library/images/objbadge.jpg">
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/objbadge.jpg">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/objbadge.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->

		<link rel="alternate" type="application/rss+xml" title="Alle Stellenangebote" href="https://jobs.openbiblio.eu/stellenangebote/feed/" />
		<link rel="alternate" type="application/rss+xml" title="Stellenangebote von Bibliotheken" href="https://jobs.openbiblio.eu/einrichtungstyp/bibliothek/feed" />
		<link rel="alternate" type="application/rss+xml" title="Stellenangebote von Archiven" href="https://jobs.openbiblio.eu/einrichtungstyp/archiv/feed" />
		<link rel="alternate" type="application/rss+xml" title="Stellenangebote Informationseinrichtungen" href="https://jobs.openbiblio.eu/einrichtungstyp/informationseinrichtung/feed" />
		<link rel="alternate" type="application/rss+xml" title="Stellenangebote von sonstigen Einrichtungen und Firmen" href="https://jobs.openbiblio.eu/einrichtungstyp/sonstige-einrichtung/feed" />

		<link rel="alternate" type="application/rss+xml" title="Arbeitsstellen" href="https://jobs.openbiblio.eu/stellentyp/arbeitsstelle/feed" />
		<link rel="alternate" type="application/rss+xml" title="Ausbildungsplätze" href="https://jobs.openbiblio.eu/stellentyp/ausbildungsplatz/feed" />
		<link rel="alternate" type="application/rss+xml" title="Praktika" href="https://jobs.openbiblio.eu/stellentyp/praktikum/feed" />
		<link rel="alternate" type="application/rss+xml" title="Studentische Hilfskräfte" href="https://jobs.openbiblio.eu/stellentyp/studentische-hilfskraft/feed" />
		<link rel="alternate" type="application/rss+xml" title="Sonstige Stellen" href="https://jobs.openbiblio.eu/stellentyp/sonstiges/feed" />

		<link rel="alternate" type="application/rss+xml" title="Blog" href="https://jobs.openbiblio.eu/blog/feed" />

	</head>

	<?php if( is_page('about') ) : ?>
	<body <?php body_class(); ?> data-spy="scroll" data-target=".about-nav" >
	<?php else : ?>
	<body <?php body_class(); ?>>
	<?php endif; ?>

		<div id="container">

			<header class="header" role="banner">

				<div id="inner-header" class="wrap clearfix">

					<div class="clearfix">

						<h1 class="brand">
							<a href="<?php echo home_url(); ?>" rel="nofollow">
								<!--<img id="logo" src="<?php echo get_template_directory_uri(); ?>/library/images/obj.png" alt="OpenBiblioJobs" />-->
								<span class="obj-open">Open</span><span class="obj-biblio">Biblio</span><span class="obj-jobs">Jobs</span>
							</a>
						</h1>

						<div class="slogan">
							<?php bloginfo('description'); ?>
							<br/>
							<span>
								<a href="https://openbiblio.social/@obj"><i class="fa-brands fa-mastodon fa-lg" aria-label="Mastodon"></i>
 https://openbiblio.social/@obj</a>
							</span>
							<span> &mdash; </span>
							<span>
								<a href="mailto:jobs@openbiblio.eu"><i class="fa fa-envelope" aria-label="Email"></i>
 jobs@openbiblio.eu</a>
							</span>
						</div>
					<!--
						<div class="prominent">
							<?php if( !is_front_page() ) { ?>
							<a href="http://jobs.openbiblio.eu/eingabe-formular/" class="button">Neues Stellenangebot melden</a>
							<?php } ?>
						</div>
					-->
					</div>

					<nav role="navigation">
						<?php bones_main_nav(); ?>
					</nav>

				</div> <!-- end #inner-header -->

			</header> <!-- end header -->
