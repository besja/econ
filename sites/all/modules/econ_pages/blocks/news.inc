<?php 
function _econ_pages_news_last_block_view() {

	global $language; 

	$query = "SELECT * FROM node n WHERE n.type = 'news' and n.status = 1  and n.language IN ('".$language->language."', 'und') ORDER BY n.created LIMIT 0,5";

	$result = db_query($query);

	$nodes = array();

	while($row=$result->fetchObject()) {  
	    $nodes[] = $row->nid;
	}

	return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/news.tpl.php", 
    array("featured"=>"", "nodes"=>$nodes ,"pager"=>"", "all"=>true));
}
