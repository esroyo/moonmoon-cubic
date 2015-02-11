<?php
$count = 0;
$today = Array();
$week = Array();
$month = Array();
$older = Array();
$now = time();

foreach ($items as $item) {
    $age = ($now - $item->get_date('U')) / (60*60*24);
    if ($age < 1) {
        $today[] = $item;
    } elseif ($age < 7) {
        $week[] = $item;
    } elseif ($age < 30) {
        $month[] = $item;
    } else {
        $older[] = $item;
    }
}

header('Content-type: text/html; charset=UTF-8');
?><!DOCTYPE html>
<html class="no-js" lang="<?php echo $conf['locale']?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $PlanetConfig->getName(); ?></title>
    <?php include(dirname(__FILE__).'/../cubic/head.tpl.php'); ?>
</head>

<body class="archive">

    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">

            <header class="fixed" id="header">
                <?php include(dirname(__FILE__).'/../cubic/top.tpl.php'); ?>
            </header>

            <!-- Off Canvas Menu -->
            <aside class="right-off-canvas-menu" id="sidebar">
                <?php include_once(dirname(__FILE__).'/../cubic/sidebar.tpl.php'); ?>
            </aside>

            <!-- main content -->
            <main id="content">

                <div class="row">
                    <div class="columns">

            <?php if (0 == count($items)) :?>
            <article class="article">
                <h2 class="article-title">
                    <?php echo _g('No article')?>
                </h2>
                <section class="article-content"><?php echo _g('No news, good news.')?></section>
            </article>
            <?php endif; ?>
            <?php if (count($today)): ?>
            <article class="article">
                <h2><?php echo _g('Today')?></h2>
                <ul>
                <?php foreach ($today as $item): ?>
                    <?php $feed = $item->get_feed(); ?>
                    <li>
                    <a href="<?php echo $feed->getWebsite() ?>" class="source"><?php echo $feed->getName() ?></a> :
                    <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo _g('Go to original place')?>"><?php echo $item->get_title(); ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </article>
            <?php endif; ?>

            <?php if (count($week)): ?>
            <article class="article">
                <h2><?php echo _g('This week')?></h2>
                <ul>
                <?php foreach ($week as $item): ?>
                    <?php $feed = $item->get_feed(); ?>
                    <li>
                    <a href="<?php echo $feed->getWebsite() ?>" class="source"><?php echo $feed->getName() ?></a> :
                    <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo _g('Go to original place')?>"><?php echo $item->get_title(); ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </article>
            <?php endif; ?>

            <?php if (count($month)): ?>
            <article class="article">
                <h2><?php echo _g('This month')?></h2>
                <ul>
                <?php foreach ($month as $item): ?>
                    <?php $feed = $item->get_feed(); ?>
                    <li>
                    <a href="<?php echo $feed->getWebsite() ?>" class="source"><?php echo $feed->getName() ?></a> :
                    <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo _g('Go to original place')?>"><?php echo $item->get_title(); ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </article>
            <?php endif; ?>

            <?php if (count($older)): ?>
            <article class="article">
                <h2><?php echo _g('Older items')?></h2>
                <ul>
                <?php foreach ($older as $item): ?>
                    <?php $feed = $item->get_feed(); ?>
                    <li>
                    <a href="<?php echo $feed->getWebsite() ?>" class="source"><?php echo $feed->getName() ?></a> :
                    <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo _g('Go to original place')?>"><?php echo $item->get_title(); ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </article>
            <?php endif; ?>

                    </div>
                </div><!-- .row end -->

                <div class="row">
                    <div class="columns"><!-- #footer start -->
                        <?php include(dirname(__FILE__).'/../cubic/footer.tpl.php'); ?>
                    </div><!-- #footer end -->
                </div>


                <a id="up" href="#" class="button secondary tiny radius" title="<?php echo _g('Scroll to top') ?>">
                    <i class="icon-up-open"></i>
                </a>

            </main><!-- #content end -->

            <a class="exit-off-canvas"></a>

        </div><!-- .inner-wrap end -->
    </div><!-- .off-canvas-wrap end -->

    <script src="custom/components/foundation/js/vendor/jquery.js"></script>
    <script src="custom/components/foundation/js/foundation.min.js"></script>
    <script>
        jQuery(document).ready(function($) {

            var offset = 220,
                duration = 600,
                $up = $('#up').data('shown', false),
                $htmlbody = $('html, body'),
                $body = $htmlbody.eq(1),
                $viewMode = $('#viewMode');

            // setup scroll to top button
            $(window).scroll(function() {
                if ($(this).scrollTop() > offset) {
                    if (!$up.data('shown'))
                        $up.data('shown', true).fadeIn(duration);
                } else {
                    if ($up.data('shown'))
                        $up.data('shown', false).fadeOut(duration);
                }
            });
            $up.click( function(e) {
                e.preventDefault();
                $htmlbody.animate({scrollTop: 0}, duration);
                return false;
            });

            // remove view mode button
            $viewMode.parent().remove();

            // init foundation
            $(document).foundation();
        });
    </script>

</body>
</html>
