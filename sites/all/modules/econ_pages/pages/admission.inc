<?php

function econ_pages_admission_page() {
	drupal_set_title('Абитуриенту'); 
	$all_fields_on_my_website = field_info_fields();

	$bases = list_allowed_values($all_fields_on_my_website["field_programm_base"]); 
	$forms = list_allowed_values($all_fields_on_my_website["field_programm_form"]);
	$types = taxonomy_get_tree(4); 

	drupal_add_js(drupal_get_path('module', 'econ_pages')."/js/admission.js"); 
	return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/admission.tpl.php", 
    array("bases"=>$bases, "forms"=>$forms ,"types"=>$types));
}

function econ_pages_admission_page_result() {
	$parameters = drupal_get_query_parameters();

	$base = "";
	$form = "";
	$type = "";

	if (isset($parameters['base']) && is_numeric($parameters['base'])){
		$base = $parameters['base']; 
	} 
	if (isset($parameters['form']) && is_numeric($parameters['form'])){
		$form = $parameters['form']; 
	} 
	if (isset($parameters['type']) && is_numeric($parameters['type'])){
		$type = $parameters['type']; 
	} 
	$type_subquery = ""; 
	if ($type) {
		$type_subquery =  " AND td.tid = ".$type." "; 
	}
	$base_subquery = "";
	if ($base) {
		$base_subquery = " INNER JOIN field_data_field_programm_base pb ON pb.entity_id = n.nid AND pb.field_programm_base_value = ".$base; 
	}
	$form_subquery = "";
	if ($form) {
		$form_subquery = " INNER JOIN field_data_field_programm_form pf ON pf.entity_id = n.nid AND pf.field_programm_form_value = ".$form; 
	}
	$query = "SELECT n.*, td.* FROM node n 
	INNER JOIN field_data_field_programm_type pt ON pt.entity_id = n.nid 
	INNER JOIN taxonomy_term_data td ON td.tid = pt.field_programm_type_tid " .$type_subquery . $base_subquery. $form_subquery.  " 
	ORDER BY td.weight ASC, n.title ASC "; 

	$result = db_query($query); 
	$data = array(); 
	while($row=$result->fetchObject()) {
		$data[$row->tid][] = $row; 
	}
	print theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/admission_result.tpl.php", 
    array("data"=>$data));
}