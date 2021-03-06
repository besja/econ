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

  if (!empty($breadcrumb)) {

    $breadcrumb[] = drupal_get_title();

    $output = '<div class="breadcrumbs">' . implode('', $breadcrumb) . '</div>';
    return $output;
  }
}

function _econ_page_class() {
  //drupal_set_message(print_r(arg(), 1)); 
  $args = arg(); 
  if (count($args) == 1 && arg(0) == 'node') {
    //главная 
    return "main-content";
  }
  if (arg(0) == 'node' && is_numeric(arg(1))) {
      $node = node_load(arg(1));
      switch ($node->type) {

        case "news":
          return "page concrete-".$node->type; 
        break;

        case "event":
          return "page concrete-".$node->type; 
        break;

        case "graduate":
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
    if ($node->type == 'person' or $node->type == 'graduate' or $node->type=='contact_item' or $node->type == 'contacts') {
      $vars['show_title'] = false;
    }
  }
  if (arg(0)=='fakultet' && arg(1)=='contacts' && arg(2)=='phones') {
     $vars['show_title'] = false;
  }
  if (arg(0) == 'searchsite') {
    $vars['show_title'] = false;
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

// возвращает список подразделений с которым связана персоналия
function _econ_pages_load_structures($node) {

  if (isset($node->field_struct_ref) && isset($node->field_struct_ref['und'][0]['node'])) {

    $links= array(); 
    $paths = _econ_pages_get_people_path(); 
    foreach ($node->field_struct_ref['und'] as $k) {
      $structure = $k['node']; 
      $path = "people";
      $type = $structure->field_structure_type['und'][0]['value']; 

      if (isset($paths[$type])) {
        $path = "people/".$paths[$type]; 
      }
      $links[] = l($structure->title, $path, array("attributes"=>array("class"=>array("common-tabs__tab")), "query"=>array("structure"=>$structure ->nid))); 
    }  
    return implode("", $links);
  }
  
}

// возвращает список людей с которым связано подразделени
function _econ_pages_load_people($nid) {
  global $language;
  $links= array(); 
  $query = "SELECT n.nid, n.title, pr.field_structure_people_role_value as role  
  FROM field_data_field_structure_people sp
  INNER JOIN field_data_field_structure_people_person pp ON pp.entity_id = sp.field_structure_people_value
  LEFT JOIN field_data_field_structure_people_role pr ON pr.entity_id = sp.field_structure_people_value 
  INNER JOIN node n ON n.nid = pp.field_structure_people_person_nid AND n.type = 'person' 
  AND n.language IN ('und', '".$language->language."') AND n.status = 1 
  AND sp.entity_id = ".$nid." 
  ORDER BY sp.delta "; 

  $result = db_query($query);

  $nodes = array(); 
  while($row = $result->fetchObject()) {
   $nodes[] = $row; 
  }  
  return $nodes; 
}

//возвращает список программ, реализуемых кафедрой 
function _econ_pages_load_programms($nid) {
  global $language;
  $links= array(); 
  $query = "SELECT n.nid, n.title 
  FROM field_data_field_struct_ref r 
  INNER JOIN node n ON n.nid = r.entity_id AND r.bundle='programm' AND n.type = 'programm' 
  AND n.language IN ('und', '".$language->language."') AND n.status = 1 
  AND r.field_struct_ref_nid = ".$nid." 
  INNER JOIN field_data_field_programm_type pt ON pt.entity_id = n.nid 
  INNER JOIN taxonomy_term_data td ON pt.field_programm_type_tid = td.tid 
  ORDER BY td.weight, n.title"; 
  $result = db_query($query);

  $nodes = array(); 
  while($row = $result->fetchObject()) {
   $nodes[] = $row; 
  }  
  return $nodes; 
}



function _econ_get_rating($nid) {

  $parameters = drupal_get_query_parameters();

  if (isset($parameters['type']) && in_array($parameters['type'], array('hirsh', 'cite'))){
    $type = $parameters['type']; 
  } else {
    $type = 'hirsh'; 
  }

  if ($type == 'cite') {
    $subquery = " ORDER BY c.field_rating_cite_value DESC "; 
  } else {
    $subquery = " ORDER BY i.field_rating_index_value DESC ";    
  }

  $query = "SELECT n.title, n.nid, n2.field_rating_pub_number_value as pub_number, 
  c.field_rating_cite_value as cite_index, 
  i.field_rating_index_value as hirsh, 
  id.field_rating_id_value as lib_id, 
  p.field_rating_people_value as pid   
  FROM field_data_field_rating_people p 
  INNER JOIN field_data_field_rating_person p2 ON p.field_rating_people_value = p2.entity_id 
  INNER JOIN node n ON n.nid = p2.field_rating_person_nid AND n.type = 'person' AND n.status = 1 
  INNER JOIN field_data_field_rating_pub_number n2 ON p.field_rating_people_value = n2.entity_id 
  INNER JOIN  field_data_field_rating_cite c ON p.field_rating_people_value = c.entity_id 
  INNER JOIN  field_data_field_rating_index i ON p.field_rating_people_value = i.entity_id 
  INNER JOIN field_data_field_rating_id id ON p.field_rating_people_value = id.entity_id AND p.entity_id = ".$nid." 
  ".$subquery." LIMIT 0, 50"; 

  $result = db_query($query); 

  $nodes = array(); 
  while($row = $result->fetchObject()) {
   $nodes[] = $row; 
  }  
  return $nodes; 

}

function _econ_pages_load_structure_people($items) {
  global $language;
  $uids = array(); 
  foreach ($items as $item) {
    $uids[] = $item['value']; 
  }
  if (count($uids)) {

    $links= array(); 
    $query = "SELECT n.nid, n.title, pr.field_structure_people_role_value as role  
    FROM field_data_field_structure_people sp
    INNER JOIN field_data_field_structure_people_person pp ON pp.entity_id = sp.field_structure_people_value
    LEFT JOIN field_data_field_structure_people_role pr ON pr.entity_id = sp.field_structure_people_value 
    INNER JOIN node n ON n.nid = pp.field_structure_people_person_nid AND n.type = 'person' 
    AND n.language IN ('und', '".$language->language."') AND n.status = 1 
    AND sp.field_structure_people_value IN (".implode(' ,' , $uids).") ORDER BY sp.delta "; 

    $result = db_query($query);

    $nodes = array(); 
    while($row = $result->fetchObject()) {
     $nodes[] = $row; 
    }  
    return $nodes; 
  }
}
