<?php
// $Id$
/**
 *  @file
 *  Class contains some custom functions of the accreditation node
 */

class eurami_accreditation_accreditation {
  //All workflow states, defined with their ID value
  const REQUEST_PENDING = 'request_pending_2';
  const REQUEST_REJECTED = 'request_rejected_11';
  const REQUEST_APPROVED = 'request_approved_3';
  const READY_FOR_VISIT = 'ready_for_visit_7';
  const VISITED = 'visited_8';
  const APPROVED = 'accredition_approved_10';
  const REJECTED = 'accreditation_rejected_11';
  const OPEN_FOR_VOTING = 'open_for_voting_13';

  protected $ID;
  protected $node;

  function __construct($ID) {
    $this->ID = $ID;
    $this->node = node_load($this->ID);
  }

  function getID() {
    return $this->ID;
  }

  function getNode()  {
    return $this->node;
  }

  function getQuizNodeId() {
    return $this->getNode()->field_accreditiation_quiz_node[0]['nid'];
  }
  
  function getQuizAuditorNodeId() {
    return $this->getNode()->field_acc_quiz_auditor[0]['nid'];
  }
  
  function getQuizResultId() {
    return $this->getNode()->field_accreditiation_quiz_result[0]['value'];
  }
  
  function getQuizAuditorResultId() {
    return $this->getNode()->field_acc_quiz_auditor_result[0]['value'];
  }
  
  //return bool
  function isSurveyFinished() {
    return (bool)($this->getQuizResultId());
  }
  
  function isAuditorSurveyFinished() {
    return (bool)($this->getQuizAuditorResultId());
  }

  function isClosed() {
    $state = workflow_node_current_state($this->getNode());
    return in_array($state, array(self::APPROVED, self::REJECTED, self::REQUEST_REJECTED));
  }
  
  function getFrom() {
    return date('d-m-Y', strtotime($this->getNode()->field_accreditiation_from[0]['value']));
  }
  
  function getUntil() {
    return date('d-m-Y', strtotime($this->getNode()->field_accreditiation_from[0]['value2']));
  }
  
  function getCompany() {
    return new eurami_accreditation_company($this->getNode()->uid);
  }
  
  function getWorkflowState() {
    return workflow_node_current_state($this->getNode());
  }
  
  //returns a poll node
  function getPoll() {
    return node_load($this->getNode()->field_accreditiation_poll[0]['nid']);
  }
}