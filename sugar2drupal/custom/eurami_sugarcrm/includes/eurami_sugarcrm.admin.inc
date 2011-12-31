<?php

function eurami_sugarcrm_admin_settings() {
  $form = array();

  // SugarCRM endpoint
  $form['eurami_sugarcrm_webservice'] = array(
    '#type'           => 'fieldset',
    '#title'          => t('SugarCRM web service end point'),
    '#description'    => t('The End Point is the Web Services handler you would like to use from your SugarCRM setup. You may select SOAP or REST end points.'),
  );
  $form['eurami_sugarcrm_webservice']['eurami_sugarcrm_webservice_endpoint'] = array(
    '#type'           => 'textfield',
    '#title'          => t('SugarCRM end point'),
    '#size'           => 120,
    '#maxlength'      => 256,
    '#default_value'  => variable_get('eurami_sugarcrm_webservice_endpoint', NULL),
    '#description'    => t('Enter the URL of your SugarCRM web service. Valid examples are: http://server/sugarcrm/service/v2/rest.php, http://server/service/v2/soap.php?wsdl.'),
  );

  $form['eurami_sugarcrm_webservice']['eurami_sugarcrm_rest_encoding'] = array(
    '#type'           => 'radios',
    '#title'          => t('SugarCRM RESTful encoding'),
    '#options'        => array('serialize' => t('PHP serialization'), 'json' => t('JSON encoding')),
    '#default_value'  => variable_get('eurami_sugarcrm_rest_encoding', 'json'),
    '#description'    => t('If the Web Service End Point is a RESTful service, select the type of encoding for the communicaiton. <strong>versions of <= SugarCRM 5.5.BETA1 should use JSON enconding</strong>. If json encoding is not available as option, then you should enable PHP JSON module.'),
  );
  
  // SugarCRM Authentication
  $form['eurami_sugarcrm_authentication'] = array(
    '#type'           => 'fieldset',
    '#title'          => t('SugarCRM Authentication'),
    '#description'    => t('The user and password of these fields should have access to some of the modules and information of your SugarCRM setup. Read carefully the documentation about how to prepare a secure user for this integration.'),
  );
  $form['eurami_sugarcrm_authentication']['eurami_sugarcrm_api_user'] = array(
    '#type'           => 'textfield',
    '#title'          => t('User login'),
    '#size'           => 32,
    '#maxlength'      => 64,
    '#default_value'  => variable_get('eurami_sugarcrm_api_user', ''),
    '#description'    => t('Enter the login name of the account used to connect Drupal with the SugarCRM installation'),
  );
  $form['eurami_sugarcrm_authentication']['eurami_sugarcrm_api_password'] = array(
    '#type'           => 'password',
    '#title'          => t('Password'),
    '#size'           => 32,
    '#maxlength'      => 64,
    '#default_value'  => variable_get('eurami_sugarcrm_api_password', ''),
    '#description'    => t('Enter the password of the account'),
  );

  $form['buttons']['update_session_id'] = array(
    '#type'   => 'submit',
    '#value'  => 'Test authentication',
    '#submit' => array('eurami_sugarcrm_api_session_reset'),
    '#weight' => 10,
  );

  return system_settings_form($form);
}


/*
 * Validator hook for settings. Check that that end point is set
 */
function eurami_sugarcrm_admin_settings_validate($form, &$form_state) {
  // There's no way to continue without a base url.
  if ($form_state['values']['eurami_sugarcrm_webservice_endpoint'] == '') {
    form_set_error('eurami_sugarcrm_webservice_endpoint', t('The web service end point is required.'));
  }
}


/*
 * Get or reset the session id
 */
function eurami_sugarcrm_api_session_reset() {
  if (eurami_sugarcrm_api_get_session(TRUE)) {
    drupal_set_message('Authentication succesful', 'ok');
  }
  else {
    drupal_set_message('Authenication failed', 'error');
  }
  
}
