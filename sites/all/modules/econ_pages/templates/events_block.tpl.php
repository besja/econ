<!-- events block for main page --> 
<?php if (count($nodes )):?>
<div id="events-widget" class="events-widget">
	<?php foreach($nodes as $nid):?>
	<?php $node = node_load($nid); ?>
		<a href="<?php print url('node/'.$node->nid);?>" class="events-widget__event">
		  <div class="events-widget__date"> <?php print _econ_event_date($node);?></div>
		  <div class="events-widget__text"><?php print $node->title;?></div>
		</a>
	<?php endforeach;?>
    <?php print l("Все события", "news-events/events", array("attributes"=>array("class"=>array("big-btn"))));?>
</div>
<?php endif;?>