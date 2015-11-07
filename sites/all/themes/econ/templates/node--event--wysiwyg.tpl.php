<a href="<?php print url('node/'.$node->nid);?>" class="events-widget__event">
  <?php if (isset($node->field_leadimage['und'][0]['uri'])):?>
  <span class="news-widget__image" style="background-image: url(<?php print image_style_url('leadimage_preview', $node->field_leadimage['und'][0]['uri']); ?>)"></span> 
  <?php endif;?>
  <span class="events-widget__date"> <?php print _econ_event_date($node);?></span>
  <span class="events-widget__text"><?php print $node->title;?></span>
</a>