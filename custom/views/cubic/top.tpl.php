                <nav class="tab-bar">
                    <div class="left tab-bar-section">
                        <h1><i class="icon-network"></i> <a href="<?php echo $PlanetConfig->getUrl() ?>"><?php echo $PlanetConfig->getName(); ?></a></h1>
                    </div>
                    <div class="right-small-float">
                        <a href="./admin/" class="cubic-icon" title="<?php echo _g('Administration')?>"><i class="icon-cog"></i></a>
                    </div>
                    <div class="right-small-float">
                        <a role="button" aria-controls="sidebar" aria-expanded="false" href="#sidebar" class="right-off-canvas-toggle cubic-icon">
                            <i class="icon-group"></i> <label><?php echo _g('People') ?></label>
                        </a>
                    </div>
                    <div class="right-small-float">
                        <a href="?type=cubic-archive" class="cubic-icon" title="<?php echo _g('See all headlines')?>">
                            <i class="icon-archive"></i> <label><?php echo _g('Archives') ?></label>
                        </a>
                    </div>
                    <div class="right-small-float">
                        <a href="atom.php" class="cubic-icon" title="<?php echo _g('Feed (ATOM)') ?>">
                            <i class="icon-rss"></i> <label><?php echo _g('Syndicate') ?></label>
                        </a>
                    </div>
                    <div class="right-small-float">
                        <a href="#" class="cubic-icon" id="viewMode" title="<?php echo _g('Toggle view') ?>"><i class="icon-th-list"></i></a>
                    </div>
                </nav>
