                <nav class="tab-bar">
                    <div class="left tab-bar-section">
                        <h1><a href="<?php echo $PlanetConfig->getUrl() ?>"><i class="icon-network logo"></i> <?php echo $PlanetConfig->getName(); ?></a></h1>
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
                        <a href="#" class="cubic-icon" id="viewMode" title="<?php echo _g('Toggle view') ?>"><i class="icon-list"></i><span></span></a>
                    </div>
                </nav>
