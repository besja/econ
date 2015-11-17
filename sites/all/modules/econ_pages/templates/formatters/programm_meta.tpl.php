<?php $all_fields_on_my_website = field_info_fields();?>
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