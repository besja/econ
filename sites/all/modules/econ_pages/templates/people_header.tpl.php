<div class="page__lead">Численность преподавателей составляет 400 человек, каждый из которых — компетентный специалист в определённой области экономики. Высокое качество образования на экономическом факультете подтверждают достижения его выпускников. Многие них на данный момент достигли значительных карьерных высот, занимая высокие руководящие должности, являясь аналитиками в крупных компаниях, успешными предпринимателями.
</div>
<div id="persons-filter" class="persons-filter">
    <?php $i = 1;?>
    <?php foreach ($struct_data as $row):?>
    <div class="panel persons-filter__panel">
        <h4 class="persons-filter__header">
            <a data-toggle="collapse" data-parent="#persons-filter" <?php if ($row['header']['active']):?>aria-expanded="true"<?php endif;?> href="#person-filter-collapse-<?php print $i;?>"><?php print $row['header']['link_title'];?></a>
        </h4>
        <ul id="person-filter-collapse-<?php print $i;?>" class="collapse <?php if ($row['header']['active']):?>in<?php endif;?>">
            <?php foreach($row['items'] as $row2):?>
            <li class="persons-filter__item"><a href="<?php print $row2['link_url'];?>" class="persons-filter__link <?php if ($row2['active']):?>persons-filter__link--current<?php endif;?> "><?php print $row2['link_title'];?></a></li>
            <?php endforeach;?>
        </ul>
    </div>
    <?php $i++;?>
    <?php endforeach;?>

    <div class="panel persons-filter__panel">
        <h4 class="persons-filter__header">

            <a href="<?php print url('people/graduated');?>" <?php if ($current_type == 'graduated'):?> aria-expanded="true" <?php endif?>>Выпускники</a>
        </h4>
    </div>
    <div class="panel persons-filter__panel">
        <h4 class="persons-filter__header">
            <a data-toggle="collapse" data-parent="#persons-filter"<?php if ($current_type == 'abc'):?> aria-expanded="true" <?php endif?> href="#person-filter-collapse-5">Алфавитный список</a>
        </h4>
        <div  id="person-filter-collapse-5" class="collapse abc-filter <?php if ($current_type == 'abc'):?> in <?php endif?>">
            <?php foreach($abc_data as $row):?>
                <?php print $row;?>
            <?php endforeach;?>
        </div>
    </div>

</div>