
<?php if ($teaser) :?>
    <a href="<?php print url('node/'.$node->nid);?>" class="cafedra">
        <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
            <?php 
            print theme('image_style', array('style_name' => 'thumb69x67', 
                'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"cafedra__image")));
            ?> 
        <?php endif;?>
        <div class="cafedra__text"><?php print $node->title;?></div>
    </a>

<?php else:?>

<?php print render($content['field_leadtext']);?>

<?php print render($content['body']);?>

<?php print render($content['field_structure_people']);?>

<?php print render($content['field_files']);?>

<?php endif;?>