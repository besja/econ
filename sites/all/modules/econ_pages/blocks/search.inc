<?php

function _econ_pages_search_block_view() {
	return theme_render_template(drupal_get_path('module', 'econ_pages')."/templates/search_news.tpl.php", array());
}