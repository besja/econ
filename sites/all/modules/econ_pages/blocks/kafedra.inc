<?php

function _econ_pages_kafedra_block_view() {

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$node = node_load(arg(1)); 

		if (isset($node->field_struct_ref) && isset($node->field_struct_ref['und'][0]['node'])) {
			// ссылка на подразделение 
			$structure = $node->field_struct_ref['und'][0]['node']; 
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

		if ($node->type=='person') {
			// связь персона - подразделение
			  $links= array(); 
			  $query = "SELECT n.nid, n.title, t.field_structure_type_value as struct_type FROM field_data_field_perston_structures s 
			  INNER JOIN field_data_field_struct_ref r ON s.field_perston_structures_value = r.entity_id 
			  INNER JOIN node n ON n.nid = r.field_struct_ref_nid 
			  INNER JOIN field_data_field_structure_type t ON t.entity_id = n.nid 
			  WHERE s.entity_id = ".$node->nid." and n.status = 1 ORDER BY s.delta"; 

			  $result = db_query($query);

			  $data = array(); 
			  while($row = $result->fetchObject()) {
			    $structure = node_load($row->nid);
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

