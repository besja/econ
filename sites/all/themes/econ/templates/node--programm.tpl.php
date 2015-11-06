<?php $all_fields_on_my_website = field_info_fields();?>
<?php if ($teaser) :?>
<div class="col-xs-12 col-sm-6 admission-card">
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
<?php else:?>

<?php if (isset($node->field_leadtext['und'][0]['value'])):?>
<div class="page__lead">
<?php print $node->field_leadtext['und'][0]['value'];?>
</div>
<?php endif;?>
<div class="contact">
    <table class="common-module common-table contacts__table">
        <tr class="common-table__row">
            <?php if (isset($node->field_programm_type['und'][0]['taxonomy_term']->name)):?>
            <td class="common-table__cell">
                <span class="common-table__cell--header">Тип программы</span>

                <?php print $node->field_programm_type['und'][0]['taxonomy_term']->name;?>
            </td>
             <?php endif;?>
            <?php if (isset($node->field_programm_base['und'])):?>
            <td class="common-table__cell">
                <span class="common-table__cell--header">Основа обучения</span>
                <?php 

                    $bases= list_allowed_values($all_fields_on_my_website["field_programm_base"]); 
                    $vals = array();
                ?>
                <?php foreach ($node->field_programm_base['und'] as $k=>$v) {
                    $vals[] = $bases[$v['value']];
                };?>
                <?php print implode("<br/>", $vals);?>
            </td>
            <?php endif;?>
            <?php if (isset($node->field_programm_form['und'])):?>
            <td class="common-table__cell">
                <span class="common-table__cell--header">Форма обучения</span>
                <?php 

                    $forms= list_allowed_values($all_fields_on_my_website["field_programm_form"]); 
                    $vals = array();
                ?>
                <?php foreach ($node->field_programm_form['und'] as $k=>$v) {
                    $vals[] = $forms[$v['value']];
                };?>
                <?php print implode("<br/>", $vals);?>
            </td>
            <?php endif;?>
            <?php if (isset($node->field_struct_ref) && isset ($node->field_struct_ref['und'][0]['nid'])):?>
            <?php $structure = node_load($node->field_struct_ref['und'][0]['nid']);?>
            <td class="common-table__cell common-table__cell--accent">
                <span class="common-table__cell--header">Реализует программу</span>
                <?php print l($structure->title, "node/".$structure->nid);?>
            </td>
            <?php endif;?>
        </tr>
    </table>   
</div>

<?php if (isset($node->field_web['und'])):?>
    <a href="<?php print url('node/'.$node->nid.'/iframe');?>" class="common-module big-btn">УСЛОВИЯ ПОСТУПЛЕНИЯ НА САЙТЕ СПБГУ</a>
<?php endif;?>

<?php print render($content['body']);?>

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