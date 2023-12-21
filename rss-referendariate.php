<?php
/**
 * Template Name: Custom RSS Template - Nur aktuelle Referendariate
 */
$args = array(
        'posts_per_page' => '100',
        'post_type' => 'stellenangebote',
        'post_status' => 'publish',
        'tax_query' => array(
                array(
                        'taxonomy' => 'stellentyp',
                        'field' => 'slug',
                        'terms' => array ('referendariat')
                )
        )
);
$referendariate = new WP_Query( $args );
header('Content-Type: '.feed_content_type('rss2').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:wfw="http://wellformedweb.org/CommentAPI/"
        xmlns:dc="http://purl.org/dc/elements/1.1/"
        xmlns:atom="http://www.w3.org/2005/Atom"
        xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
        xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        xmlns:sjp="https://schema.org/JobPosting"
        <?php do_action('rss2_ns'); ?>>
<channel>
        <title><?php bloginfo_rss('name'); ?> - Aktuelle Refendariatsplätze</title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?php bloginfo_rss('url') ?></link>
        <description>In diesem Feed sind nur aktuelle Referendariatsplätze enthalten</description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php if ($referendariate->have_posts()) : ?>
        <?php while($referendariate->have_posts()) : $referendariate->the_post(); ?>
                <item>
                        <title><?php the_title_rss(); ?></title>
                        <link><?php the_permalink_rss(); ?></link>
                        <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                        <dc:creator><?php the_author(); ?></dc:creator>
                        <guid isPermaLink="false"><?php the_guid(); ?></guid>
                        <?php $post_id = get_the_ID(); ?>
                        <?php $bewerbungsfrist = get_post_meta($post_id, 'Bewerbungsfrist', true); ?>
                        <sjp:validThrough><?php echo date(DATE_ISO8601, strtotime($bewerbungsfrist) + (24*60*60)-1); ?></sjp:validThrough>

                        <?php if ( get_option( 'rss_use_excerpt' ) ) : ?>
                                <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
                        <?php else : ?>
                                <description><![CDATA[<?php the_excerpt_rss(); ?>]]></description>
                                <?php $content = get_the_content_feed( 'rss2' ); ?>
                                <?php if ( strlen( $content ) > 0 ) : ?>
                                        <content:encoded><![CDATA[<?php echo $content; ?>]]></content:encoded>
                                <?php else : ?>
                                        <content:encoded><![CDATA[<?php the_excerpt_rss(); ?>]]></content:encoded>
                                <?php endif; ?>
                        <?php endif; ?>
                        <?php rss_enclosure(); ?>
                        <?php do_action('rss2_item'); ?>
                </item>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
</channel>
</rss>