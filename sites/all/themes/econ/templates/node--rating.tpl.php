<?php if ($teaser) :?>
    <h2 class="page__title"><?php print $node->title;?></h2>
    <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
    <div class="page__lead">
    <?php print $node->field_leadtext['und'][0]['value'];?>
    </div>
    <?php endif;?>
<?php else:?>
    <?php 
    $parameters = drupal_get_query_parameters();

    if (isset($parameters['type']) && in_array($parameters['type'], array('hirsh', 'cite'))){
        $type = $parameters['type']; 
    } else {
        $type = 'hirsh'; 
    }
    ?>
    <?php if (isset($node->field_leadtext['und'][0]['value'])):?>
    <div class="page__lead">
    <?php print $node->field_leadtext['und'][0]['value'];?>
    </div>
    <?php endif;?>
    <?php print render($content['body']);?>

    <div class="common-module common-tabs">
        <a href="<?php print url('node/'.$node->nid, array('query'=>array('type'=>'hirsh')));?>" class="common-tabs__tab <?php if ($type == 'hirsh'):?> current <?php endif;?>">индекс хирша</a>
        <a href="<?php print url('node/'.$node->nid, array('query'=>array('type'=>'cite')));?>" class="common-tabs__tab <?php if ($type == 'cite'):?> current <?php endif;?>">по цитируемости</a>
    </div>
    <?php $rows = _econ_get_rating($node->nid);?> 
    <table class="common-module common-table common-table--centered hidden-xs">
        <tr class="common-table__row">
            <th class="common-table__cell"></th>
            <th class="common-table__cell common-table__cell--header">E-LIBRARY</th>
            <th class="common-table__cell common-table__cell--header">ЦИТИРУЕМОСТЬ</th>
            <th class="common-table__cell common-table__cell--header">ИНДЕКС ХИРША</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach($rows as $row):?>
        <tr class="common-table__row">
            <td class="common-table__cell common-table__cell--name"><?php print $i;?>.
            <?php print  l($row->title, "node/".$row->nid);?>
            <?php if (user_access('edit any rating content')):?> 
            <br/>
                <a class="inline-manage" href="<?php print url('field-collection/field-rating-people/'.$row->pid.'/edit', array('query'=>array('destination'=>'node/'.$node->nid.'?type='.$type)));?>">Редактировать</a>
            <?php endif;?>
            <?php if (user_access('delete any rating content')):?> 
                <a class="inline-manage" href="<?php print url('field-collection/field-rating-people/'.$row->pid.'/delete', array('query'=>array('destination'=>'node/'.$node->nid.'?type='.$type)));?>">Удалить</a>
            <?php endif;?>
            </td>
            <td class="common-table__cell common-table__cell--huge"><?php print $row->pub_number;?></td>
            <td class="common-table__cell common-table__cell--huge"><?php print $row->cite_index;?></td>
            <td class="common-table__cell common-table__cell--huge"><?php print $row->hirsh;?></td>
        </tr>
        <?php $i++;?>
        <?php endforeach;?>
    </table>
    <?php if (user_access('add rating content')):?> 
    <ul class="action-links action-links-field-collection-add">
        <li><a class="inline-manage" href="<?php print url('field-collection/field-rating-people/add/node/'.$node->nid, array('query'=>array('destination'=>'node/'.$node->nid.'?type='.$type)));?>">Добавить</a></li>
    </ul>
    <?php endif;?>
    <?php $i = 1; ?>
    <?php foreach($rows as $row):?>
    <table class="common-module common-table common-table--centered visible-xs">
       <tr class="common-table__row">
            <td  colspan="3" class="common-table__cell common-table__cell--name"><?php print $i;?>.
            <?php print  l($row->title, "node/".$row->nid);?></td>
        </tr>
       <tr class="common-table__row">
            <th class="common-table__cell common-table__cell--header">E-LIBRARY</th>
            <th class="common-table__cell common-table__cell--header">ЦИТИРУЕМОСТЬ</th>
            <th class="common-table__cell common-table__cell--header">ИНДЕКС ХИРША</th>
        </tr>
        <tr class="common-table__row">
            <td class="common-table__cell common-table__cell--huge"><?php print $row->pub_number;?></td>
            <td class="common-table__cell common-table__cell--huge"><?php print $row->cite_index;?></td>
            <td class="common-table__cell common-table__cell--huge"><?php print $row->hirsh;?></td>
        </tr>
    </table>
    <?php $i++;?>
    <?php endforeach;?>
    <?php if ($type == 'hirsh' && isset($node->field_body2['und'][0]['value'])):?>
        <?php print $node->field_body2['und'][0]['value'];?>
    <?php endif;?>
    <?php if ($type == 'cite' && isset($node->field_body2['und'][1]['value'])):?>
        <?php print $node->field_body2['und'][1]['value'];?>
    <?php endif;?>

<?php endif;?>