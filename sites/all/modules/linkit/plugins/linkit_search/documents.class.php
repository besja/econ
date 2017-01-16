<?php
/**
 * @file
 * Define Linkit node search plugin class.
 */

/**
 * Reprecents a Linkit node search plugin.
 */
class LinkitSearchPluginDocuments extends LinkitSearchPluginEntity {

  /**
   * Overrides LinkitSearchPlugin::ui_title().
   */
  function ui_title() {
    return t('Managed documents');
  }

  /**
   * Overrides LinkitSearchPluginEntity::createRowClass().
   *
   * Adds an extra class if the node is unpublished.
   */
  function createRowClass($entity) {
    if ($this->conf['include_unpublished'] && $entity->status == NODE_NOT_PUBLISHED) {
      return 'unpublished-node';
    }
  }
  function getQueryInstance() {
    $this->query = new EntityFieldQuery();
    $this->query->entityCondition('entity_type', $this->plugin['entity_type']);

    // Add the default sort on the entity label.
    $this->query->propertyOrderBy($this->entity_field_label, 'ASC');
  }
  /**
   * Implements LinkitSearchPluginInterface::fetchResults().
   */
  public function fetchResults($search_string) {
    // If the $search_string is not a string, something is wrong and an empty
    // array is returned.
    $matches = array();



    $this->plugin['entity_type'] = "node";  
    $this->entity_field_label = "title"; 

    $query = db_select("node", "n"); 
    $query->condition('n.status', 1); 
    $query->condition('n.type', array("document"), '='); 
    $query->join("field_data_field_document_date", "dt", "dt.entity_id=n.nid"); 
    $query->join("field_data_field_document_number", "dn", "dn.entity_id=n.nid"); 
    
    $db_or = db_or(); 

    $db_or->condition('n.title', '%' . db_like($search_string) . '%', 'LIKE');
    $db_or->where("DATE_FORMAT(dt.field_document_date_value,'%e.%m.%Y') = '".$search_string."'"); 
    $db_or->condition("dn.field_document_number_value", $search_string, "="); 

    $query->condition($db_or);

    $query->fields ('n', array ('nid')); 
    $query->range(0, 20); 
    

    // Execute the query.
    $result = $query->execute();

    $ids = array();

    foreach ($result as $row) { 
       $ids[] = $row->nid; 
    }

    // Load all the entities with all the ids we got.
    $entities = entity_load($this->plugin['entity_type'], $ids);

    foreach ($entities AS $entity) {
      // Check the access against the defined entity access callback.
      if (entity_access('view', $this->plugin['entity_type'], $entity) === FALSE) {
        continue;
      }

      $matches[] = array(
        'title' => $this->createLabel($entity),
        'description' => $this->createDescription($entity),
        'path' => $this->createPath($entity),
        'group' => $this->createGroup($entity),
        'addClass' => $this->createRowClass($entity),
      );

    }
    return $matches;
  }
  /**
   * Overrides LinkitSearchPlugin::buildSettingsForm().
   */
  function buildSettingsForm() {
    // Get the parent settings form.
    $form = parent::buildSettingsForm();

    $form[$this->plugin['name']]['include_unpublished'] = array(
      '#title' => t('Include unpublished nodes'),
      '#type' => 'checkbox',
      '#default_value' => isset($this->conf['include_unpublished']) ? $this->conf['include_unpublished'] : 0,
      '#description' => t('In order to see unpublished nodes, the user must also have permissions to do so. '),
    );

    return $form;
  }
}