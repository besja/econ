<?php 
function econ_pages_news_page() {
  drupal_set_title("Новости"); 

  // парамтеры для фильтров 
  $parameters = drupal_get_query_parameters();

  if (isset($parameters['year']) && is_numeric($parameters['year'])){
    $current_year = $parameters['year']; 
  } else {
    $current_year = date('Y', time());
  }

  $current_month = ''; 
  if (isset($parameters['month']) && is_numeric($parameters['month'])){
    $current_month = $parameters['month']; 
  } 

  $current_term = "";
  if (isset($parameters['term']) && is_numeric($parameters['term'])){
    $current_term = $parameters['term']; 
  }


  //featured news

  $query = "SELECT * FROM node n WHERE n.type='news' and n.status = 1 and n.sticky = 1 ORDER BY n.created DESC LIMIT 0,1"; 
  $result = db_query($query);
  $featured = $result->fetchObject();

  $limit = 1;
  if (isset($_REQUEST['page'])) {
    $start = $_REQUEST['page'] * $limit;
  } else {
    $start = 0;
  }
  if ($featured) {
    $exclude = " and n.nid <> ".$featured->nid;
  }
  $query = "SELECT * FROM node n WHERE n.type='news' and n.status = 1 ".$exclude." ORDER BY n.created DESC"; 
  $query_count = "SELECT count(*) as total FROM node n WHERE n.type='news' and n.status = 1 ".$exclude." ORDER BY n.created"; 
  $count_result = db_query($query_count);
  $query_items = db_query_range($query,$start,$limit);


  while($row=$query_items->fetchObject()) {  
    $nodes[] = $row->nid;
  }
  
  pager_default_initialize($count_result->fetchObject()->total, $limit, $element = 0);
  $pager = theme('pager',array("quantity"=>5));


  return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/news.tpl.php", 
    array("featured"=>$featured, "nodes"=>$nodes ,"pager"=>$pager));

}