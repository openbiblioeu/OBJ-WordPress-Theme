<?php
/*
Author: Eddie Machado
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once('library/bones.php'); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
require_once('library/custom-post-type.php'); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
require_once('library/admin.php'); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
require_once('library/translation/translation.php'); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __('Sidebar 1', 'bonestheme'),
		'description' => __('The first (primary) sidebar.', 'bonestheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	register_sidebar(array(
		'id' => 'content-info-block',
		'name' => __('Footer', 'bonestheme'),
		'description' => __('Hier kommt hin: Beteiligte und Unterstützerinnen. Der Titel des Widgets wird nicht angezeigt.', 'bonestheme'),
		'before_widget' => '<div id="powered-by" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle visuallyhidden">',
		'after_title' => '</h3>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __('Sidebar 2', 'bonestheme'),
		'description' => __('The second (secondary) sidebar.', 'bonestheme'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<!-- custom gravatar call -->
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'bonestheme'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'bonestheme')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'bonestheme'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e('Your comment is awaiting moderation.', 'bonestheme') ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __('Search for:', 'bonestheme') . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="'.esc_attr__('Search the Site...','bonestheme').'" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
	</form>';
	return $form;
} // don't remove this bracket!


/************* ADMIN BAR *****************/

show_admin_bar(true);

/************* OBJ SCRIPTS AND STYLES *****************/

function obj_styles_scripts() {
	//register custom bootstrap
	wp_register_style( 'bootstrap', get_stylesheet_directory_uri() . '/library/bootstrap/css/bootstrap.css', array(), '', 'all' );
    wp_enqueue_style( 'bootstrap' );
    wp_register_script( 'bootstrap-js', get_stylesheet_directory_uri() . '/library/bootstrap/js/bootstrap.min.js', array(), '', true );
    wp_enqueue_script( 'bootstrap-js' );
    //register font awesome icons styles
	wp_register_style( 'font-awesome', get_stylesheet_directory_uri() . '/library/css/font-awesome/css/font-awesome.min.css', array(), '', 'all' );
    wp_enqueue_style( 'font-awesome' );
    //DataTables
	wp_register_style( 'dataTables', get_stylesheet_directory_uri() . '/library/DataTables/datatables.min.css', array(), '', 'all' );
    wp_enqueue_style( 'dataTables' );
    wp_register_script( 'dataTables-js', get_stylesheet_directory_uri() . '/library/DataTables/datatables.min.js', array(), '', true );
    wp_enqueue_script( 'dataTables-js' );
    //responsive
	//wp_register_style( 'dataTables-responsive', get_stylesheet_directory_uri() . '/library/DataTables/extensions/Responsive/css/dataTables.responsive.css', array(), '', 'all' );
    //wp_enqueue_style( 'dataTables-responsive' );
    //wp_register_script( 'dataTables-responsive-js', get_stylesheet_directory_uri() . '/library/DataTables/extensions/Responsive/js/dataTables.responsive.min.js', array(), '', true );
    //wp_enqueue_script( 'dataTables-responsive-js' );
    //bones-js
  wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'bones-js' );

}
add_action( 'wp_enqueue_scripts', 'obj_styles_scripts', 1000 );

/************* LOGIN LINK UND MASKE *****************/
//Anmelde-Link oben rechts
function toolbar_link_to_mypage( $wp_admin_bar ) {
  $args = array(
    'id' => 'obj-login',
    'title' => 'Anmelden',
    'parent' => 'top-secondary',
    'href' => 'https://jobs.openbiblio.eu/wp-login.php',
    'meta' => array('class' => 'toolbar_item')
  );
  if ( !is_user_logged_in() ) {
  	$wp_admin_bar->add_node($args);
  }
  
}
add_action( 'admin_bar_menu', 'toolbar_link_to_mypage', 999 );

//dont use the wordpress logo, use ours instead
function obj_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'stylesheet_directory' ) ?>/library/images/obj.png);
            height: 60px;
            width: 250px;
            background-size: auto;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'obj_login_logo' );

//dont link to wordpress.org, link to home
function obj_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'obj_login_logo_url' );

function obj_login_logo_url_title() {
    return 'OpenBiblioJobs';
}
add_filter( 'login_headertitle', 'obj_login_logo_url_title' );


