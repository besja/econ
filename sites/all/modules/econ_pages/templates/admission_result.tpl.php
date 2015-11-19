
<?php if (count($data)):?>
<?php foreach($data as $programms):?>
    <h2><?php print ($programms[0]->name);?></h2>
   <?php 
    $total = 2.0;
    $rows= ceil(count($programms)/$total);
    ?>
    <?php for ($j=0; $j<$rows; $j++):?>
        <div class="row">
            <?php for ($k=$total*$j; $k<$total*$j + $total ; $k++) :?>
                <?php if (isset($programms[$k])):?>
                    <?php $node = node_load($programms[$k]->nid); ?>
                    <div class="col-xs-12 col-sm-6 admission-card">
                        <a href="<?php print url('node/'.$node->nid);?>" class="admission-card__link">
                            <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
                                <?php 
                                print theme('image_style', array('style_name' => 'thumb291x203', 
                                    'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title, "attributes"=>array("class"=>"admission-card__image")));
                                ?> 
                            <?php endif;?>
                            <h3 class="admission-card__title"><?php print $node->title;?></h3>
                            <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
                                <p class="admission-card__text"><?php print $node->field_leadtext['und'][0]['value'];?></p>
                            <?php endif;?>
                        </a>
                        <a href="<?php print url('node/'.$node->nid);?>" class="big-btn">Подробнее</a>
                    </div>
                <?php endif;?>
            <?php endfor;?>
        </div>
    <?php endfor;?>
<?php endforeach;?>
<?php else:?>
    <p class="empty">К сожалению, по вашему запросу программ не нашлось. </p>
<?php endif;?>
