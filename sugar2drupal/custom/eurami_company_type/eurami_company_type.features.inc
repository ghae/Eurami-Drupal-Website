<?php

/**
 * Implementation of hook_node_info().
 */
function eurami_company_type_node_info() {
  $items = array(
    'company' => array(
      'name' => t('Company'),
      'module' => 'features',
      'description' => t('Company info'),
      'has_title' => '1',
      'title_label' => t('Name'),
      'has_body' => '0',
      'body_label' => '',
      'min_word_count' => '0',
      'help' => '',
    ),
  );
  return $items;
}
