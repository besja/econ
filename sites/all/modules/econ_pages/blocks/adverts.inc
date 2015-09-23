<?php 

function _econ_pages_adverts_last_block_view() {

	$exclude = "";
  	if (arg(0) == 'node' && is_numeric(arg(1))) {
    	$node = node_load(arg(1));
    	if ($node->type == "advert") {
    		$exclude = " and n.nid <> ".$node->nid;
    	}
    }
    $result = db_query("SELECT * FROM node n WHERE n.type='advert' ".$exclude." AND n.status = 1 ORDER by n.created DESC LIMIT 0,3");
    $nodes = array();
    while($row=$result->fetchObject()) {   
    	$nodes[] = node_load($row->nid);
    }
    return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/adverts_last.tpl.php", array("nodes"=>$nodes));
}

function _econ_pages_adverts_last_slider_block_view() {
	$result = db_query("SELECT * FROM node n WHERE n.type='advert' AND n.status = 1 ORDER by n.created DESC LIMIT 0,3");
    $nodes = array();
    while($row=$result->fetchObject()) {   
    	$nodes[] = node_load($row->nid);
    }
    return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/adverts_last_slider.tpl.php", array("nodes"=>$nodes));
}