<div class="page__lead">Сегодня экономический факультет — это современное учебное заведение по праву гордящееся своими ежегодно выходящими учебниками, защитами диссертаций по широкому спектру экономических наук, своими международными конференциями, монографиями, научным журналом – известным и уважаемым далеко за пределами университета.</div>
<h2>Основа обучения</h2>
<div class="common-module common-tabs">
	<?php foreach ($bases as $k=>$v):?>
	<a href="javascript:void(0)" data-type="base" data-id="<?php print $k;?>" class="common-tabs__tab adm-controls"><?php print $v;?></a>
    <?php endforeach;?>
</div>
<h2>Форма обучения</h2>
<div class="common-module common-tabs">
	<?php foreach ($forms as $k=>$v):?>
	<a href="javascript:void(0)" data-type="form" data-id="<?php print $k;?>" class="common-tabs__tab adm-controls"><?php print $v;?></a>
    <?php endforeach;?>
</div>
<h2>Программы обучения</h2>
<?php 
 $total = 2.0;
 $rows= ceil(count($types)/$total);
?>
<?php for ($j=0; $j<$rows; $j++):?>
<div class="common-tabs">
	<?php for ($k=$total*$j; $k<$total*$j + $total ; $k++) :?>
		<?php if (isset($types[$k])):?>
    	<a href="javascript:void(0)" data-type="type" data-id="<?php print $types[$k]->tid;?>" class="common-tabs__tab adm-controls"><?php print $types[$k]->name;?></a>
   	 <?php endif;?>
	<?php endfor;?>
</div>
<?php endfor;?>
<a href="javascript:void(0)" class="big-btn common-module adm-reset">Сбросить фильтр</a>
<div class="adm-results">
</div>