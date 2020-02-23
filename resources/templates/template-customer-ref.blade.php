<?php
/*
  Template Name: RSS custom feed
 */
$today = getdate();

if (isset($_GET['y'])) {
    $year = $_GET['y'];
    $numposts = 0;
} else {
    $year = $today['year'];
    $numposts = 50;
}

if (isset($_GET['mo'])) {
    $month = $_GET['mo'];
    $numposts = 0;
} else {
    $month = $today['mon'];
    $numposts = 50;
}

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 0;
}

$feed_args = array(
    'numberposts' => $numposts,
    'post_status' => 'publish',
    'post_type' => 'post',
);
header("Content-Type: application/rss+xml; charset=UTF-8");
echo "<?xml version='1.0' encoding='UTF-8' ?>";
?>
<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
     >
    <channel>
        <title><?php bloginfo("name"); ?></title>
        <atom:link href="<?php echo get_permalink(); ?>" rel="self" type="application/rss+xml" />
        <link><?php echo get_permalink(); ?></link>

        <description><?php bloginfo("description"); ?></description>
        <lastBuildDate><?php echo date('r') ?></lastBuildDate>
        <language><?php bloginfo("language"); ?></language>
        <generator><?php bloginfo("url"); ?></generator>
        <?php
        $feed_posts = get_posts($feed_args);
        foreach ($feed_posts as $post) : setup_postdata($post);
            $category = get_the_category();
            ?>
            <item>
                <title><?php the_title(); ?></title>
                <link><?php the_permalink(); ?></link>
               <?php
               $image_url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) );
                if($image_url): ?>
                <image>
                <url><?php echo $image_url; ?> </url>
                </image>
                <?php endif;?>
                <pubDate><?php the_time('r'); ?> </pubDate>
                <dc:creator><?php the_author(); ?></dc:creator>
                <category><?php echo $category[0]->cat_name; ?></category>
                <guid><?php echo get_permalink(); ?></guid>
                <description><![CDATA[ <?php echo the_content(); ?>]]></description>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
