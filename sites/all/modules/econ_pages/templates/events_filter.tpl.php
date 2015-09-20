
<?php  global $theme_path;?>
<div id="events-filter" class="articles-filter articles-filter--events">
    <div class="articles-filter__header">Фильтр Событий</div> 
    <div class="year-selector panel">
        <div class="year-selector__current" data-toggle="collapse" 
        data-parent="#news-filter" aria-expanded="false" href="#news-filter-collapse-1">
        <?php print $current_year;?>             
            <i class="year-selector__icon">
                    <?php include(DRUPAL_ROOT."/".$theme_path.'/spbgu/app/img/icons/accordion-arrow.svg');?>
            </i>
        </div>
        <div id="news-filter-collapse-1" class="collapse">
            <ul>
                 <?php foreach ($years as $year):?>
                    <li class="year-selector__item <?php if ($current_year == $year):?> year-selector__item--current <?php endif;?>">
                        <a href="<?php print url('news-events/events',array('query'=>array('year'=>$year)));?>" class="year-selector__link"><?php print $year;?></a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <ul class="month-selector">
        <?php foreach ($data as $row):?>
            <li class="month-selector__item <?php if ($current_month && $current_month == $row->news_month):?> month-selector__item--current <?php endif;?>">
                <a href="<?php print url('news-events/events', 
                        array('query'=>array('year'=>$row->event_year, 'month'=>$row->event_month)));?>" class="month-selector__link">
                        <?php
                            print $row->month_name;
                        ?>
                        <span class="month-selector__count"><?php print $row->total;?></span>
                </a>
            </li> 
        <?php endforeach;?>
    </ul>

</div>