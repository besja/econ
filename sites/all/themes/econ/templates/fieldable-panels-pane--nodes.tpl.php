<?php //drupal_Set_message("<pre>".print_r($content, 1)."</pre>");?> 

<?php if (isset($content['field_pane_nodes']['#object'])) {
	$entity = $content['field_pane_nodes']['#object']; 

	if (!empty($entity->field_pane_nodes)) {
		foreach ($entity->field_pane_nodes['und'] as $key => $value) {
			$node = $value['entity']; 
			$render = node_view($node, "wysiwyg_teaser");
    		print render($render);
		}
	}
}