/************* WARTUNGSMODUS *****************/
function obj_maintenance_mode() {
    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
        wp_die('Ooops, wir schrauben gerade. OpenBiblioJobs ist in K&uuml;rze wieder erreichbar.');
    }
}
//add_action('get_header', 'obj_maintenance_mode');


/************* ADMIN BEREICH *****************/


/**
 * Save post metadata when a post is saved.
 *
 * @param int $post_id The ID of the post.
 */
function obj_save_metadata( $post_id ) {

    //$slug = 'stellenangebote';

    // If this isn't a 'stellenangebot' post, don't update it.
    //if ( $slug != $_POST['post_type'] ) {
    //    return;
    //}

    // Get the value string in Bewerbungsfrist
    // see https://developer.wordpress.org/reference/functions/get_post_meta/
    // If there is no field Bewerbungsfrist
    // the function get_post_meta returns an empty string or an empty array (if the thrid argument is set to false)
    $string_value = get_post_meta( $post_id, 'Bewerbungsfrist', true );
    // empty gibt FALSE zurück, wenn var existiert und einen nicht-leeren, von 0 verschiedenen Wert hat. 
    // Andernfalls wird TRUE zurück gegeben. 
    // http://php.net/manual/de/function.empty.php
    if(!empty($string_value)) {
    	$date_value = strtotime($string_value);
    } else {
    	$date_value = "";
    }

    // Update the post's metadata
    update_post_meta( $post_id, '_bewerbungsfrist_intern', $date_value );
}
add_action( 'save_post', 'obj_save_metadata' );

//add stellenangebote to dashboard right now
function add_jobs_to_dashboard() {
        if (!post_type_exists('stellenangebote')) {
             return;
        }

        $num_posts = wp_count_posts( 'stellenangebote' );
        $num = number_format_i18n( $num_posts->publish );
        $text = _n( 'Stellenangebot', 'Stellenangebote', intval($num_posts->publish) );
        if ( current_user_can( 'edit_posts' ) ) {
            $num = "<a href='edit.php?post_type=stellenangebote&post_status=publish'>$num</a>";
            $text = "<a href='edit.php?post_type=stellenangebote&post_status=publish'>$text</a>";
        }
        echo '<tr>';
        echo '<td class="first b b-stellenangebote">' . $num . '</td>';
        echo '<td class="t stellenangebote">' . $text . '</td>';
        echo '</tr>';

        if ($num_posts->draft > 0) {
            $num = number_format_i18n( $num_posts->draft );
            $text = _n( 'Stellenangebot wartet auf Veröffentlichung', 'Stellenangebote warten auf Veröffentlichung', intval($num_posts->draft) );
            if ( current_user_can( 'edit_posts' ) ) {
                $num = "<a href='edit.php?post_status=draft&post_type=stellenangebote'>$num</a>";
                $text = "<a class='waiting' href='edit.php?post_status=draft&post_type=stellenangebote'>$text</a>";
            }
            echo '<tr>';
            echo '<td class="first b b-stellenangebote">' . $num . '</td>';
            echo '<td class="t stellenangebote">' . $text . '</td>';
            echo '</tr>';
        }
}
add_action('right_now_content_table_end', 'add_jobs_to_dashboard');

