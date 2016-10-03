<ul class="nav navbar-nav primary-nav DefaultOverflow clearfix">
    <?php

    $host = 'localhost';
    $user = 'dbuser3';
    $pass = 'jejsl392';
    $dbname = 'tc_hackables2';

    $category_connection_link = mysql_connect($host, $user, $pass);
    mysql_set_charset('utf8', $category_connection_link);
    mysql_select_db($dbname);

    $sqlTemplate = '
	SELECT 
		c.CategoryID,
		c.CategoryName,
		c.AlternateName,
		c.PageUrl,
		pc.PageUrl AS RootPage
	FROM Category c
	INNER JOIN Category pc 
		ON c.ParentCategoryID = pc.CategoryID
	WHERE pc.CategoryName = \'%s\'
		AND c.IsEnabled = 1 AND c.IsSubcategory = 0 %s';

    $categories = array(
        array('label' => 'Venues by Event-type', 'name' => 'venues_occasions', 'category' => 'venues', 'extra' => ' AND c.IsOccasion = 1', 'disable_sort' => TRUE),
        array('label' => 'Venues by Venue-type:', 'name' => 'venues', 'extra' => ' AND c.IsOccasion = 0 AND c.IsAtmosphere = 0'),
        array('label' => 'Caterers', 'name' => 'caterers', 'extra' => ''),
        array('label' => 'Event Planners', 'name' => 'eventplanners', 'extra' => ''),
        array('label' => 'All Photo & Video', 'name' => 'photoandvideo', 'extra' => ''),
        array('label' => 'Music', 'name' => 'music', 'extra' => ''),
        array('label' => 'Decor & Rentals: Decor', 'name' => 'decor', 'extra' => ''),
        array('label' => 'Decor & Rentals: Rentals', 'name' => 'rentals', 'extra' => ''),
        array('label' => 'More', 'name' => 'more', 'extra' => ''),
    );

    $menu = array();

    foreach ($categories as $cat) {
        $query = sprintf($sqlTemplate, mysql_real_escape_string($cat['category'] ? $cat['category'] : $cat['name']), $cat['extra']);
        if (!$cat['disable_sort']) {
            $query .= ' ORDER BY c.CategoryName';
        }

        $result = mysql_query($query);

        if ($result) {
            while ($row = mysql_fetch_assoc($result)) {
                if ($cat['name'] == 'more' || $cat['name'] == 'photoandvideo') {
                    $menu[$cat['name']][] = array('label' => $row['AlternateName'], 'url' => $row['PageUrl']);
                } else {
                    $menu[$cat['name']][] = array('label' => $row['AlternateName'], 'url' => $row['RootPage'] . $row['PageUrl']);
                }
            }
        }
    }

    ?>
    <li class="dropdown">
        <a href="/venues" data-toggle="dropdown" class="dropdown-toggle">venues</a>
        <ul class="dropdown-menu">
            <li>
                <div class="yamm-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <h4 class="media-heading">By Event Type</h4>
                            <ul class="list-unstyled">
                                <?php
                                foreach ($menu['venues_occasions'] as $item) {
                                    ?>
                                    <li>
                                        <a tabindex="-1" href="<?= $home . $item['url'] ?>"><?= $item['label'] ?></a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>

                        <?php
                        $deviceTypes = array('desktop','mobile');
                        $venues_count = count($menu['venues']);
                        foreach ($deviceTypes as $type) {
                            $boundary = $type == 'desktop' ? 3 : 2;
                            $fraction = ceil($venues_count / $boundary);
                            $cssDiv = $type == 'desktop' ? "col-md-3 not-mob-tab" : "col-xs-6 only-mob-tab";
                            $cssH4 = $type == 'desktop' ? "not-mob-tab" : "";

                            for ($i = 0; $i < $boundary; $i++) { ?>
                                <div class="<?= $cssDiv ?>">
                                    <h4 class="media-heading <?= $cssH4 ?>"><?= $i == 0 ? "By Venue-Type" : "&nbsp;" ?></h4>
                                    <ul class="list-unstyled">
                                        <?php
                                        for ($j = $i * $fraction; $j < $fraction * ($i + 1); $j++) {
                                            if ($j == $venues_count) {
                                                break;
                                            }

                                            ?>
                                            <li>
                                                <a tabindex="-1" href="<?= $home . $menu['venues'][$j]['url'] ?>"><?= $menu['venues'][$j]['label'] ?></a>
                                            </li>
                                        <? }
                                        ?>
                                    </ul>
                                </div>
                            <? }
                        }
                        ?>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="divider"></p>

                            <p class="yamm-footer"><a href="/venues" tabindex="-1">Show All Venues</a></p>
                            <ul class="list-unstyled only-mob-tab">
                                <li><a class="back2menu" tabindex="-1" href="javascript:;">Back to Menu</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="/caterers" data-toggle="dropdown" class="dropdown-toggle">caterers</a>
        <ul role="menu" class="dropdown-menu">
            <?php
            foreach ($menu['caterers'] as $item) {
                ?>
                <li>
                    <a tabindex="-1" href="<?= $home . $item['url'] ?>"><?= $item['label'] ?></a>
                </li>
                <?php
            }
            ?>
            <li class="divider"></li>
            <li><a tabindex="-1" href="/caterers">Show All Caterers</a></li>
            <li class="divider only-mob-tab"></li>
            <li class="only-mob-tab"><a class="back2menu" tabindex="-1" href="javascript:;">Back to Menu</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="/event-planners" data-toggle="dropdown" class="dropdown-toggle">event planners</a>
        <ul role="menu" class="dropdown-menu">
            <?php
            foreach ($menu['eventplanners'] as $item) {
                ?>
                <li>
                    <a tabindex="-1" href="<?= $home . $item['url'] ?>">
                        <?= $item['label'] ?>
                    </a>
                </li>
                <?php
            }
            ?>
            <li class="divider"></li>
            <li><a tabindex="-1" href="/event-planners">All Planners</a></li>
            <li class="divider only-mob-tab"></li>
            <li class="only-mob-tab"><a class="back2menu" tabindex="-1" href="javascript:;">Back to Menu</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="/photographers-videographers" data-toggle="dropdown" class="dropdown-toggle">photo & video</a>
        <ul role="menu" class="dropdown-menu">
            <?php
            foreach ($menu['photoandvideo'] as $item) {
                ?>
                <li>
                    <a tabindex="-1" href="<?= $home . $item['url'] ?>">
                        <?= $item['label'] ?>
                    </a>
                </li>
                <?php
            }
            ?>
            <li class="divider"></li>
            <li><a tabindex="-1" href="/photographers-videographers">All Photo & Video</a></li>
            <li class="divider only-mob-tab"></li>
            <li class="only-mob-tab"><a class="back2menu" tabindex="-1" href="javascript:;">Back to Menu</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="/music" data-toggle="dropdown" class="dropdown-toggle">music</a>
        <ul role="menu" class="dropdown-menu">
            <?php
            foreach ($menu['music'] as $item) {
                ?>
                <li>
                    <a tabindex="-1" href="<?= $home . $item['url'] ?>">
                        <?= $item['label'] ?>
                    </a>
                </li>
                <?php
            }
            ?>
            <li class="divider"></li>
            <li><a tabindex="-1" href="/music">Show All Music</a></li>
            <li class="divider only-mob-tab"></li>
            <li class="only-mob-tab"><a class="back2menu" tabindex="-1" href="/music">Back to Menu</a></li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="/decor-rentals" data-toggle="dropdown" class="dropdown-toggle">décor & rentals</a>
        <ul class="dropdown-menu decor-rentals-nav">
            <li>
                <div class="yamm-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <h4 class="media-heading"><a href="/event-decor">Event Décor</a></h4>
                            <ul class="list-unstyled">
                                <?php
                                foreach ($menu['decor'] as $item) {
                                    ?>
                                    <li>
                                        <a tabindex="-1" href="<?= $home . $item['url'] ?>">
                                            <?= $item['label'] ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <h4 class="media-heading"><a href="/event-rentals">Event Rentals</a></h4>
                            <ul class="list-unstyled">
                                <?
                                foreach ($menu['rentals'] as $item) {
                                    ?>
                                    <li>
                                        <a tabindex="-1" href="<?= $home . $item['url'] ?>">
                                            <?= $item['label'] ?>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="divider"></p>

                            <p class="yamm-footer"><a href="/decor-rentals" tabindex="-1">Show All Décor & Rentals</a></p>
                            <ul class="list-unstyled only-mob-tab">
                                <li><a class="back2menu" tabindex="-1" href="javascript:;">Back to Menu</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </li>

    <li class="dropdown">
        <a href="#" data-toggle="dropdown" class="dropdown-toggle">more</a>
        <ul role="menu" class="dropdown-menu">
            <?php
            foreach ($menu['more'] as $item) {
                ?>
                <li>
                    <a tabindex="-1" href="<?= $home . $item['url'] ?>"><?= $item['label'] ?></a>
                </li>
                <?php
            }
            ?>
            <li class="divider only-mob-tab"></li>
            <li class="only-mob-tab"><a class="back2menu" tabindex="-1" href="javascript:;">Back to Menu</a></li>
        </ul>
    </li>


    <li class="deals-link"><a href="<?php echo $home; ?>/deals/">deals</a></li>
    <li class="blog-link"><a href="/blog">blog</a></li>
    <li class="search-link"><a href="#"><i class="fa fa-search"></i></a></li>
</ul>