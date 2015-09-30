<?php if (count($nodes)):?>

<?php 
 $total = 2.0;
 $rows= ceil(count($nodes)/$total);
?>
<?php for ($j=0; $j<$rows; $j++):?>
<div class="row">
    <?php for ($k=$total*$j; $k<$total*$j + $total ; $k++) :?>
        <?php if (isset($nodes[$k])):?>
        <div class="col-xs-12 col-sm-6">
            <?php 
            $node = node_load($nodes[$k]->nid);
            $render = node_view($node, "teaser");
            print render($render);
            ?>
        </div>
     <?php endif;?>
    <?php endfor;?>
 </div>
<?php endfor;?>
 <?php else:?>
    <p class="empty">Ничего не найдено. Попробуйте изменить параметры поиска</p>
<?php endif;?>