//der Liste Spalten hinzufügen
add_filter( 'manage_edit-stellenangebote_columns', 'set_custom_edit_stellenangebote_columns' );
function set_custom_edit_stellenangebote_columns($columns) {
    //unset( $columns['author'] );
    $columns['eingang'] = __( 'Eingang', 'bonestheme' );
    $columns['bewerbungsfrist'] = __( 'Bewerbungsfrist', 'bonestheme' );
    // $columns['bewerbungsfrist_intern'] = __( 'Bewerbungsfrist intern', 'bonestheme' );
    $columns['geoinfo'] = __( 'Geo-Info', 'bonestheme' );
    return $columns;
}
add_action( 'manage_stellenangebote_posts_custom_column' , 'custom_stellenangebote_column', 10, 2 );
function custom_stellenangebote_column( $column, $post_id ) {
  $loc = GeoMashupDB::get_object_location( 'post', $post_id );
    switch ( $column ) {
        case 'eingang' :
            echo get_post_meta( $post_id , 'Eingang' , true ); 
            break;

        case 'bewerbungsfrist' :
            echo get_post_meta( $post_id , 'Bewerbungsfrist' , true ); 
            break;

        //case 'bewerbungsfrist_intern' :
        //    echo get_post_meta( $post_id , '_bewerbungsfrist_intern' , true ); 
        //    break;

        case 'geoinfo' :
            //echo get_post_meta( $post_id , 'geo_address' , true ); 
  if (!empty($loc)) {
    echo esc_attr( $loc->lat . '; ' . $loc->lng );
  } else {
    echo ("<span style=\"color:red;\">Keine Geo-Info, bitte geocodieren!</span>");
  }
            break;
    }
}
//TODO: die Spalten sortierbar machen
add_filter( 'manage_edit-stellenangebote_sortable_columns', 'set_custom_edit_stellenangebote_sortable_columns' );
function set_custom_edit_stellenangebote_sortable_columns($columns) {
	//$columns['eingang'] = 'eingang';
	$columns['bewerbungsfrist'] = 'bewerbungsfrist';
	return $columns;
}

add_action( 'pre_get_posts', 'custom_edit_stellenangebote_orderby' );
function custom_edit_stellenangebote_orderby( $query ) {
	if( ! is_admin() )
		return;

	$orderby = $query->get( 'orderby');

	if( 'bewerbungsfrist' == $orderby ) {
		$query->set('meta_key','_bewerbungsfrist_intern');
		$query->set('orderby','meta_value_num');
	}
}

//custom post status
function custom_post_status(){
	register_post_status( 'archive', array(
		'label'                     => _x( 'Archiviert', 'stellenangebote' ),
		'public'                    => true,
		'exclude_from_search'       => false,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Archiviert <span class="count">(%s)</span>', 'Archiviert <span class="count">(%s)</span>' ),
	) );
}
add_action( 'init', 'custom_post_status' );

//custom status "archive" im Admin-Bereich anzeigen und verfügbar machen
//momentan kann wordpress das nicht, siehe https://core.trac.wordpress.org/ticket/12706
//thanks to http://jamescollings.co.uk/blog/wordpress-create-custom-post-status/
function obj_custom_status() {
     global $post;
     $complete = '';
     $label = '';
     if($post->post_type == 'stellenangebote'){
          if($post->post_status == 'archive'){
               $complete = ' selected=\"selected\"';
               $label = '<span id=\"post-status-display\"> Archiviert</span>';
          }
          echo '
          <script>
          jQuery(document).ready(function($){
               $("select#post_status").append("<option value=\"archive\" '.$complete.'>Archiviert</option>");
               $(".misc-pub-section label").append("'.$label.'");
          });
          </script>
          ';
     }
}
//add_action( 'post_submitbox_misc_actions', 'obj_custom_status' );
add_action( 'admin_footer-post.php', 'obj_custom_status' );

//Status "Archiviert" in Massenbearbeitung zur Auswahl hinzufuegen
function obj_custom_status_bulk_edit() {
	echo '
	<script>
	jQuery(document).ready(function($){
		$(".inline-edit-status select ").append("<option value=\"archive\">Archiviert</option>");
	});
	</script>
	';
}
add_action( 'admin_footer-edit.php', 'obj_custom_status_bulk_edit' );

//Status "Archiviert" in Liste anzeigen
function obj_display_archive_state( $states ) {
     global $post;
     $arg = get_query_var( 'post_status' );
     if($arg != 'archive'){
          if($post->post_status == 'archive'){
               return array('Archiviert');
          }
     }
    return $states;
}
add_filter( 'display_post_states', 'obj_display_archive_state' );


/************* ANZEIGE DER STELLENANGEBOTE *****************/

