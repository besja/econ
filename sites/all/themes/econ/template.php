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


