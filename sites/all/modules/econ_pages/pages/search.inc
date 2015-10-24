<?php 

function econ_pages_search_page($module = NULL, $keys = '') {
	drupal_set_title("Поиск по сайту"); 
  $keys  = '';
  if (isset($_REQUEST['keys'])) {
  	$keys = trim($_REQUEST['keys']);
  }
  // Default results output is an empty string.
  $results = array('#markup' => '');
  // Process the search form. Note that if there is $_POST data,
  // search_form_submit() will cause a redirect to search/[module path]/[keys],
  // which will get us back to this page callback. In other words, the search
  // form submits with POST but redirects to GET. This way we can keep
  // the search query URL clean as a whistle.
  if (empty($_POST['form_id']) || $_POST['form_id'] != 'search_form') {
    $conditions =  NULL;
    // Only search if there are keywords or non-empty conditions.
    if ($keys || !empty($conditions)) {
      // Log the search keys.
      watchdog('search', 'Searched %type for %keys.', array('%keys' => $keys, '%type' => 'custom_search'), WATCHDOG_NOTICE, l(t('results'), 'searchsite/' . $keys));

      // Collect the search results.
      $results = econ_pages_search_execute($keys, $conditions);
    }

  }
  // The form may be altered based on whether the search was run.
  //$build['search_form'] = drupal_get_form('econ_pages_search_form', NULL, $keys,  NULL);
  $build['search_results'] = $results;
  $build['pager_pager'] = array('#theme' => 'pager');
  return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/search.tpl.php", 
    array("build"=>$build));

}

function econ_pages_search_execute($keys = NULL, $conditions = NULL) {
  // Build matching conditions
  $query = db_select('search_index', 'i', array('target' => 'slave'))->extend('SearchQuery')->extend('PagerDefault');
  $query->join('node', 'n', 'n.nid = i.sid');
  $query
    ->condition('n.status', 1)
    ->addTag('node_access')
    ->searchExpression($keys, 'node');
  $query->condition('n.type', array("slider_item"), 'NOT IN'); 
  if (isset($_GET['region'])) {
  	if ($_GET['region'] == 'news') {
  		 $query->condition('n.type', array("news", "advert", "event"), 'IN'); 

  	}
  	if ($_GET['region'] == 'notnews') {
  		$query->condition('n.type', array("news", "advert", "event"), 'NOT IN'); 
  	}

  }
  // Insert special keywords.
  $query->setOption('type', 'n.type');
  $query->setOption('language', 'n.language');
  if ($query->setOption('term', 'ti.tid')) {
    $query->join('taxonomy_index', 'ti', 'n.nid = ti.nid');
  }
  // Only continue if the first pass query matches.
  if (!$query->executeFirstPass()) {
    return array();
  }

  // Add the ranking expressions.
  _node_rankings($query);

  // Load results.
  $find = $query
    ->limit(10)
    ->execute();
  $results = array();
  foreach ($find as $item) {
    // Build the node body.
    $node = node_load($item->sid);
    node_build_content($node, 'search_result');
    $node->body = drupal_render($node->content);

    // Fetch comments for snippet.
   // $node->rendered .= ' ' . module_invoke('comment', 'node_update_index', $node);
    // Fetch terms for snippet.
   // $node->rendered .= ' ' . module_invoke('taxonomy', 'node_update_index', $node);

    $extra = module_invoke_all('node_search_result', $node);

    $results[] = array(
      'link' => url('node/' . $item->sid, array('absolute' => TRUE)),
      'type' => check_plain(node_type_get_name($node)),
      'title' => $node->title,
      'user' => theme('username', array('account' => $node)),
      'date' => $node->changed,
      'extra' => $extra,
      'score' => $item->calculated_score,
      'snippet' => search_excerpt($keys, $node->body),
    );
  }

  return $results;
}

function econ_pages_search_form($form, &$form_state, $action = '', $keys = '', $module = NULL, $prompt = NULL) {
  $module_info = FALSE;
  if (!$module) {
    $module_info = search_get_default_module_info();
  }
  else {
    $info = search_get_info();
    $module_info = isset($info[$module]) ? $info[$module] : FALSE;
  }

  // Sanity check.
  if (!$module_info) {
    form_set_error(NULL, t('Search is currently disabled.'), 'error');
    return $form;
  }

  if (!$action) {
    $action = 'searchsite';
  }
  if (!isset($prompt)) {
    $prompt = t('Enter your keywords');
  }

  $form['#action'] = url($action);
  // Record the $action for later use in redirecting.
  $form_state['action'] = $action;
  $form['#attributes']['class'][] = 'search-form';
  $form['module'] = array('#type' => 'value', '#value' => $module);
  $form['basic'] = array('#type' => 'container', '#attributes' => array('class' => array('container-inline')));
  $form['basic']['keys'] = array(
    '#type' => 'textfield',
    '#title' => $prompt,
    '#default_value' => $keys,
    '#size' => $prompt ? 40 : 20,
    '#maxlength' => 255,
  );
  // processed_keys is used to coordinate keyword passing between other forms
  // that hook into the basic search form.
  $form['basic']['processed_keys'] = array('#type' => 'value', '#value' => '');
  $form['basic']['submit'] = array('#type' => 'submit', '#value' => t('Search'));

  return $form;
}

