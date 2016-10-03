<?php
ini_set('display_errors', 0);
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

global $page_id, $first_post;
$first_post = false;
if (is_single()) {
    the_post();
    $page_id = get_the_ID();
} elseif (is_home()) {
    $args = array('numberposts' => '1', 'post_status' => 'publish');
    $recent_posts = wp_get_recent_posts($args);
    foreach ($recent_posts as $recent) {
        $page_title = $recent['post_title'];
        $page_id = $recent['ID'];
        $link = get_permalink($page_id);
        $first_post = true;
    }
} elseif (is_category()) {
    $cat = get_the_category();
    $args = array('numberposts' => '1', 'post_status' => 'publish', 'cat' => $cat[0]->cat_ID);
    $recent_posts = wp_get_recent_posts($args);
    foreach ($recent_posts as $recent) {
        $page_title = $recent['post_title'];
        $page_id = $recent['ID'];
        $link = get_permalink($page_id);
        $first_post = true;
    }
} else {
    $args = array('numberposts' => '1', 'post_status' => 'publish');
    $recent_posts = wp_get_recent_posts($args);
    foreach ($recent_posts as $recent) {
        $page_title = $recent['post_title'];
        $page_id = $recent['ID'];
        $link = get_permalink($page_id);
        $first_post = true;
    }
}

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title('&laquo;', true, 'right'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php if (!is_search() && !is_category()) {
        if ($thumb_url = wp_get_attachment_url(get_post_thumbnail_id($page_id))) {
            ?>
            <meta property="og:image" content="<?php echo $thumb_url; ?> "/>
            <?php
        }
    } ?>
</head>

<body <?php body_class(); ?>>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-567409099bcc6ff5" async="async"></script>
<header id="masthead" class="site-header">

    <nav class="navbar navbar-default yamm top-nav">

        <div class="container">
            <div class="navbar-header">

                <button type="button" data-toggle="collapse" data-target="#main-menu"
                        class="navbar-toggle main-toggle collapsed" aria-expanded="false">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <button type="button" data-toggle="collapse" data-target="#search-box"
                        class="navbar-toggle search-toggle collapsed">
                    <i class="fa fa-search"></i>
                </button>
                <button class="navbar-toggle sign hidden-xs">
                    <span>Sign in</span>
                </button>
                <button class="navbar-toggle sign hidden-xs">
                    <span>Sign up</span>
                </button>

                <a class="navbar-brand brand-logo" href="/" rel="home"><img
                        src="<?php echo get_template_directory_uri() . '/img/logo.png'; ?>" alt="EventSource"></a>

            </div>
            <!-- /.navbar-header -->

            <div id="main-menu" class="navbar-collapse collapse" aria-expanded="false">
                <ul class="nav navbar-nav profile-nav">

                    <?php /*<li class="favourites-link"><a href="#" data-toggle="modal" data-target="#favouritesModal"><i
                                class="fa fa-heart-o fa-lg"></i><i class="fa fa-heart fa-lg"></i> Favourites (3)</a>
                    </li>
                    <li class="dropdown user-profile">
                        <a href="#" data-toggle="dropdown"
                           class="dropdown-toggle"><?php echo get_avatar(1, 30, '', '', array('height' => 30, 'weight' => 30)) ?>
                            <span>Jonathan<b class="caret"></b></span></a>
                        <ul role="menu" class="dropdown-menu">
                            <li><a tabindex="-1" href="#">Profile</a></li>
                            <li><a tabindex="-1" href="#">Edit Account</a></li>
                            <li><a tabindex="-1" href="#">Favourites</a></li>
                            <li><a tabindex="-1" href="#">Compare</a></li>
                            <li><a tabindex="-1" href="#">Check List</a></li>
                            <li><a tabindex="-1" href="#">Log Out</a></li>
                        </ul>
                    </li> */ ?>
                    <li><a href="/blog-submission">Submit to Blog</a></li>
                    <li class="get-listed-link"><a class="btn btn-blue" href="/add_your_business.aspx">LIST YOUR BUSINESS</a></li>

                </ul>
                <?php require_once('header-menu.php'); ?>
            </div>
            <!-- /#main-menu -->
            <div class="row top-block-for-widgets">
                <?php dynamic_sidebar('top-block'); ?>
            </div>

        </div>

        <div id="search-box" class="navbar-collapse collapse mobile">
            <div class="container">
                <div id="frmSearch">

                    <form id="globalSearchForm" action="/search.aspx" method="GET">
                        <input type="text" class="sprite txtSearch" name="listingName" id="txtSearch1"
                               placeholder="What are you searching for?" onfocus="clearOnce('txtSearch1');"
                               onblur="blurOnce('txtSearch1');">
                        <input type="hidden" name="searchType"/>
                        <input type="hidden" name="search" value="3"/>
                        <button type="submit" style="display: none" class="sprite" id="btnSearch1" name="btnSearch">Search</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /#search-box -->

        <div id="search-suggestions">
            <div class="container">
                <i class="fa fa-search"></i>

                <div id="frmSearch">

                    <form id="globalSearchForm" action="/search.aspx" method="POST">
                        <input type="text" class="sprite txtSearch" name="listingName" id="txtSearch"
                               placeholder="What are you searching for?" onfocus="clearOnce('txtSearch');"
                               onblur="blurOnce('txtSearch');">
                        <input type="hidden" name="searchType"/>
                        <input type="hidden" name="search" value="3"/>
                        <button type="submit" class="sprite" id="btnSearch" name="btnSearch">Search</button>
                    </form>
                    </form>
                    <a class="close-ss" href="#"><i class="fa fa-times-thin"></i></a>
                </div>
            </div>
            <!-- #/search-suggestions -->

    </nav>

</header>
<main<?php if (is_search() || is_category()) {
    echo " class='search-page'";
} ?>>
    <div id="page">
        <?php if (!is_search() && !is_category() && !is_author()): ?>
            <div class="title-block" <?php $position = get_post_field('featured_bg_position', $page_id);
            $position = $position ? $position : 50;
            if ($thumb_url = wp_get_attachment_url(get_post_thumbnail_id($page_id))) {
                echo "style='background-image:url(\"$thumb_url\");background-position: 0 {$position}%;'";
            } ?>>
                <?php if (is_home()): ?>
                    <div class="title">
                        <span><?php _e(is_home() ? 'Latest article' : $cat[0]->name); ?></span>

                    </div>
                    <h1 class="description">
                        <a href="<?php echo $link; ?>"><?php echo get_the_title($page_id); ?></a>
                    </h1>
                    <a href="#content" class="scroll-to-content"></a>
                <?php elseif (is_single()): ?>
                    <div class="title">
                    </div>
                    <h1 class="description">
                        <?php the_title(); ?>
                    </h1>
                    <div class="top_metadata hidden-sm hidden-xs">
                        <div class="author-avatar">
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                <?php echo get_avatar(get_the_author_meta('ID'), 70, '', '', array('height' => 70, 'weight' => 70, 'class' => 'no-lazy')); ?>
                            </a>
                        </div>
                        <div class="author-name ">
                            <?php the_author_posts_link(); ?>
                        </div>
                        <div class="post-info">
                            <div class="date">
                                            <span
                                                class="sub-title"><?php the_time('F j, Y') //the_time('M j') ?></span>
                            </div>
                            <div class="comments">
                                            <span class="sub-content"><?php _e('Comments'); ?>
                                                <?php if (comments_open(get_the_ID()) && wp_count_comments(get_the_ID())->total_comments > 0) {
                                                    $comments_count = wp_count_comments(get_the_ID());
                                                    echo '<a class="not-padding-link" href="' . get_permalink() . '#comments" title="">(' . $comments_count->approved . ')</a>';
                                                } else { ?>
                                                    <a class="not-padding-link"
                                                       href="<?php the_permalink(); ?>#comments" title="">(
                                                        <fb:comments-count href="<?php the_permalink(); ?>"
                                                                           fb-xfbml-state="rendered" class="">
                                                            <span class="fb_comments_count"></span>
                                                        </fb:comments-count>
                                                        )</a>
                                                <?php } ?>
                                            </span>
                            </div>
                            <div class="categories">
                                <?php
                                $cats = get_the_category_list(', ');
                                if ($cats) { ?>
                                    <span class="sub-title"><?php _e('Category: '); ?></span><span
                                        class="sub-content"><?php echo $cats; ?></span>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                <?php elseif (is_search()): ?>
                    <!--                <div class="title">-->
                    <!--                    <span>--><?php //_e('Latest article'); ?><!--</span>-->
                    <!---->
                    <!--                </div>-->
                    <div class="description">
                        <?php _e('Search'); ?>
                    </div>
                    <a href="#content" class="scroll-to-content"></a>
                <?php elseif (is_category()): ?>
                    <!--                <div class="title">-->
                    <!--                    <span>--><?php //_e('Latest article'); ?><!--</span>-->
                    <!---->
                    <!--                </div>-->
                    <div class="description">
                        <?php echo $cat[0]->name; ?>
                    </div>
                    <a href="#content" class="scroll-to-content"></a>
                <?php else: ?>
                    <!--                <div class="title">-->
                    <!--                    <span>--><?php //_e('Latest article'); ?><!--</span>-->
                    <!---->
                    <!--                </div>-->
                    <div class="description">
                        <?php the_title(); ?>
                    </div>
                    <a href="#content" class="scroll-to-content"></a>

                <?php endif; ?>
            </div>
        <?php endif; ?>
        <!--		--><?php //get_sidebar('before_content');?>
        <div id="content" class="site-content">
            <div class="container-fluid">
                <div class="row">
