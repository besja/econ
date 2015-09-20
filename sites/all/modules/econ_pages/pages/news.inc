<?php 

/* 
Логика: 
по умолчанию показываем новости текущего года
фильтр тег - год - месяц 
теги показываются только "не пустые" - доделать 
при выборе тега показывается ближайший не пустой год
если в выбранном годе нет новостей, то показывается ближайший в котором есть новости (с учетом категории) 
если в выбранном месяце нет новостей, то фильтр по месяцу сбрасывается и показывается список года 
*/
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

  $term_subquery = "";
  if ($current_term) {
    $term_subquery = " INNER JOIN field_data_field_news_category c ON c.entity_id = n.nid and c.field_news_category_tid = ".$current_term;
  }


  module_load_include('inc', 'econ_pages', 'blocks/filters');

  $years = _econ_pages_news_filter_get_years($current_year, $term_subquery); 
  
  if (!in_array($current_year, $years)) {
    //если в текущем годе нет новостей
    if (count($years)) {
      $current_year = $years[0];
      
    } 
  }

  $months = _econ_pages_news_filter_get_months($current_year, $term_subquery);
  if (!in_array($current_month, $months)) {
    $current_month = "";
  }

  $year_subquery = ""; 
  if ($current_year) {
    $year_subquery = " and FROM_UNIXTIME(n.created, '%Y') = ".$current_year; 
  }

  $month_subquery = "";
  if ($current_month) {
    $month_subquery = " and FROM_UNIXTIME(n.created, '%m') = ".$current_month; 
  }


  $query = "SELECT * FROM node n ". $term_subquery. " 
  WHERE n.type='news' and n.status = 1 and n.sticky = 1 ".$month_subquery.$year_subquery."
  ORDER BY n.created DESC LIMIT 0,1"; 

  $result = db_query($query);
  $featured = $result->fetchObject();

  $exclude = "";
  if ($featured) {
    $exclude = " and n.nid <> ".$featured->nid;
  }

  $limit = 1;
  if (isset($_REQUEST['page'])) {
    $start = $_REQUEST['page'] * $limit;
  } else {
    $start = 0;
  }

  $query = "SELECT * FROM node n ". $term_subquery. "  
  WHERE n.type='news' and n.status = 1 ".$exclude.$month_subquery.$year_subquery. " ORDER BY n.created DESC"; 

  $query_count = "SELECT count(*) as total FROM node n ". $term_subquery. "  
  WHERE n.type='news' and n.status = 1 ".$exclude.$month_subquery.$year_subquery. " ORDER BY n.created DESC"; 

  $count_result = db_query($query_count);
  $query_items = db_query_range($query,$start,$limit);

  $nodes = array();
  $pager='';
  while($row=$query_items->fetchObject()) {  
    $nodes[] = $row->nid;
  }
  if (count($nodes)) {
    pager_default_initialize($count_result->fetchObject()->total, $limit, $element = 0);
    $pager = theme('pager',array("quantity"=>5));
  }


  return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/news.tpl.php", 
    array("featured"=>$featured, "nodes"=>$nodes ,"pager"=>$pager));

}