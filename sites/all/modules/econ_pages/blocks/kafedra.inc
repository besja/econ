<?php

function _econ_pages_kafedra_block_view() {

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$node = node_load(arg(1)); 

		if (isset($node->field_struct_ref) && isset($node->field_struct_ref['und'][0]['node'])) {
			// ссылка на подразделение 
			$data = array(); 
			foreach ($node->field_struct_ref['und'] as $k) {
				$structure = $k['node']; 
				
				$obj = new stdClass(); 
				$obj->title = $structure->title;
				$obj->url = url('node/'.$structure->nid); 
				if (isset( $structure->field_leadimage['und'][0]['uri'])) {
					$obj->uri = $structure->field_leadimage['und'][0]['uri']; 
			    }
				$data[] = $obj;
			}
			return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/kafedra_block.tpl.php", 
    		array("data"=>$data));
		} 

		if (isset($node->field_stucture)) {
			// ссылка на подразделение 
			$structure = $node->field_stucture['und'][0]['node']; 
			$data = array(); 
			$data[0] = new stdClass(); 
			$data[0]->title = $structure->title;
			$data[0]->url = url('node/'.$structure->nid); 
			if (isset( $structure->field_leadimage['und'][0]['uri'])) {
				$data[0]->uri = $structure->field_leadimage['und'][0]['uri']; 
		    }
			//drupal_Set_message("<pre>".print_R($node, 1)."</pre>");
			return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/kafedra_block.tpl.php", 
    		array("data"=>$data));
		} 
	}
}

