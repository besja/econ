<div class="row">
    <?php if (count($nodes)):?>
        <?php foreach($nodes as $row):?>
            <div class="col-xs-12 col-sm-6">
                <?php 
                $node = node_load($row->nid);
                $render = node_view($node, "teaser");
                print render($render);
                ?>
            </div>
        <?php endforeach;?>
    <?php else:?>
        <p class="empty">Ничего не найдено. Попробуйте изменить параметры поиска</p>
    <?php endif;?>
 </div>