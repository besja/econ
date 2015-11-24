<?php
function econ_pages_phones_page() {
	// показывает все контакты сгруппированные по категориям 
	drupal_set_title('Телефонный справочник'); 
	$terms = taxonomy_get_tree(3); 

	$data = 
		'<div class="common-module common-tabs">
    	<a href="'.url('fakultet/contacts').'" class="common-tabs__tab common-tabs__tab--big-text">Местоположение</a>
    	<a href="'.url('fakultet/contacts/phones').'" class="common-tabs__tab common-tabs__tab--big-text current">Телефонный справочник</a>
		</div>
	<h1 class="page__title">Телефонный справочник</h1>';

	foreach($terms as $term) {
		if ($term->parents[0] == 0) {
			//корпуса
			$data .= "<div class='contacts__corp'><h2>".$term->name."</h2>"; 
			$tid = $term->tid;  
			foreach($terms as $child) {
				if ($child->parents[0] == $tid) {
					// отделы 
					
					$items=array(); 

					$query = "SELECT * FROM node n 
					INNER JOIN field_data_field_contact_category c 
					ON n.nid = c.entity_id AND c.field_contact_category_tid =  ".$child->tid." 
					AND n.type = 'contact_item' AND n.status = 1 
					ORDER BY n.sticky DESC, n.title ASC 
					";
					$result = db_query($query);
					while($row=$result->fetchObject()) {
						$node = node_load($row->nid);
						$render = node_view($node, "teaser");
						$items[] =  render($render); 
					}
					if (count($items)) {
						$data .= '<h4 class="contacts__lead">'.$child->name.'</h4>'; 
						$data .= implode("", $items); 
					}
				}
			}
			$data .= "</div>";
		}
	}
	//drupal_set_message("<pre>".print_R($terms, 1)."</pre>");
	return $data;
}