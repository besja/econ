
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
            <div class="staff-card__email"><?php print $node->field_email['und'][0]['email'];?></div>
        </div>
    </a>
<?php else:?>


<?php if (isset($node->field_leadtext['und'][0]['value'])):?>
<div class="page__lead">
<?php print $node->field_leadtext['und'][0]['value'];?>
</div>
<?php endif;?>

<h2>Контакты</h2>
<div class="contact">

    <table class="common-module common-table contacts__table">
        <tr class="common-table__row">
            <?php if (isset($node->field_address['und'][0]['value'])):?>
            <td class="common-table__cell">
                <span class="common-table__cell--header">АДРЕС КАФЕДРЫ</span>
                <?php print $node->field_address['und'][0]['value'];?></td>
            <?php endif;?>
            <?php if (isset($node->field_working_hours['und'][0]['value'])):?>
            <td class="common-table__cell">
                <span class="common-table__cell--header">ПРИЕМНЫЕ ЧАСЫ</span>
                <?php print $node->field_working_hours['und'][0]['value'];?>
            </td>
            <?php endif;?>

            <td class="common-table__cell common-table__cell--accent">
                <span class="common-table__cell--header">Телефон<?php if (isset($node->field_fax['und'][0]['value'])):?>, факс<?php endif;?></span>
                <a href="tel:<?php print $node->field_phone['und'][0]['value'];?>"><nobr><?php print $node->field_phone['und'][0]['value'];?></nobr></a>
                <?php if (isset($node->field_fax['und'])):?>
                , <a href="tel:<?php print $node->field_fax['und'][0]['value'];?>"><?php print $node->field_fax['und'][0]['value'];?></a>
                <?php endif;?>
            </td>
            <td class="common-table__cell common-table__cell--accent">
                <span class="common-table__cell--header">E-MAIL <?php if (isset($node->field_web['und'][0]['value'])):?>, WEB<?php endif;?></span>
                <a href="mailto:<?php print $node->field_email['und'][0]['email'];?>"><?php print $node->field_email['und'][0]['email'];?></a>
                <?php if (isset($node->field_web['und'][0]['value'])):?><br>
                <a href="<?php print $node->field_web['und'][0]['value'];?>"><?php print $node->field_web['und'][0]['value'];?></a>
             <?php endif;?>
            </td>
        </tr>
    </table>   
</div>
<?php $people = _econ_pages_load_people($node->nid) ;?>
<?php if (count($people)):?>
    <h2>Сотрудники</h2>
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
                print theme('image_style', array('style_name' => 'portret240', 
                'path' => $person->field_image['und'][0]['uri'], 'alt'=>$person->title, "attributes"=>array("class"=>"col-xs-4", "col-sm-6", "staff-card__image")));
                ?> 
                <?php endif;?>

                <div class="col-xs-6 staff-card__text">
                <div class="staff-card__name"><?php print $person->title;?></div>
                <?php if (isset($people[$k]->role)):?>
                <div class="staff-card__job"><?php print $people[$k]->role;?></div>
                <?php endif;?>
                <div class="staff-card__email"><?php print $person->field_email['und'][0]['email'];?></div>
                </div>
                </a>
            </div>
         <?php endif;?>
        <?php endfor;?>
     </div>
    <?php endfor;?>
    <?php print l("Все сотрудники", "people/kafedri", array("attributes"=>array("class"=>array("common-module", "big-btn")), "query"=>array("structure"=>$node->nid)));?>

<?php endif;?>
<?php print render($content['body']);?>

<?php $programms = _econ_pages_load_programms($node->nid);?>

<?php if (count($programms)):?>

    <h2>Программы обучения</h2>
    <?php 
     $total = 2.0;
     $rows= ceil(count($programms)/$total);
    ?>
    <?php for ($j=0; $j<$rows; $j++):?>
    <div class="row">
        <?php for ($k=$total*$j; $k<$total*$j + $total ; $k++) :?>
        <?php if (isset($programms[$k])):?>
            <?php 
            $programm = node_load($programms[$k]->nid);
            $render = node_view($programm, "teaser");
            print render($render);
            ?>
        <?php endif;?>
        <?php endfor;?>
    </div>
    <?php endfor;?>
<?php endif;?>

<?php if (count($node->field_files)):?>
    <h2>Файлы</h2>
	<div class="row">
		<?php foreach ($node->field_files['und'] as $file):?>
		<a href="<?php print file_create_url($file['uri']);?>" class="common-module download-module col-xs-12 col-sm-5">
            <i class="download-module__icon">
            	<?php  // global $theme_path; // не работает в этом шаблоне, хз почему ?>
            	<?php include(DRUPAL_ROOT."/sites/all/themes/econ/spbgu/app/img/icons/download.svg");?>
            </i>
		    <span class="download-module__text">
		    	<?php if (isset($file['description'])):?>
		    		<?php print $file['description'];?>
		    	<?php else:?>
		    		<?php print $file['filename'];?>
		    	<?php endif;?>
		    </span>
		</a>
		<?php endforeach;?>
	</div>
<?php endif;?>
<?php endif;?>