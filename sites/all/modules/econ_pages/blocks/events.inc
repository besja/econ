<?php 
function _econ_pages_events_last_block_view(){

	global $language; 

	$query = "SELECT * FROM node n 
	INNER JOIN field_data_field_event_date d ON d.entity_id = n.nid  and n.language IN ('".$language->language."', 'und')  
	WHERE n.type='event' and n.status = 1 and d.field_event_date_value > now() ORDER BY d.field_event_date_value ASC LIMIT 0,4"; 
	$result = db_query($query); 

	$nodes=array();
	while($row=$result->fetchObject()) {
		$nodes[] = $row->nid;
	}

  	return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/events_block.tpl.php", 
    array("featured"=>"", "nodes"=>$nodes ,"pager"=>"", "allevents"=>true));
}
