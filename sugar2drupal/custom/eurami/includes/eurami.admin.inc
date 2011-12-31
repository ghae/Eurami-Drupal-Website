<?php

/**
 * Eurami module settings form.
 */
function eurami_settings() {
  $form['accreditation'] = array(
    '#type' => 'fieldset',
    '#title' => t('Accreditation'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  
  $form['accreditation']['accr_survey_nid'] = array(
    '#type' => 'textfield',
    '#title' => t('Client survey ID'),
    '#description' => t('The node id of the current survey used for the client accreditation'),
    '#default_value' => variable_get('accr_survey_nid', ''),
  );
  
  $form['accreditation']['accr_survey_auditor_nid'] = array(
    '#type' => 'textfield',
    '#title' => t('Auditor survey ID'),
    '#description' => t('The node id of the current survey used for the auditor accreditation'),
    '#default_value' => variable_get('accr_survey_auditor_nid', ''),
  );
  
  $form['accreditation']['company_created_msg'] = array(
    '#type' => 'textarea',
    '#title' => t('Message company created'),
    '#maxlength' => 255,
    '#description' => t('The message shown to the user if a company is created'),
    '#default_value' => variable_get('company_created_msg', ''),
  );
  
  $form['accreditation']['mother_poll'] = array(
    '#type' => 'textfield',
    '#title' => t('Base poll ID'),
    '#description' => t('The base poll that is copied for each accreditation.'),
    '#default_value' => variable_get('mother_poll', ''),
  );

  return system_settings_form($form);
}

