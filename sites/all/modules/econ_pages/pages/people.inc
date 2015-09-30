<?php


function econ_pages_people_structure_page() {

	global $language;

	$header = _econ_pages_people_header(); 

	$parameters = drupal_get_query_parameters();

	$current_structure = ""; 

	$content="";

	if (isset($parameters['structure']) && is_numeric($parameters['structure'])){
		$current_structure = $parameters['structure']; 
	} 

	if ($current_structure) {	

		// выбрано подразделение

		$struct_node = node_load($current_structure); 

		if ($struct_node) { 

			$query = "SELECT n.nid, n.title FROM field_data_field_struct_ref r 
			INNER JOIN field_data_field_perston_structures s ON s.field_perston_structures_value = r.entity_id  AND r.field_struct_ref_nid = ".$current_structure." 
			INNER JOIN node n ON n.nid = s.entity_id AND n.type = 'person' AND n.status = 1 AND n.language IN ('und', '".$language->language."') GROUP BY n.nid ORDER by n.title"; 

			$result = db_query($query); 

			$nodes = array();

			while($row=$result->fetchObject()) {
				$nodes[] = $row; 		
			}
			$content  =  '<h2 class="page__subheader">'.$struct_node->title.'</h2>'.theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/people.tpl.php", 
	    	array("nodes"=>$nodes));
		}
	}else {
		//выбрана категория подразделений
		$args = arg(); 
		$paths = _econ_pages_get_people_path();
		$paths_flip = array_flip($paths);
		

		if (isset($paths_flip[$args[1]])) { 
			$current_type = $paths_flip[$args[1]]; 

		
			$query = "SELECT * FROM node n 
			INNER JOIN field_data_field_structure_type t 
			ON t.entity_id = n.nid AND n.status = 1 AND 
			t.field_structure_type_value  =  ".$current_type ." 
			AND n.language IN ('und', '".$language->language."')
			ORDER BY n.title "; 
			$result = db_query($query); 

			while($row=$result->fetchObject()) {
				$current_structure= $row->nid; 
				$query = "SELECT n.nid, n.title 
				FROM field_data_field_struct_ref r 
				INNER JOIN field_data_field_perston_structures s 
				ON s.field_perston_structures_value = r.entity_id  
				AND r.field_struct_ref_nid = ".$current_structure." 
				INNER JOIN node n ON n.nid = s.entity_id AND n.type = 'person' 
				AND n.status = 1 AND n.language IN ('und', '".$language->language."') GROUP BY n.nid ORDER by n.title"; 

				$result2 = db_query($query); 
				$nodes = array();
				while($row2=$result2->fetchObject()) {
					$nodes[] = $row2; 		
				}
				if (count($nodes)) {
					$content  .= '<h2 class="page__subheader">'.$row->title.'</h2>'. theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/people.tpl.php", 
	    			array("nodes"=>$nodes));
				}
			}


		}
	}
	return $header.$content;
	

}
function econ_pages_people_abc_page() {

	global $language;

	$header = _econ_pages_people_header(); 

	$parameters = drupal_get_query_parameters();

	$current_letter = "А";
	if (isset($parameters['letter'])){
		$current_letter = $parameters['letter']; 
	} 

	$query = "SELECT * FROM node n 
	WHERE n.type = 'person' and n.status = 1 AND n.language IN ('und', '".$language->language."') 
	and n.title LIKE '".$current_letter."%' ORDER BY n.title"; 

	$result = db_query($query);

	$nodes = array();

	while ($row=$result->fetchObject()) {
		$nodes[] = $row;
	}

	$content  = theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/people.tpl.php", 
    	array("nodes"=>$nodes));
	return $header.$content;

}

function _econ_pages_people_header() {

	global $language;

	drupal_set_title("Сотрудники, преподаватели и выпускники"); 
	$parameters = drupal_get_query_parameters();

	// алфавит 

	$current_letter = "А";
	if (isset($parameters['letter'])){
		$current_letter = $parameters['letter']; 
	} 

    $args = arg(); 

    // по умолчанию - алфавит 
    $current_type = "abc"; 
    $paths = _econ_pages_get_people_path();

    if (count($args) == 2) {
    	$paths_flip = array_flip($paths);
    	if (isset($paths_flip[$args[1]])) {
    		$current_type = $paths_flip[$args[1]]; 
    	} 	
    }

	$current_structure = ""; 

	if (isset($parameters['structure']) && is_numeric($parameters['structure'])){
		$current_structure = $parameters['structure']; 
	} 

    if ($language->language=='en') {
    	$abc_str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
    } else {
		$abc_str = "АБВГДЕЁЖЗИКЛМНОПРСТУФХЦЧШЩЭЮЯ"; 
	}
	$abc_arr = str_split_unicode($abc_str); 

	$query = "SELECT 
	SUBSTRING(n.title, 1, 1) as letter 
	FROM node n WHERE n.type = 'person' 
	and n.status = 1 
	AND n.language IN ('und', '".$language->language."') 
	GROUP BY letter ORDER BY letter";

	$result = db_query($query); 
	$abc_exc = array();
	while($row=$result->fetchObject()) {
		$abc_exc[] = $row->letter; 
	}
	$abc_data = array(); 
	foreach ($abc_arr as $row) {
		$class = "";
		if (!in_array($row, $abc_exc)) {
			$class = "abc-filter__letter--disabled"; 
		}
		if (mb_convert_case($row,MB_CASE_LOWER, "UTF-8")==mb_convert_case($current_letter, MB_CASE_LOWER, "UTF-8")) {
			$class = "abc-filter__letter--current"; 
		}
		$abc_data[] = l($row, "people", array("attributes"=>array("class"=>array("abc-filter__letter", $class)), "query"=>array("letter"=>$row))); 
	} 


	// подразделения 
	$all_fields_on_my_website = field_info_fields();
	$allowed_values= list_allowed_values($all_fields_on_my_website["field_structure_type"]);

	$struct_data = array(); 
	

	foreach ($allowed_values as $k=>$v) {

		$items = array();

		$type = $paths[$k];

		$query = "SELECT * FROM node n 
		INNER JOIN field_data_field_structure_type t 
		ON t.entity_id = n.nid AND n.status = 1 AND t.field_structure_type_value  =  ".$k." 
		AND n.language IN ('und', '".$language->language."') 
		ORDER BY n.title "; 

		$result = db_query($query); 
		
		$is_active_link_header = false; 
		if ($k == $current_type) {
			$is_active_link_header = true; 
		}

		while($row=$result->fetchObject()) { 
			$is_active_link_structure = False; 

			if ($row->nid == $current_structure) {
				$is_active_link_structure = True; 
				$is_active_link_header = true; 
			}
			
			$items[] = array("link_url"=>url("people/".$type, array("query"=>array("structure"=>$row->nid))), "link_title"=>$row->title, "active"=>$is_active_link_structure);
		}

		$struct_data[] = array("header"=>array("link_url"=>"people/".$type, "link_title" => $v, "active"=>$is_active_link_header), "items"=>$items); 
	}
  	return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/people_header.tpl.php", 
    	array("abc_data"=>$abc_data, "struct_data"=>$struct_data, "current_type" => $current_type));
}

function str_split_unicode($str, $l = 0) {
    if ($l > 0) {
        $ret = array();
        $len = mb_strlen($str, "UTF-8");
        for ($i = 0; $i < $len; $i += $l) {
            $ret[] = mb_substr($str, $i, $l, "UTF-8");
        }
        return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

