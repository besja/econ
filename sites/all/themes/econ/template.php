<?php

function econ_menu_link(array $variables) {

  $element = $variables ['element'];
  $sub_menu = '';

  if ($element ['#below']) {
    $sub_menu = drupal_render($element ['#below']);
  }
  //drupal_set_message("<pre>".print_r($variables['element']['#original_link']['menu_name'],1)."</pre>");
  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
  return '<li' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function _econ_get_menu_children($path) {
	$parent = menu_link_get_preferred($path);
   
	$parameters = array(
	    'conditions' => array('plid' => $parent['mlid']),
	  );

	$children = menu_build_tree($parent['menu_name'], $parameters);
	return array_values($children);
}


function econ_breadcrumb($variables) {
  $breadcrumb = $variables ['breadcrumb'];

  //pattern to find all title="anything-inside-double-quote"
  $pattern = "/href=/";

  foreach($breadcrumb as $k => $value){
        //replace with nothing so title won't print
       $breadcrumb[$k] = preg_replace($pattern, 'class="breadcrumbs__link" href=', $value);
  }

  if (!empty($breadcrumb)) {

    $output = '<div class="breadcrumbs">' . implode('', $breadcrumb) . '</div>';
    return $output;
  }
}

function _econ_page_class() {
  if (arg(0) == 'node' && is_numeric(arg(1))) {
      $node = node_load(arg(1));
      switch ($node->type) {

        case "news":
          return "page concrete-".$node->type; 
        break;

        case "event":
          return "page concrete-".$node->type; 
        break;

      } 
      return "page ".$node->type;
  } else {
    $arg = arg();

    $type = array_pop($arg);

    if ($type == "news-events") {
      return "page news-event";
    }
    return "page ".array_pop($arg); 
  }
  return "page";
}

function econ_preprocess_page(&$vars, $hook) {
  $vars['leadimage'] = "";
  $vars['show_title'] = true;
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $node = node_load(arg(1)); 
    if (isset($node->field_leadimage['und'][0])) {
      $vars['leadimage'] = theme('image_style', array('style_name' => 'leadimage', 'path' => $node->field_leadimage['und'][0]['uri'], 'alt'=>$node->title)); 
    }
    if ($node->type == 'person') {
      $vars['show_title'] = false;
    }
  }
}

function _econ_news_categories($node) {
  $tags = array();
  if (isset($node->field_news_category['und'])) {
    foreach($node->field_news_category['und'] as $k=>$v) {
      if (isset($v['taxonomy_term'])) {
        $tags[] = $v['taxonomy_term']->name; 
      } else {
        $term =taxonomy_term_load($v['tid']); 
        $tags[] = $term->name;
      }
    }
    return implode(", ", $tags);
  }
}

function _econ_event_date($node) {
  if (isset($node->field_event_date['und'][0]['value2']) && ($node->field_event_date['und'][0]['value2'] != $node->field_event_date['und'][0]['value'])) {
    $start = date_create_from_format("Y-m-d H:i:s", $node->field_event_date['und'][0]['value']);
    $end = date_create_from_format("Y-m-d H:i:s", $node->field_event_date['und'][0]['value2']); 
    if ($start->format('Y') != $end->format('Y'))  {
      // 25 сентября 2015 - 26 сентября 2016
      return format_date($start->getTimestamp(), $type="custom", $format = "d F Y") .' - '. format_date($end->getTimestamp(), $type="custom", $format = "d F Y");
    } elseif ($start->format('m') != $end->format('m')) {
      // 25 сентября - 25 октября 2015 
      return format_date($start->getTimestamp(), $type="custom", $format = "d F") .' - '. format_date($end->getTimestamp(), $type="custom", $format = "d F Y");
    } else {
      // 25-26 сентября 2015 
       return format_date($start->getTimestamp(), $type="custom", $format = "d") .' - '. format_date($end->getTimestamp(), $type="custom", $format = "d F Y");
    }
    
  } else {

    $start = date_create_from_format("Y-m-d H:i:s", $node->field_event_date['und'][0]['value']);
    return format_date($start->getTimestamp(), $type="custom", $format = "d F Y");
  }
}




