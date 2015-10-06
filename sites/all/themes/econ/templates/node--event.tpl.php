
<?php if ($teaser) :?>
<a href="<?php print url('node/'.$node->nid);?>" class="events-widget__event">
  <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
  <div class="news-widget__image" style="background-image: url(<?php print image_style_url('leadimage_preview', $node->field_leadimage['und'][0]['uri']); ?>)"></div> 
  <?php endif;?>
  <div class="events-widget__date"> <?php print _econ_event_date($node);?></div>
  <div class="events-widget__text"><?php print $node->title;?></div>
</a>
<?php else:?>
<?php //drupal_set_message("<pre>".print_R($node,1)."</pre>"); ?>
<div class="page__lead">

  <?php print $node->field_leadtext['und'][0]['value']; ?>

  <div class="concrete-news__meta">
      <span class="concrete-news__date">
        <?php print _econ_event_date($node);?>
      </span> 
  </div>
</div>

<?php print render($content['body']);?>
<?php print l("Все события", "news-events/events", array("attributes" =>array("class"=>array("big-btn"))));?>
<?php endif;?>


