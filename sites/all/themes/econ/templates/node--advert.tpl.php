
<?php if ($teaser) :?>
 <a href="<?php print url('node/'.$node->nid);?>" class="news-widget__item">
  <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>

  <div class="news-widget__image" style="background-image: url(<?php print image_style_url('leadimage_preview', $node->field_leadimage['und'][0]['uri']); ?>)"></div> 
  <?php endif;?>
  <div class="news-widget__title">
    <?php print $node->title;?>
  </div>
  <div class="news-widget__meta cf">
      <div class="news-widget__date"><?php print format_date($node->created, $type="custom", $format = "d F Y");?></div>
  </div>
</a>
<?php else:?>
<?php //drupal_set_message("<pre>".print_R($node,1)."</pre>"); ?>
<div class="page__lead">
    <div class="advert__date"><?php print format_date($node->created, $type="custom", $format = "d F Y");?></div>
</div>

<?php print render($content['body']);?>

<?php endif;?>


