<?php
function _eurami_sugarcrm_mapping() {
  $mapping = array();
  
  /**
   *   -----------------------------
   *   | Drupal      | SugarCRM    |
   *   -----------------------------
   *   | profile     = contact     |
   *   -----------------------------
   */
  $mapping['profile'] = array(
    'mail' => 'email1',
    'profile_salutation' => 'salutation',
    'profile_first_name' => 'first_name',
    'profile_last_name' => 'last_name',
    'profile_title' => 'title',
    'profile_department' => 'department',
    'profile_birthdate' => 'birthdate',
    'profile_telephone' => 'phone_work',
    'profile_mobile' => 'phone_mobile',
    'profile_fax' => 'phone_fax',
    //'profile_company' => '',
    'profile_primary_address_street' => 'primary_address_street',
    'profile_primary_address_city' => 'primary_address_city',
    'profile_primary_address_postal_code' => 'primary_address_postalcode',
    'profile_primary_address_state' => 'primary_address_state',
    'profile_primary_address_country' => 'primary_address_country',
    'profile_other_address_street' => 'alt_address_street',
    'profile_other_address_city' => 'alt_address_city',
    'profile_other_address_postal_code' => 'alt_address_postalcode',
    'profile_other_address_state' => 'alt_address_state',
    'profile_other_address_country' => 'alt_address_country',
    //'profile_socmed_type' => '',
    //'profile_socmed_url' => '',
  );
  
  
  /**
   *   -----------------------------
   *   | Drupal      | SugarCRM    |
   *   -----------------------------
   *   | company     = account     |
   *   -----------------------------
   */
  $mapping['company'] = array (
    'field_telephone' => 'phone_office',
    'field_telephone_alternate' => 'phone_alternate',
    'field_company_fax' => 'phone_fax',
    'field_email_cn' => 'email1',
    'field_website_cn' => 'website',	
    'field_medical_director' => 'medical_director_c',
    'field_chief_nurse' => 'chief_nurse_c',
    'field_chief_pilot' => 'chief_pilot_c',
    'field_employees' => 'employees',
    'title' => 'name',
    'body' => 'description',
    '0/street' => 'billing_address_street',
    '0/city' => 'billing_address_city',
    '0/province' => 'billing_address_state',
    '0/postal_code' => 'billing_address_postalcode',
    '0/country' => 'billing_address_country',
    '1/street' => 'shipping_address_street',
    '1/city' => 'shipping_address_city',
    '1/province' => 'shipping_address_state',
    '1/postal_code' => 'shipping_address_postalcode',
    '1/country' => 'shipping_address_country',
    'accreditation_status' => 'acc_status_c',
    'accreditation_from' => 'accr_date_c',
    'accreditation_to' => 'accr_valid_to_c',
  );
  
  return $mapping;
}