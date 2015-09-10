<?php  global $theme_path;?>

<nav id="aside-menu" class="aside-menu hidden-xs hidden-sm" role="navigation">
   <div class="" id="aside-menu__accordion">
        <ul>
        <?php foreach ($menu as $k=>$m):?>
        <?php if (!$m['link']['hidden']):?>
        <li class="aside-menu__item">
            <?php if (count($m['below'])):?>
            <div class="panel">
                <h4 class="aside-menu__header">  
                    <?php 
                    $active = ''; 
                    if (isset($m['link']['link_path']) && ($m['link']['link_path'] == $_GET ['q'])) {
                        $active = "current"; 
                    }
                    ?>       
                    <?php print l($m['link']['title'], $m['link']['link_path'], array("attributes" =>array("class"=>array("aside-menu__link", $active)))); ?>     
                    
                    <a data-toggle="collapse" data-parent="#aside-menu__accordion" <?php if (in_array($m['link']['mlid'], $active_trail)):?> aria-expanded="true" <?php endif;?> href="#collapse-aside-<?php print $k+1;?>">
                        <i>
                            <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/accordion-arrow.svg');?>
                        </i>
                    </a>
                </h4>
                <ul id="collapse-aside-<?php print $k+1;?>" class=" collapse <?php if (in_array($m['link']['mlid'], $active_trail)):?> in <?php endif;?>">
                    <?php foreach ($m['below'] as $m2):?>
                    <?php if (!$m2['link']['hidden']):?>
                        <li class="aside-menu__item 
                        <?php if (isset($m2['link']['link_path']) && ($m2['link']['link_path'] == $_GET ['q'])) :?> current <?php endif;?>">
                            <?php print l($m2['link']['title'], $m2['link']['link_path'], array("attributes" =>array("class"=>array("aside-menu__link"))));
                            ?>
                        </li>
                    <?php endif;?>
                    <?php endforeach;?>
               </ul>
            </div>
            <?php else: ?>
                <?php 
                $active = ''; 
                if (isset($m['link']['link_path']) && ($m['link']['link_path'] == $_GET ['q'])) {
                    $active = "current"; 
                }
                ?>  
                <?php print l($m['link']['title'], $m['link']['link_path'], array("attributes" =>array("class"=>array("aside-menu__link", $active))));?>
            <?php endif;?>
        </li>
        <?php endif;?>
        <?php endforeach;?>
        </ul>
    </div>

</nav>
