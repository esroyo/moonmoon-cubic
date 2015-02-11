<?php
require_once(dirname(__FILE__).'/func.inc.php');
$limit = $PlanetConfig->getMaxDisplay();
$count = 0;

header('Content-type: text/html; charset=UTF-8');
?><!DOCTYPE html>
<html class="no-js" lang="<?php echo $conf['locale']?>">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $PlanetConfig->getName(); ?></title>
    <?php include(dirname(__FILE__).'/head.tpl.php'); ?>
</head>

<body>

    <div class="off-canvas-wrap" data-offcanvas>
        <div class="inner-wrap">

            <header class="fixed" id="header">
                <?php include(dirname(__FILE__).'/top.tpl.php'); ?>
            </header>

            <!-- Off Canvas Menu -->
            <aside class="right-off-canvas-menu" id="sidebar">
                <?php include_once(dirname(__FILE__).'/sidebar.tpl.php'); ?>
            </aside>

            <!-- main content -->
            <main id="content">

                <div class="row">
                    <div class="columns">
                        <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3 xlarge-block-grid-4 xxlarge-block-grid-5"><!-- block grid start -->
                        <?php if (0 == count($items)) : ?>
                            <li><article class="article">
                                <h2 class="article-title">
                                    <?php echo _g('No article', 'note de trad')?>
                                </h2>
                                <section class="article-content"><?php echo _g('No news, good news.')?></section>
                            </article></li>
                        <?php else : ?>
                            <?php foreach ($items as $item): ?>
                                <?php
                                $arParsedUrl = parse_url($item->get_feed()->getWebsite());
                                $host = 'from-' . preg_replace('/[^a-zA-Z0-9]/i', '-', $arParsedUrl['host']);
                                $img = the_image_src($item->get_content());
                                $content = preg_replace(
                                    array(
                                        '@<(script|style)[^>]*?>.*?</\\1>@si',
                                        '@<(object|embed|iframe)[^>]*?>.*?</\\1>@si'
                                    ),
                                    array(
                                        '',
                                        '<div class="flex-video">$0</div>'
                                    ),
                                    $item->get_content()
                                );
                                $title = strip_tags( $item->get_title() );
                                ?>
                                <li><div class="article-container" id="container-<?php echo $count ?>">

                                    <?php if ($img): ?>
                                    <div class="row"><!-- .row start -->
                                        <div class="columns">
                                            <div class="mini-hero" style="background-image: url('<?php echo $img ?>')"></div>
                                        </div>
                                    </div><!-- .row end -->
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="columns">

                                            <article class="article <?php echo $host; ?>">
                                                <section class="article-excerpt">
                                                    <h2 class="article-title">
                                                        <a href="#" data-reveal-id="content-<?php echo $count ?>" id="link-<?php echo $count ?>"  title="<?php echo $title ?>"><?php echo $title ?></a>
                                                    </h2>

                                                    <?php echo html_excerpt($content, $img ? 200 : 600, ' ...') ?>
                                                    <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $title ?>" class="button tiny secondary" target="_blank"><i class="icon-link"></i> <?php echo _g('Read original') ?></a>

                                                </section>
                                                <section id="content-<?php echo $count ?>" class="reveal-modal article-modal" data-reveal>
                                                    <h2 class="article-title">
                                                        <a href="<?php echo $item->get_permalink(); ?>" title="Go to original place" target="_blank"><?php echo $title ?></a>
                                                    </h2>
                                                    <section class="article-info">

                                                        <?php echo ($item->get_author() && !empty($item->get_author()->get_name()) ? $item->get_author()->get_name() : 'Anonymous'); ?>,
                                                        <?php
                                                        $ago = time() - $item->get_date('U');
                                                        //echo '<span title="'.Duration::toString($ago).' ago" class="date">'.date('d/m/Y', $item->get_date('U')).'</span>';
                                                        echo '<time id="post'.$item->get_date('U').'" class="date">'.$item->get_date('d/m/Y').'</time>';
                                                        ?>

                                                        |

                                                        <?php echo _g('Source:')?> <?php
                                                        $feed = $item->get_feed();
                                                        echo '<a href="'.$feed->getWebsite().'" class="source" target="_blank">'.$feed->getName().'</a>';
                                                        ?>
                                                    </section>
                                                    <?php echo $content ?>
                                                    <a class="close-reveal-modal">&#215;</a>
                                                </section>

                                            </article>

                                        </div>
                                    </div>

                                </div></li>
                                <?php if (++$count == $limit) { break; } ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </ul><!-- block grid end -->
                    </div>
                </div><!-- .row end -->

                <div class="row">
                    <div class="columns"><!-- #footer start -->
                        <?php include(dirname(__FILE__).'/footer.tpl.php'); ?>
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
                $body = $('body'),
                $viewMode = $('#viewMode'),
                $viewModeIcon = $('i', $viewMode),
		$block = $('main ul.small-block-grid-1'),
                classStr = 'medium-block-grid-2 large-block-grid-3 xlarge-block-grid-4 xxlarge-block-grid-5';
                

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
                $body.animate({scrollTop: 0}, duration);
                return false;
            });

            // setup clicks on th view
            for(var i = 0; i < <?php echo $count ?>; i += 1) {
                $('#container-' + i).click(
                    (function(n) {
                        return function(e) {
                            if (!$body.hasClass('expanded') && !e.target.id.match(/^link/))
                                $('#link-' + n).trigger('click');
                        };
                    }(i)))
                .find('a[target=_blank]')
                .click( function(e) {
                    e.stopPropagation();
                });
            }

            // setup view mode button
            $viewMode.on('click', function(e) {
                e.preventDefault();
                if ($body.hasClass('expanded')) {
                    $body.removeClass('expanded');
                    $block.addClass(classStr);
                    $viewModeIcon.attr('class', 'icon-th-list');
                } else { 
                    $body.addClass('expanded');
                    $block.removeClass(classStr);
                    $viewModeIcon.attr('class', 'icon-th');
                }
                return false;
            });

            // init foundation
            $(document).foundation();
        });
    </script>

</body>
</html>
