<?php global $theme_path;?>
<div id="aside-menu-shade" class="aside-menu-shade visible-xs visible-sm"></div>
<nav id="mobile-menu" class="mobile-menu aside-menu visible-xs visible-sm" role="navigation">
    <a href="#" id="mobile-menu__close" class="aside-menu__close">
         <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/close.svg');?>
    </a>
   <div class="" id="mobile-menu__accordion">
    <ul>
    <?php foreach ($menu as $k=>$m):?>
        <?php if (!$m['link']['hidden']):?>
        <?php 
        $children = array_values($m['below']);
        _econ_pages_remove_hidden($children);
        ?>
        <?php if (count($children)):?>
        <li class="aside-menu__item">
            <div class="panel">
                <h4 class="aside-menu__header">
                    <?php print l($m['link']['title'], 
                        $m['link']['link_path'], 
                        array("attributes"=>array("class"=>array("aside-menu__link")))); ?>

                    <a data-toggle="collapse" <?php if (in_array($m['link']['mlid'], $active_trail)):?> aria-expanded="true" <?php endif;?> data-parent="#mobile-menu__accordion" href="#collapse-mobile-<?php print $k;?>">
                          <i><?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/accordion-arrow.svg');?></i>
                    </a>
                </h4>
                <ul id="collapse-mobile-<?php print $k;?>" 
                    class="collapse <?php if (in_array($m['link']['mlid'], $active_trail)):?> in <?php endif;?>">
                        <?php foreach ($children as $m2):?>
                        <?php if (!$m2['link']['hidden']):?>
                        <li class="aside-menu__item <?php 
                        if (isset($m2['link']['link_path']) && ($m2['link']['link_path'] == $_GET ['q'])) :?> current <?php endif;?>">
                            <?php 
                                print l($m2['link']['title'], 
                                $m2['link']['link_path'], 
                                array("attributes"=>array("class"=>array("aside-menu__link"))));
                            ?>
                        <?php endif;?>
                        <?php endforeach;?>
                </ul>      
            </div>
        </li>
        <?php else:?>
            <li class="aside-menu__item <?php 
                        if (isset($m['link']['link_path']) && ($m['link']['link_path'] == $_GET ['q'])) :?> current <?php endif;?>">
            <?php print l($m['link']['title'], $m['link']['link_path'], array("attributes" =>array("class"=>array("aside-menu__link"))));?>
            </li>
        <?php endif;?>
        <?php endif;?>
    <?php endforeach;?>
    </div>
    <div class="aside-menu__shortcuts">
        <?php 
            $shortcuts = menu_tree_all_data("menu-shortcatmenu");
        ?>
        <?php foreach ($shortcuts as $m):?>
            <?php if (!$m['link']['hidden']):?>
                <?php $active = ''; 
                if (isset($m['link']['link_path']) && ($m['link']['link_path'] == $_GET ['q'])) {
                    $active = "current"; 
                }
                ?>
                <?php 
                    print l($m['link']['title'], 
                    $m['link']['link_path'], 
                    array("attributes"=>array("class"=>array("aside-menu__shortcut", $active))));
                ?>
            <?php endif;?>
        <?php endforeach;?>  

    </div>
</nav>