//show meta for jobs
function obj_custom_data() {
	$custom_fields = get_post_custom();
	$eingang = $custom_fields['Eingang'];
	$eingegeben = $custom_fields['Eingegeben von'];
	if($eingang != "" && $eingegeben != "") {
		foreach ( $eingang as $key => $value1 ) {
			//$value1 = str_replace("/", ".", $value1);
			printf('Eingegeben am ' . $value1 . ' ');
		}
		foreach ( $eingegeben as $key => $value2 ) {
			printf('von ' . $value2 . '. ');
		}
	} else {
    foreach ( $eingang as $key => $value1 ) {
      //$value1 = str_replace("/", ".", $value1);
      printf('Eingegeben am ' . $value1 . ' von unbekannt. ');
    }
  }

	$date = sprintf( '%1$s',
		esc_html( get_the_date() )
	);

	$author = sprintf( '%1$s',
		get_the_author()
	);
	echo('Veröffentlicht am ' . $date . ' von ' . $author . '. ');
}
//show just the entry date for jobs
function obj_entry_date() {
	$custom_fields = get_post_custom();
	$eingang = $custom_fields['Eingang'];
	if($eingang != "") {
		foreach ( $eingang as $key => $value ) {
      if(strtotime($value) < strtotime('-7 day')) {
        echo('<span class="whyareyoustilllookingatthis"> Eingang: ' . $value . '</span>');
      } elseif(strtotime($value) < strtotime('-2 day')) {
        echo('<span class="morethan2days"> Eingang: ' . $value . '</span>');
      } elseif(strtotime($value) < strtotime('-1 day')) {
        echo('<span class="yesterdayallmytroubles"> Eingang: ' . $value . '</span>');
      } else {
        echo('<span class="itsfresh"> Eingang: ' . $value . '</span>');
      }
			
		}
	}
}

function obj_entry_date_only() {
  $custom_fields = get_post_custom();
  $eingang = $custom_fields['Eingang'];
  if($eingang != "") {
    foreach ( $eingang as $key => $value ) {
      echo( $value );
    }
  }
}

function obj_einrichtung() {
	$custom_fields = get_post_custom();
	$einrichtung = $custom_fields['Einrichtung'];
	if($einrichtung != "") {
		foreach ( $einrichtung as $key => $value ) {
			echo($value);
		}
	}
}

function obj_bewerbungsfrist() {
	$custom_fields = get_post_custom();
	$bewerbungsfrist = $custom_fields['Bewerbungsfrist'];
	if($bewerbungsfrist != "") {
		foreach ( $bewerbungsfrist as $key => $value ) {
			echo($value);
		}
	}
}

function obj_link() {
	$custom_fields = get_post_custom();
	$link = $custom_fields['Link zum Angebot'];
	if($link) {
		foreach ( $link as $key => $value ) {
			echo($value);
		}
	}
}

/************* Custom RSS für Referendariate *****************/

function obj_custom_rss_init() {
  add_feed('referendariate', 'obj_get_template_for_custom_rss');
}
add_action('init', 'obj_custom_rss_init');

function obj_custom_rss_content_type( $content_type, $type ) {
  if ( 'referendariate' === $type ) {
    return feed_content_type( 'rss2' );
  }
  return $content_type;
}
// add_filter( 'feed_content_type', 'obj_custom_rss_content_type', 10, 2 );

function obj_get_template_for_custom_rss() {
  // look for template file in theme folder
  get_template_part('rss', 'referendariate');
}

/************* SUCHE *****************/
// search filter
function obj_search_filter($query) {
	if ( !$query->is_admin && $query->is_search) {
		$query->set('post_type', array('stellenangebote') ); // id of page or post
		$query->set('post_status', 'publish');
	}
	return $query;
}
add_filter( 'pre_get_posts', 'obj_search_filter' );

/************* UPLOAD *****************/
function obj_custom_upload_mimes ( $mimes_types ) {
// add your extension to the array
$mimes_types['mab'] = 'text/plain';
// add as many as you like
// removing existing file types
// unset( $existing_mimes['exe'] );
// add as many as you like
// and return the new full result
return $mimes_types;
}
//add_filter('upload_mimes', 'obj_custom_upload_mimes');

/************* JSON API VIA JETPACK *****************/

function obj_allow_my_post_types($allowed_post_types) {
$allowed_post_types[] = 'stellenangebote';
return $allowed_post_types;
}

add_filter( 'rest_api_allowed_post_types', 'obj_allow_my_post_types');


/************* BODY CLASSES *****************/
function my_class_names($classes) {
	// add 'class-name' to the $classes array
	$classes[] = 'class-name';
	// return the $classes array
	return $classes;
}
//add_filter('body_class','my_class_names');

