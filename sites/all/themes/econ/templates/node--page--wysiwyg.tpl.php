<div class="row">
    <a href="<?php print url('node/'.$node->nid);?>" class="cafedra-big col-xs-12 col-sm-12 col-md-12">
         <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'thumb292', 
                'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"cafedra-big__image")));
            ?> 
        <?php endif;?>
        <span class="cafedra-big__text"><?php print $node->title;?></span>
    </a>
</div>