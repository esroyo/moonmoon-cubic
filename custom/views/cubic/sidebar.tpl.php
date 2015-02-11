<?php
$all_people = &$Planet->getPeople();
usort($all_people, array('PlanetFeed', 'compare'));
?>

            <section id="sidebar-people">
                <h2><?php echo _g('People') . ' (' . count($all_people) . ')'?></h2>
                <ul>
                    <?php foreach ($all_people as $person) : ?>
                    <li>
                        <a href="<?php echo htmlspecialchars($person->getFeed(), ENT_QUOTES, 'UTF-8'); ?>" title="<?php echo _g('Feed')?>" target="_blank"><img src="postload.php?url=<?php echo urlencode(htmlspecialchars($person->getFeed(), ENT_QUOTES, 'UTF-8')); ?>" alt="Feed" height="12" width="12" /><i class="icon-rss-alt"></i></a>
                        <a href="<?php echo $person->getWebsite(); ?>" title="<?php echo _g('Website')?>" target="_blank"><?php echo htmlspecialchars($person->getName(), ENT_QUOTES, 'UTF-8'); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <p>
                <a href="custom/people.opml"><i class="icon-dot-circled"></i> <?php echo _g('All feeds in OPML format')?></a>
                </p>
            </section>
