<?php if (($featured) && !(isset($_REQUEST['page']))):?>
<?php $node = node_load($featured->nid);?>
<a href="<?php print url('node/'.$node->nid);?>" class="spotlight spotlight--event">
  <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
    <div class="page__main-image spotlight__image">
    	<?php 
    	print theme('image_style', array('style_name' => 'leadimage', 'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title));
    	?> 
    </div>
  <?php endif;?>

    <h2 class="page__title spotlight__title">
    	<?php print $node->title;?>
   	</h2>
    <div class="page__lead spotlight__lead">
    	<?php print $node->field_leadtext['und'][0]['value']; ?>
    </div>
    <div class="spotlight__meta">
        <span class="spotlight__date"><?php print format_date($node->created, $type="custom", $format = "d F Y");?></span>
        <span class="spotlight__category"><?php print _econ_news_categories($node);?></span>
    </div>
</a>
<?php endif;?>
<div id="news-widget" class="news-widget">
	<div id="news-widget__inner" class="news-widget__inner cf">
		<?php foreach($nodes as $nid):?>
			<?php 
			$node = node_load($nid);
			$render = node_view($node, "teaser");
			print render($render);
			?>
		<?php endforeach;?>
	</div>
	<?php print $pager;?>
</div>
