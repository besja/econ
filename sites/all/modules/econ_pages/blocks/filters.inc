<?php
//потому что стандартный format_date выводить в род. падеже, а тут надо в им. пад. 
function _econ_pages_month_names_normal() {
$monthAr = array(

    '01' => array('Январь'),

    '02' => array('Февраль'),

    '03' => array('Март'),

    '04' => array('Апрель'),

    '05' => array('Май'),

    '06' => array('Июнь'),

    '07' => array('Июль'),

    '08' => array('Август'),

    '09' => array('Сентябрь'),

    '10'=> array('Октябрь'),

    '11'=> array('Ноябрь'),

    '12'=> array('Декабрь')

  );
  return $monthAr ;
}
function _econ_pages_news_filter_get_data($year, $term_subquery) {
  global $language; 
  $data = array();

  $result = db_query("SELECT FROM_UNIXTIME(n.created, '%m') as news_month, 
    FROM_UNIXTIME(n.created, '%Y') as news_year, 
    count(n.nid) as total, n.created 
    FROM node n 
    ".$term_subquery."  
    where n.type='news' and n.status = 1 and FROM_UNIXTIME(n.created, '%Y') = ".$year."  and n.language IN ('".$language->language."', 'und') 
    GROUP BY news_month
    ORDER BY news_month ASC");

   while($row=$result->fetchObject()) {  
    // месяц, год, количество 
    $month_names = _econ_pages_month_names_normal() ;
    $row->month_name = $month_names[$row->news_month][0];
    $data[] = $row; 
  }

  return $data; 

}
function _econ_pages_news_filter_get_years($current_year, $term_subquery) {
  global $language; 

  $years = array(); 
 
  $result = db_query("SELECT FROM_UNIXTIME(n.created, '%Y') as news_year 
    FROM node n ".$term_subquery."   
    where n.type='news' and n.status = 1 and n.language IN ('".$language->language."', 'und')  
    GROUP BY news_year ORDER BY news_year DESC");

  while($row=$result->fetchObject()) {  
    $years[] = $row->news_year; 
  }

  return $years;
}
function _econ_pages_news_filter_get_months($year, $term_subquery) {
  $months = array();
  $data = _econ_pages_news_filter_get_data($year, $term_subquery);
  foreach ($data as $row) {
    $months[] = $row->news_month;
  }
  return $months;
}
function _econ_pages_news_filter() {

  // теги + календарь

 
  $parameters = drupal_get_query_parameters();

  // формируем календарь
  // по умолчанию текущий год, месяц не задан

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

  $term_subquery = "";
  if ($current_term) {
    $term_subquery = " INNER JOIN field_data_field_news_category c ON c.entity_id = n.nid and c.field_news_category_tid = ".$current_term;
  }

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

  $data = _econ_pages_news_filter_get_data($current_year, $term_subquery); 

  //формируем теги

  $terms = taxonomy_get_tree(2); 
 
  return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/news_filter.tpl.php", 
    array("years"=>$years, "data"=>$data ,"current_month"=>$current_month, "current_year" =>$current_year, "terms"=>$terms, "current_term"=>$current_term));

}

function _econ_pages_events_filter() {

  global $language; 

  $parameters = drupal_get_query_parameters();

  // формируем календарь
  // по умолчанию текущий год, месяц не задан

  if (isset($parameters['year']) && is_numeric($parameters['year'])){
    $current_year = $parameters['year']; 
  } else {
    $current_year = date('Y', time());
  }

  $current_month = ''; 
  if (isset($parameters['month']) && is_numeric($parameters['month'])){
    $current_month = $parameters['month']; 
  } 

  $years = array(); 
 
  $result = db_query("SELECT YEAR(d.field_event_date_value) as event_year 
    FROM node n  
    INNER JOIN field_data_field_event_date d ON d.entity_id = n.nid  and n.language IN ('".$language->language."', 'und')  
    where n.type='event' and n.status = 1 
    GROUP BY event_year ORDER BY d.field_event_date_value DESC");

  while($row=$result->fetchObject()) {  
    $years[] = $row->event_year; 
  }

  $data = array(); 
 
  $result = db_query("
    SELECT 
    YEAR(d.field_event_date_value) as event_year, 
    DATE_FORMAT (d.field_event_date_value, '%m') as event_month, 
    count(n.nid) as total 
    FROM node n  
    INNER JOIN field_data_field_event_date d ON d.entity_id = n.nid and n.language IN ('".$language->language."', 'und') 
    where n.type='event' and n.status = 1 and YEAR(d.field_event_date_value) = ".$current_year." 
    GROUP BY event_month ORDER BY d.field_event_date_value DESC");

  while($row=$result->fetchObject()) {  
    $month_names = _econ_pages_month_names_normal() ;
    $row->month_name = $month_names[$row->event_month][0];
    $data[] = $row; 
  }


  return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/events_filter.tpl.php", 
    array("years"=>$years, "data"=>$data ,"current_month"=>$current_month, "current_year" =>$current_year));
}