/************* TRUNCATE LINKS *****************/
function obj_truncate_link($joblink) {
	// add 'class-name' to the $classes array
	$shortlink = substr($joblink, 0, 100);
	// return the shortened link
	return $shortlink;
}


/************* REMOVE FEED LINKS *****************/
remove_action('wp_head', 'feed_links', 2 );
remove_action('wp_head', 'feed_links_extra', 3 );


/************* ADD JSON-LD *****************/
add_action('wp_head', 'obj_add_jsonld_head', 1);
function obj_add_jsonld_head() {
  if ( is_singular( 'stellenangebote' ) ) {
    
    # title und description
    $obj_post_title = single_post_title( '', false );
    $obj_job_title_array = explode(',', $obj_post_title, 2);
    # id
    $obj_post_id = get_queried_object_id();
    # bewerbungsfrist
    $obj_bewerbungsfrist = get_post_meta($obj_post_id, 'Bewerbungsfrist', true);
    $obj_bewerbungsfrist_iso_8601 = date(DATE_ISO8601, strtotime($obj_bewerbungsfrist) + (24*60*60)-1);
    # eingang (date posted)
    $obj_eingang = get_post_meta($obj_post_id, 'Eingang', true);
    $obj_eingang_iso_8601 = date(DATE_ISO8601, strtotime($obj_eingang));
    # einrichtung
    $obj_einrichtung = get_post_meta($obj_post_id, 'Einrichtung', true);
    # adresse
    # $obj_geo_address = get_post_meta($obj_post_id, 'geo_address', true);
    $obj_geo_address = GeoMashup::location_info('fields=address');
    $obj_geo_country_name = GeoMashup::location_info('fields=country_name');
    $obj_geo_locality = GeoMashup::location_info('fields=locality_name');
    $obj_geo_postal_code = GeoMashup::location_info('fields=postal_code');
    $obj_geo_street = '';
    $obj_geo_address_array = explode(',', $obj_geo_address);
    foreach ($obj_geo_address_array as $address_component) {
      $address_component = trim($address_component);
      if(strpos($address_component, $obj_geo_locality) === false && preg_match('/\\d/', $address_component)) {
        $obj_geo_street = $address_component;
      }
    }
    # $obj_geo_code_locality_array = explode(' ', trim($obj_geo_address_array[1]), 2);
    # geo
    $obj_geo_latitude = get_post_meta($obj_post_id, 'geo_latitude', true);
    $obj_geo_longitude = get_post_meta($obj_post_id, 'geo_longitude', true);
    ?>
    
    <script type="application/ld+json"> 
      {
        "@context" : "https://schema.org/",
        "@type" : "JobPosting",
        "industry" : "Galleries, Libraries, Archives, Museums",
        "title" : "<?php echo $obj_job_title_array[0]; ?>",
        "description" : "<?php echo trim($obj_job_title_array[1]); ?>",
        "datePosted" : "<?php echo $obj_eingang_iso_8601; ?>",
        "validThrough" : "<?php echo $obj_bewerbungsfrist_iso_8601; ?>",
        "employmentType": "unknown",
        "hiringOrganization" : {
          "@type" : "Organization",
          "name" : "<?php echo $obj_einrichtung; ?>"
        },
        "jobLocation": {
          "@type": "Place",
          "address": {
            "@type": "PostalAddress",
            "addressCountry": "<?php echo $obj_geo_country_name; ?>",
            "addressLocality": "<?php echo $obj_geo_locality; ?>",
            "postalCode": "<?php echo $obj_geo_postal_code; ?>",
            "streetAddress": "<?php echo $obj_geo_address ?>"
          },
          "geo": {
            "@type": "GeoCoordinates",
            "latitude": "<?php echo $obj_geo_latitude; ?>",
            "longitude": "<?php echo $obj_geo_longitude; ?>"
          }
        }
      }
    </script>
    <?php
  }
}

/************* ADD HEADER FOR IE *****************/
function obj_add_ie_header($headers) {
	$headers['X-UA-Compatible'] = 'IE=edge,chrome=1';
	return $headers;
}
add_filter('wp_headers', 'obj_add_ie_header');
/*
function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_stylesheet_directory_uri() . '/admin-style.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );
*/
?>