<?php
function _econ_pages_intro_block_view(){

	$query = "SELECT * FROM node n INNER JOIN field_data_field_slider_type s ON s.entity_id = n.nid and n.status =1 and s.field_slider_type_value = 1 ORDER BY n.created DESC";
	$result = db_query($query); 

    $slider = array();
    while($row=$result->fetchObject()) {   
    	$slider[] = node_load($row->nid);
    }

	$query = "SELECT * FROM node n INNER JOIN field_data_field_slider_type s ON s.entity_id = n.nid and n.status =1 and s.field_slider_type_value = 2 ORDER BY n.created DESC";
	$result = db_query($query); 

    $banner= array();
    while($row=$result->fetchObject()) {   
    	$banner[] = node_load($row->nid);
    }

    return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/intro.tpl.php", array("slider"=>$slider, "banner"=>$banner));
}