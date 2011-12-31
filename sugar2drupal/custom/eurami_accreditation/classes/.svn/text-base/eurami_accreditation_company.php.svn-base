<?php
// $Id$
/**
 *  @file
 *  Class contains some custom functions of the company node
 */

class eurami_accreditation_company {
  protected $uid;
  protected $node;//variable used for caching the getNode variable

  function __construct($uid) {
    $this->uid = $uid;
  }
  
  function getID() {
    return $this->getNode()->nid;
  }

  /**
   * get a company node
   * @return false when no node found
   */
  function getNode() {
    if(is_null($this->node)) {
      //nakijken of de gebruiker al een bedrijf heeft aangemaakt
      $result = db_query("SELECT nid FROM {node} WHERE uid = %d AND type = 'company'", array($this->uid));
  
      if ($result->num_rows) {
        $nid = db_result($result);
        $this->node = node_load($nid);
      }
      else {
        return FALSE;
      }
    }
    
    return $this->node;
  }

  /**
   * Returns the currect accreditation, where the untildate is not been expired
   * @return eurami_accreditation_accreditation
   */
  function getActiveAccreditation() {
    $view = views_get_view('get_active_accreditation');
    $view->set_arguments(array($this->uid));
    $view->execute();

    if (count($view->result)) {
      return new eurami_accreditation_accreditation($view->result[0]->nid);
    }
    return FALSE;
  }

  function getAccreditations() {
    $view = views_get_view('get_my_accreditations');
    $view->set_arguments(array($this->uid));
    $view->execute();
    if (count($view->result)) {
      $list = array();
      foreach ($view->result AS $object) {
        $list[] = new eurami_accreditation_accreditation($object->nid);
      }
      return $list;
    }
    return FALSE;
  }
}