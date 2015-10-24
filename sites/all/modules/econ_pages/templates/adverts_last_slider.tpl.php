<?php if (count($nodes )):?>
<div id="notice-widget" class="notice-widget">
    <div id="notice-widget__slider" class='row notice-widget__slider'>
        <?php foreach ($nodes as $node):?>

        <a href="<?php print url('node/'.$node->nid);?>" class="notice-widget__notice cf col-xs-12 col-md-12">
            <?php 
                print theme('image_style', array('style_name' => 'leadimage_preview', 'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title), array("attributes"=>array("class"=>array("notice-widget__image"))));
            ?>
            <div class="notice-widget__text"><?php print $node->title;?></div>
        </a>
        <?php endforeach;?>

    </div>
    <?php print l("Все объявления", "news-events/adverts", array("attributes"=>array("class"=>array("big-btn"))));?>
</div>
<?php endif;?>