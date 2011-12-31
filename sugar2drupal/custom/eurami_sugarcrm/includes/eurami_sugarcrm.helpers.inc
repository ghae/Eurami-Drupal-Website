<?php
function _debug($var) {
  echo '<pre>';
  print_r($var);
  echo '</pre>';
}

function _eurami_sugarcrm_user_pull($form, &$form_state) {
  global $user;
  
  $mapping = _eurami_sugarcrm_mapping();
  
  if ($user->uid) {
	  // see if user exists in SugarCRM
	  $method = 'search_by_module';
	  $params = array(
	    'search_string' => $user->mail,
	    'modules' => array('Contacts', 'Leads'),
	    'offset' => 0,
	    'max_results' => 1,
	  );
	  $result = eurami_sugarcrm_api_request($method, $params);
	  
	  $roles = array_flip(user_roles());
	  foreach ($result['entry_list'] as $entry) {
	    if(count($entry->records) == 0) {
	      continue;
	    }
	    
	    switch ($entry->name) {
		    case 'Contacts':
			    // user data
			    $sugarbean_id = $entry->records[0]->id->value;
			
			    $method = 'get_entry';
			    $params = array(
				    'module_name' => 'Contacts',
				    'id' => $sugarbean_id,
			    );
			    $contact = eurami_sugarcrm_api_request($method, $params);
			    $contact = $contact['entry_list'][0]->name_value_list;
			    
			    foreach($mapping['profile'] as $drp_field => $sgr_field) {
            $new_value = $lead->$sgr_field->value;
            
            // try to get the correct taxonomy tid for the country
            if ($drp_field == 'profile_primary_address_country' || $drp_field == 'profile_other_address_country') {
              $country = taxonomy_get_term_by_name($contact->$sgr_field->value);
              $new_value = $country[0]->tid;
            }
            
            $profile_fields[$drp_field] = $contact->$sgr_field->value;
          };
			    user_save($user, $profile_fields);
			    
			    // role
			    user_multiple_role_edit(array($user), 'remove_role', $roles['Lead']);
			    user_multiple_role_edit(array($user), 'add_role', $roles['Contact']);
		      break;
		    case 'Leads':
			    // ignore converted leads..
			    if ($entry->records[0]->status->value == 'Converted') {
			     continue;
			    }
			    
			    // user data
			    $sugarbean_id = $entry->records[0]->id->value;
			
			    $method = 'get_entry';
			    $params = array(
				    'module_name' => 'Leads',
				    'id' => $sugarbean_id,
			      'select_fields' => array_values($mapping['profile']),
			    );
			    $lead = eurami_sugarcrm_api_request($method, $params);
			    $lead = $lead['entry_list'][0]->name_value_list;
			    
			    foreach($mapping['profile'] as $drp_field => $sgr_field) {
			      $new_value = $lead->$sgr_field->value;
			      
			      // try to get the correct taxonomy tid for the country
            if ($drp_field == 'profile_primary_address_country' || $drp_field == 'profile_other_address_country') {
              $country = taxonomy_get_term_by_name($lead->$sgr_field->value);
              $new_value = $country[0]->tid;
            }
			    
            $profile_fields[$drp_field] = $new_value;
          };
			    user_save($user, $profile_fields);
			    
			    // role
			    user_multiple_role_edit(array($user), 'remove_role', $roles['Contact']);
			    user_multiple_role_edit(array($user), 'add_role', $roles['Lead']);
			    break;
	    }
	  }
  }
  
  return;
}

function _eurami_sugarcrm_user_push($form, &$form_state) {

  if (isset($form_state['user'])) {
    $user = user_load($form_state['user']->uid);
  }
  else {
    $user = user_load(arg(1));
  }
  
  $mapping = _eurami_sugarcrm_mapping();
    
  if ($user->uid) {
    // default will be 'Leads'
    $module_name = 'Contacts';
  
    // see if user exists in SugarCRM
    $method = 'search_by_module';
    $params = array(
      'search_string' => $user->mail,
      'modules' => array('Contacts','Leads'),
      'offset' => 0,
      'max_results' => 1,
    );
    $result = eurami_sugarcrm_api_request($method, $params);
    
    foreach ($result['entry_list'] as $entry) {
      if(count($entry->records) == 0) {
        continue;
      }
      
      switch ($entry->name) {
        case 'Contacts':
          $module_name = 'Contacts';
          $sugarbean_id = $entry->records[0]->id->value;
          break;
        case 'Leads':
	        // ignore converted leads..
	        if ($entry->records[0]->status->value == 'Converted') {
	          continue;
	        }
          
          $module_name = 'Leads';
          $sugarbean_id = $entry->records[0]->id->value;
          break;
      }
    }
    
    $name_value_list = array();
    if ($sugarbean_id) {
      $name_value_list[] = array (
        'name' => 'id', 
        'value' => $sugarbean_id
      );
    }
    foreach($mapping['profile'] as $drp_field => $sgr_field) {
      $new_value = $form_state['values'][$drp_field];
    
      if ($drp_field == 'profile_primary_address_country' || $drp_field == 'profile_other_address_country') {
        $country = taxonomy_get_term($form_state['values'][$drp_field]);
        $new_value = $country->name;
      }
    
      // set default first, then overide with form_state value.
      // we don't receive all the fields since we are working with categories
      $name_value_list[] = array(
        'name' => $sgr_field,
        'value' => empty($form_state['values'][$drp_field]) ? $user->$drp_field : $new_value,
      );
    };
  
    $method = 'set_entry';
    $params = array(
      'module_name' => $module_name,
      'name_value_list' => $name_value_list,
    );
    $result = eurami_sugarcrm_api_request($method, $params);
  }
  
  return;
}


