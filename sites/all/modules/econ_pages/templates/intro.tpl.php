<div id="intro" class="intro">
    <!-- Слайдер в основном блоке -->
    <div id="intro__slider" class="intro__banner intro__slider owl-carousel">
        <?php foreach ($slider as $node):?>
        <a href="<?php print $node->field_link['und'][0]['value'];?>" class="intro__slide intro__banner--<?php print $node->field_banner_color['und'][0]['value'];?>">
            <h3 class="intro__header"><?php print $node->title;?></h3>
            <p class="intro__text">
               <?php print $node->field_leadtext['und'][0]['value'];?>
            </p>
            <?php if (isset($node->field_image['und'][0]['uri'])):?>
                <?php 
                print theme('image_style', array('style_name' => 'slider819', 
                    'path' => $node->field_image['und'][0]['uri'], 
                    'alt'=>$node->title, array("attributes"=>array("class"=>array("intro__image")))));
                ?>        
            <?php endif;?>
        </a> 
        <?php endforeach;?>
    </div>
    <!-- END Слайдер в основном блоке  -->
    <?php foreach ($banner as $node):?>
    <div class="intro__banner intro__grants intro__banner--<?php print $node->field_banner_color['und'][0]['value'];?>">
        <?php if (isset($node->field_image['und'][0]['uri'])):?>
        <a href="<?php print $node->field_link['und'][0]['value'];?>">
            <?php 
            print theme('image_style', array('style_name' => 'slider819', 
                'path' => $node->field_image['und'][0]['uri'], 
                'alt'=>$node->title, array("attributes"=>array("class"=>array("intro__image")))));
            ?>        
        </a>
        <?php endif;?>
        <h3 class="intro__header"><?php print l($node->title,$node->field_link['und'][0]['value']);?></h3>
        <p class="intro__text">
           <?php print l($node->field_leadtext['und'][0]['value'], $node->field_link['und'][0]['value']);?>
        </p>
        <?php if (isset($node->body['und'][0]['value'])):?>
            <?php print $node->body['und'][0]['value'];?>
        <?php endif;?>
    </div>
    <?php endforeach;?>
</div>
