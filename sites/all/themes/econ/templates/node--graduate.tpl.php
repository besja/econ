
<?php if ($teaser) :?>
    <a href="<?php print url('node/'.$node->nid);?>" class="common-module staff-card row">
        <?php if (isset($node->field_image['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'portret240', 
                'path' => $node->field_image['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"col-xs-4", "col-sm-6", "staff-card__image")));
            ?> 
        <?php endif;?>

        <div class="col-xs-6 staff-card__text">
            <div class="staff-card__name"><?php print $node->title;?></div>
            <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
            <div class="staff-card__job"><?php print $node->field_leadtext['und'][0]['value'];?></div>
            <?php endif;?>
        </div>
    </a>
<?php else:?>

<div class="common-module row">
    <div class="col-xs-6  col-sm-3 col-md-3">
	  <?php if (isset($node->field_image['und'][0]['uri'])):?>
	        <?php 
	        print theme('image_style', array('style_name' => 'portret240', 
	        	'path' => $node->field_image['und'][0]['uri'], 'alt'=>$node->title));
	        ?> 
	  <?php endif;?>
    </div>
    <div class="col-xs-12 col-sm-9 col-md-8">
        <h1 class="page__title"><?php print $node->title;?></h1>
        <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
        <div class="page__lead">
        	<?php print $node->field_leadtext['und'][0]['value'];?>
        </div>
   		<?php endif;?>
    </div>
</div>

<?php print render($content['body']);?>

<?php print l("Все выпускники", "people/graduated", array("attributes"=>array("class"=>array("common-module", "big-btn"))));?>
<?php endif;?>