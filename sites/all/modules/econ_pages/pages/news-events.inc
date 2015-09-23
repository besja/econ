<?php

function econ_pages_news_events_page() {

	drupal_set_title("Новости и события");
	//последние 10 новостей + featured, остальное выводим в блоках

  	$query = "SELECT * FROM node n  
  	WHERE n.type='news' and n.status = 1 and n.sticky = 1 
  	ORDER BY n.created DESC LIMIT 0,1"; 

  	$result = db_query($query);
  	$featured = $result->fetchObject();

  	$exclude = "";
  	if ($featured) {
    	$exclude = " and n.nid <> ".$featured->nid;
  	}

  	$query = "SELECT * FROM node n 
  	WHERE n.type='news' and n.status = 1 ".$exclude. " ORDER BY n.created DESC LIMIT 0,10"; 

 	$result = db_query($query);

  	$nodes = array();

  	while($row=$result->fetchObject()) {  
    	$nodes[] = $row->nid;
  	}

  	return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/news.tpl.php", 
    array("featured"=>$featured, "nodes"=>$nodes ,"pager"=>""));


}