 <a href="<?php print url('node/'.$node->nid);?>" class="news-widget__item">
  <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>

  <span class="news-widget__image" style="background-image: url(<?php print image_style_url('leadimage_preview', $node->field_leadimage['und'][0]['uri']); ?>)"></span> 
  <?php endif;?>
  <span class="news-widget__title">
    <?php print $node->title;?>
  </span>
  <span class="news-widget__meta cf">
      <span class="news-widget__date"><?php print format_date($node->created, $type="custom", $format = "d F Y");?></span>
      <span class="news-widget__category"><?php print _econ_news_categories($node);?></span>
  </span>
</a>