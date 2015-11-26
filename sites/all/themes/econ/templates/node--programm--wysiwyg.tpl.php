<div class="row">
<div class="col-xs-12 col-sm-12 admission-card">
    <a href="<?php print url("node/".$node->nid);?>" class="admission-card__link">
        <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'thumb291x203', 
                'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"admission-card__image")));
            ?> 
        <?php endif;?>
        <h2 class="admission-card__title"><?php if (isset($node->field_programm_type['und'][0]['taxonomy_term']->name)):?><?php print $node->field_programm_type['und'][0]['taxonomy_term']->name.'. ';?><?php endif;?><?php print $node->title;?></h2>
    </a>
    <?php print l("Подробнее", "node/".$node->nid, array("attributes"=>array("class"=>"big-btn")));?>
</div>
</div>