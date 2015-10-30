<!-- Модуль с описанием человека -->
<div class="common-module person-card">
    <div class="row">
        <div class="col-xs-6 col-sm-4 person-card__image">

        <?php if (isset($node->field_image['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'portret175', 
                'path' => $node->field_image['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array()));
            ?> 
        <?php endif;?>

        </div>
        <div class="col-xs-12 col-sm-8">
            <h3 class="person-card__name"><?php print $node->title;?></h3>
            <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
            <div class="person-card__lead"><?php  print $node->field_leadtext['und'][0]['value'];?></div>
            <?php endif;?>
            <div class="staff-card__email"><?php print $node->field_email['und'][0]['email'];?></div>
            <div class="person-card__more"><?php print l('Подробнее', 'node/'.$node->nid);?></div>
        </div>
    </div>
</div>