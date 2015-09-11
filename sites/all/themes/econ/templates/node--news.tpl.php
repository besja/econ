
<?php if ($teaser) :?>
 <a href="<?php print url('node/'.$node->nid);?>" class="news-widget__item">
  <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>

  <div class="news-widget__image" style="background-image: url(<?php print image_style_url('leadimage', $node->field_leadimage['und'][0]['uri']); ?>)"></div> 
  <?php endif;?>
  <div class="news-widget__title">
    <?php print $node->title;?>
  </div>
  <div class="news-widget__meta cf">
      <div class="news-widget__date"><?php print format_date($node->created, $type="custom", $format = "d F Y");?></div>
      <div class="news-widget__category"><?php print _econ_news_categories($node);?></div>
  </div>
</a>
<?php else:?>
<?php //drupal_set_message("<pre>".print_R($node,1)."</pre>"); ?>
<div class="page__lead">
  <?php print $node->field_leadtext['und'][0]['value']; ?>

  <div class="concrete-news__meta">
      <span class="concrete-news__date">
        <?php print format_date($node->created, $type="custom", $format = "d F Y");?>
      </span> | 
      <span class="concrete-news__category">
        <?php print _econ_news_categories($node);?>
      </span>
  </div>
</div>

<?php print render($content['body']);?>
<?php print l("Все новости", "news-events/news", array("attributes" =>array("class"=>array("big-btn"))));?>
<?php endif;?>


