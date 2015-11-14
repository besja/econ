<?php $people = _econ_pages_load_people($nid) ;?>
<?php if (count($people)):?>
    <?php 
     $total = 2.0;
     $rows= ceil(count($people)/$total);
    ?>
    <?php for ($j=0; $j<$rows; $j++):?>
    <div class="row">
        <?php for ($k=$total*$j; $k<$total*$j + $total ; $k++) :?>
            <?php if (isset($people[$k])):?>
            <div class="col-xs-12 col-sm-6">
                <?php 
                $person = node_load($people[$k]->nid);
                ?>
                <a href="<?php print url('node/'.$person->nid);?>" class="common-module staff-card row">
                <?php if (isset($person->field_image['und'][0]['uri'])):?>
                <?php 
                print theme('image_style', array('style_name' => 'portret240_grey', 
                'path' => $person->field_image['und'][0]['uri'], 'alt'=>$person->title, "attributes"=>array("class"=>"col-xs-4 col-sm-6 staff-card__image")));
                ?> 
                <?php endif;?>

                <div class="col-xs-6 staff-card__text">
                  <div class="staff-card__name"><?php print $person->title;?></div>
                  <?php if (isset($person->field_leadtext['und'][0]['value'])):?>
                  <div class="staff-card__job"><?php print $person->field_leadtext['und'][0]['value'];?></div>
                  <?php endif;?>
                  <?php if (isset($people[$k]->role)):?>
                  <div class="staff-card__job"><?php print $people[$k]->role;?></div>
                  <?php endif;?>
                  <?php if (isset($person->field_email['und'][0]['email'])):?>
                  <div class="staff-card__email"><?php print $person->field_email['und'][0]['email'];?></div>
                  <?php endif;?>
                </div>
                </a>
            </div>
         <?php endif;?>
        <?php endfor;?>
     </div>
    <?php endfor;?>
<?php endif;?>