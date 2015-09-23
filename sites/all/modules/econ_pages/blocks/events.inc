<?php 
function _econ_pages_events_last_block_view(){

	$query = "SELECT * FROM node n 
	INNER JOIN field_data_field_event_date d ON d.entity_id = n.nid 
	WHERE n.type='event' and n.status = 1 and d.field_event_date_value2 < now() ORDER BY d.field_event_date_value ASC LIMIT 0,5"; 
	$result = db_query($query); 

	$nodes=array();
	while($row=$result->fetchObject()) {
		$nodes[] = $row->nid;
	}

  	return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/events.tpl.php", 
    array("featured"=>"", "nodes"=>$nodes ,"pager"=>"", "allevents"=>true));
}