function _eurami_sugarcrm_company_pull(&$node) {
  if(!$sugarbean_id = $node->field_sugarbean_id[0]['value']) {
    return;//node didnt exists in CRM yet, abort
  }
  
 // print_r($sugarbean_id);
 // print_r($node);
  
  $mapping = _eurami_sugarcrm_mapping();
  $mapping = $mapping['company'];
  $flipped_mapping = array_flip($mapping);
  
  $method = 'get_entry';
  $params = array(
    'module_name' => 'Accounts',
    'id' => $sugarbean_id,
    'select_fields' => $mapping
  );
  $result = eurami_sugarcrm_api_request($method, $params);
  
  //print_r($result);
  
  //load the countries array, to convert BE -> Belgium
  $countries = location_get_iso3166_list();
  $countries = array_flip($countries);

  //loop over each field that the CRM sent
  foreach($result['entry_list'][0]->name_value_list AS $field) {
    
    $drp_field = $flipped_mapping[$field->name];
    $value = $field->value;
    
    switch($drp_field) {
      case '0/street':
      case '0/city':
      case '0/province':
      case '0/postal_code':
      case '1/street':
      case '1/city':
      case '1/province':
      case '1/postal_code':
        list($index, $field) = explode('/',$drp_field);
        $node->locations[$index][$field] = $value;
        break;
      case '0/country':
      case '1/country':
        list($index, $field) = explode('/',$drp_field);
        $node->locations[$index][$field] = $countries[$value];
        break;
      case 'accreditation_from':
      case 'accreditation_to':
      case 'accreditation_status':
        
        break;
      case 'body':
      case 'title':
        $node->$drp_field = $value;
        break;
      default:
        $node->$drp_field = array(array('value' => $value));
    }
  }
}

function _eurami_sugarcrm_company_push(&$node) {
  global $user;
  
  $mapping = _eurami_sugarcrm_mapping();
  $sugarbean_id = false;
  $name_value_list = array();
  
  // see if company exists in SugarCRM
  if($node->nid && $node->field_sugarbean_id[0]['value']) {
    $method = 'get_entry';
    $params = array(
      'module_name' => 'Accounts',
      'id' => $node->field_sugarbean_id[0]['value'],
    );
    $result = eurami_sugarcrm_api_request($method, $params);
    
    //if an $sugarbean_id is found, update the current company = account in SugarCrm
    if($result['entry_list'][0]->id) {
      $name_value_list[] = array (
        'name' => 'id', 
        'value' => $node->field_sugarbean_id[0]['value']
      );
    }
    
    $accreditation = getAccreditationInfoFromCompany($node->nid, $variables);
  } //end of: see if company exists in SugarCRM
    
  foreach($mapping['company'] as $drp_field => $sgr_field) {
    switch($drp_field) {
      case '0/street':
      case '0/city':
      case '0/province':
      case '0/postal_code':
      case '1/street':
      case '1/city':
      case '1/province':
      case '1/postal_code':
        list($index, $field) = explode('/',$drp_field);
        $value = $node->locations[$index][$field];
        break;
      case '0/country':
      case '1/country':
        list($index, $field) = explode('/',$drp_field);
        $value = location_country_name($node->locations[$index][$field]);
        break;
      case 'body':
      case 'title':
        $value = $node->$drp_field;
        break;
      case 'accreditation_from':
      case 'accreditation_to':
        if($accreditation && $accreditation[$drp_field]) {
          $value = $accreditation[$drp_field];
        }
        break;
      case 'accreditation_status':
        if($accreditation && $accreditation['accreditation_status']) {
          switch($accreditation['accreditation_status']) {
            case 'Not accredited':
              $value = 'Not accredited or affiliated';
              break;
            case 'Full Accreditation':
              $value = 'Full Accreditation';
              break;
            case 'Special Care Accreditation':
              $value = 'Special Care Accreditation';
              break;
          }
        }
        break;
      default:
        $field = $node->$drp_field;
        $value = $field[0]['value'];
    }

    $name_value_list[] = array(
      'name' => $sgr_field,
      'value' => $value
    );
  };

  $method = 'set_entry';
  $params = array(
    'module_name' => 'Accounts',
    'name_value_list' => $name_value_list,
  );
  $sugarbean_id = eurami_sugarcrm_api_request($method, $params);
  
  // add relationship between company and contact
  
  if ($user->uid) {
    // see if user exists in SugarCRM
    $method = 'search_by_module';
    $params = array(
      'search_string' => $user->mail,
      'modules' => array('Contacts', 'Leads'),
      'offset' => 0,
      'max_results' => 1,
    );
    $result = eurami_sugarcrm_api_request($method, $params);
	  
    $roles = array_flip(user_roles());
    foreach ($result['entry_list'] as $entry) {
      if(count($entry->records) == 0) {
        continue;
      }
    
      switch ($entry->name) {
        case 'Contacts':
	  // user data
	  $sugarbean_userid = $entry->records[0]->id->value;
      }
    }
  }
  
  $method = 'set_relationship';
  $params = array(
    'module_name' => 'Accounts',
    'module_id' => $sugarbean_id['id'],
    'link_field_name' => 'contacts',
    'related_ids' => array($sugarbean_userid)
  );
  
  $response = eurami_sugarcrm_api_request($method, $params);
  
  return $sugarbean_id['id'];
}
