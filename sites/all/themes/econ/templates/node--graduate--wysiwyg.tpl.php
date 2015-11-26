<div class="row">
    <a href="<?php print url('node/'.$node->nid);?>" class="common-module staff-card col-xs-12 col-sm-12 col-md-6">
        <?php if (isset($node->field_image['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'portret240_grey', 
                'path' => $node->field_image['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"col-xs-4 col-sm-6 staff-card__image")));
            ?> 
        <?php endif;?>

        <span class="staff-card__text">
            <span class="staff-card__name"><?php print $node->title;?></span>
            <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
            <span class="staff-card__job"><?php print $node->field_leadtext['und'][0]['value'];?></span>
            <?php endif;?>
            <?php if (isset($node->field_email['und'][0]['email'])):?>
            <span class="staff-card__email"><?php print $node->field_email['und'][0]['email'];?></span>
            <?php endif;?>
        </span>
    </a>
</div>