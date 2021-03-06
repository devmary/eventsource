<?php //require(WEBTREATS_INCLUDES . "/var.php"); ?>
</div><!-- inner -->
</div><!-- inner -->
</div><!-- inner -->
</div><!-- body_block -->
</div><!-- body_block -->
<?php if (is_single()): ?>
    <div class="col-xs-12 articles">
        <div class="site-content">
            <div class="header">
                <div class="col-md-3 col-md-offset-3 active" data-slider="sim-posts">Similar Articles</div>
                <div class="col-md-3" data-slider="rec-posts">Recent Articles</div>
            </div>
            <div class="clearfix"></div>
            <div class="sim-posts active">
                <?php
                $args = array(
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 10,
                    'caller_get_posts' => 1
                );

                $tags = wp_get_post_tags(get_the_ID());
                $cats = wp_get_post_categories(get_the_ID());
                if ($tags) {
                    $first_tag = $tags[0]->term_id;
                    $args['tag__in'] = array($first_tag);
                }
                if($cats){
                    foreach($cats as $cat){

                        $cat_ids[] = $cat;
                    }
                    $args['category__in'] = $cat_ids;
                }
                $my_query = new WP_Query($args);
                if ($my_query->have_posts()) {
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <div class="item">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'high'); ?>
                                <div class="thumb" style="background-image: url('<?php echo $thumb[0] ? $thumb[0] : get_template_directory_uri().'/img/header.jpg'; ?>')"></div>
                                <div class="title"><strong><?php the_title(); ?></strong></div>
                            </a>
                        </div>

                        <?php
                    endwhile;
                }
                wp_reset_query();

                ?>
            </div>

            <div class="rec-posts">
                <?php
                $args = array(
                    'post__not_in' => array(get_the_ID()),
                    'posts_per_page' => 10,
                    'caller_get_posts' => 1,
                    'orderby'=>"post_date"
                );
                $my_query = new WP_Query($args);
                if ($my_query->have_posts()) {
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <div class="item">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(),'high'); ?>
                                <div class="thumb" style="background-image: url('<?php echo $thumb[0] ? $thumb[0] : get_template_directory_uri().'/img/header.jpg'; ?>')"></div>
                                <div class="title"><strong><?php the_title(); ?></strong></div>
                            </a>
                        </div>

                        <?php
                    endwhile;
                }
                wp_reset_query();

                ?>
            </div>

        </div>
    </div>
    <div class="clearfix"></div>

<?php endif; ?>
</main>
<footer id="colophon" class="site-footer">

    <div class="container">

        <div class="row">

            <div class="col-xs-12 col-sm-3">
                <a href="#"><img src="<?php echo get_template_directory_uri() . '/img/logo-footer.png'; ?>" class="footer-logo" alt=""></a>
            </div>
            <!-- ./col-xs-12 -->

            <div class="bottom-widgets col-xs-12 col-sm-3">

                <h2>Company</h2>

                <ul class="default-links">
                    <li><a href="/">Home</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/blog-submission">Submit to Blog</a></li>
                    <li><a href="/add_your_business.aspx">List Your Business</a></li>
                    <li><a href="/privacy.aspx">Privacy Policy</a></li>
                    <li><a href="/termsofuse.aspx">Terms of Use</a></li>
                    <li><a href="/contact_us.aspx">Contact us</a></li>
                </ul>

            </div>
            <!-- ./col-xs-12 -->

            <div class="bottom-widgets col-xs-12 col-sm-3">

                <h2>Vendors</h2>

                <ul class="default-links">
                    <li><a href="/venues">Venues </a></li>
                    <li><a href="/caterers">Caterers</a></li>
                    <li><a href="/event-planners">Event Planners</a></li>
                    <li><a href="/photographers">Photographers</a></li>
                    <li><a href="/videographers">Videographers</a></li>
                    <li><a href="/music">Music</a></li>
                    <li><a href="/decor-rentals">Decor &amp; Rentals</a></li>
                </ul>

            </div>
            <!-- ./col-xs-12 -->

            <div class="bottom-widgets col-xs-12 col-sm-3">

                <h2>Find us on</h2>

                <ul class="social-links">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>

                <p class="affiliation-button"><a href="#">Advertise with us!</a></p>

            </div>
            <!-- ./col-xs-12 -->

        </div>
        <!-- ./row -->

    </div>
    <!-- ./container -->

    <div class="copyright">

        <div class="text-center">

            <a href="/add_your_business.aspx">Advertise with Us</a>
            <a href="/privacy.aspx">Privacy Policy</a>
            <a href="/termsofuse.aspx">Terms of Use</a>
            <a href="/contact_us.aspx">Contact Us</a>

        </div>

    </div>
    <!-- ./copyright -->

    <a href="#" class="to-top"><i class="fa fa-chevron-up"></i></a>

</footer><!-- ./footer -->


<div style="display: none;">
    <div id="favouritesPopup">
        <h3 class="sprite">My Favourites List</h3>
        <ul id="favouritesPopupUL" class="favs"></ul>
        <section class="actions" id="popActions">
            <p class="right">
                <a href="javascript:void(0);" id="closefancyBox">Clear this List</a>
            </p>
        </section>
        <!--
        For default (empty) list, delete the above UL and SECTION tags and replace them with this P tag
        <p class="empty">Your list is currenly empty</p>
    -->
    </div>
</div>

<!-- footer -->


<?php wp_footer(); ?>

<!--<script type="text/javascript" src="/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-validate.bootstrap-tooltip.js"></script>

<!-- <script type="text/javascript" src="/js/jasny-bootstrap.min.js"></script> -->
<!-- <script type="text/javascript" src="/js/owl.carousel.min.js"></script> -->
<link type="text/css" href="/css/jquery.mCustomScrollbar.min.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jquery.mCustomScrollbar.min.js"></script>

<!--<script type="text/javascript">Cufon.now();</script>-->
<?php if ($analytics_code <> "") {
    echo stripslashes($analytics_code);
} ?>
<script type="text/javascript">
    /* <![CDATA[ */
    function expandIt(getIt) {
        getIt.style.display = (getIt.style.display == "none") ? "" : "none";
    }
    /* ]]> */
</script>
<script type="text/javascript" src="//my.hellobar.com/a32c06d7fed72b13490e396edf3b15713df80873.js"
        async="async"></script>

<!-- Google Tag Manager -->
<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-MNTPGJ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<script>(function (w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({'gtm.start': new Date().getTime(), event: 'gtm.js'});
        var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src = '//www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-MNTPGJ'); </script>
<!-- End Google Tag Manager -->

<!-- Google Code for Remarketing Tag -->
<!--<script type="text/javascript"> /* <![CDATA[ */ var google_conversion_id = 1026956301; var google_custom_params = window.google_tag_params; var google_remarketing_only = true; /* ]]> */ </script> <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"> </script> <noscript> <div style="display:inline;"> <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1026956301/?value=0&amp;guid=ON&amp;script=0"/> </div> </noscript>-->

<!-- Facebook Code for Vendor Marketing Leads -->
<script>(function () {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
            var fbds = document.createElement('script');
            fbds.async = true;
            fbds.src = '//connect.facebook.net/en_US/fbds.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(fbds, s);
            _fbq.loaded = true;
        }
    })();
    window._fbq = window._fbq || [];
    window._fbq.push(['track', '6028692421500', {'value': '0.00', 'currency': 'CAD'}]);
</script>

</body>
</html>
