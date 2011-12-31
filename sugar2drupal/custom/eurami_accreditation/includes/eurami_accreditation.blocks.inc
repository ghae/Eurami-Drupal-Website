<?php
/**
 *  Block in the left menu for a user to manage his company & accredition
 */
function eurami_accreditation_block_mycompany($block) {
  global $user;
  $company = new eurami_accreditation_company($user->uid);

  $menu = array();
  if ($node = $company->getNode()) { //bedrijf bestaat al
    $menu[] = l(t('Company details'), 'node/' . $node->nid);

    foreach ($company->getAccreditations() AS $accreditation) {
      if ($accreditation->getWorkflowState() == eurami_accreditation_accreditation::REQUEST_PENDING) {
        //The company is pending, dont show anything
        continue;
      }
      //else... Company is active, so lets continue to show our block...

      if (!$accreditation->isClosed()) { //accreditation is open
        $main_link = t('Ongoing Assessement');
        $label_files = t('Manage files');
        $label_images = t('Manage images');
      }
      else { //accreditation is closed
        $date =  ' <span class="validity_date">'. $accreditation->getFrom() .' - '. $accreditation->getUntil() .'</span>';
        $main_link = t('Accreditation') . $date;

        $label_files = 'View files';
        $label_images = 'View images';
      }

      if ($accreditation->isSurveyFinished()) {
        $survey_link = l(t('View survey'), 'user/quiz/'. $accreditation->getQuizResultId() .'/userresults');
      }
      else {
        $survey_link = l(t('Survey'), 'node/'. $accreditation->getQuizNodeId() .'/take');
      }

      //view files and images, subitem of accredation
      $menu[] = array(
        'data' => l(t($main_link), 'node/'. $accreditation->getID(), array('html' => TRUE)),
        'class' => 'menu',
        'children' =>
          array(
            $survey_link,
            l(t($label_files), 'accreditation/'.$accreditation->getID().'/files', array('query' => 'gids[]='. $accreditation->getID())),
            l(t($label_images), 'accreditation/'.$accreditation->getID().'/images', array('query' => 'gids[]='. $accreditation->getID()))
          )
      );

      //is accreditation approved (but not done yet) and is the quiz done?
      if ($accreditation->getWorkflowState() == eurami_accreditation_accreditation::REQUEST_APPROVED
        && $accreditation->isSurveyFinished()) {
        $menu[] = '<b>'. flag_create_link('ready_onsite_visit', $accreditation->getID()) .'</b>';
      }
      
    }//end foreach
  }
  else { // company does not exists
    $menu[] = l(t('Accreditation sign up'), 'node/add/company');
  }

  $block['content'] = theme_item_list($menu, NULL, 'ul', array('class' => 'menu'));
  return $block;
}

/**
 *  Block in the left menu for an eurami auditor, second auditor or board member to manage accreditions
 *  Bouw een menu op dat alle links bevat van een accreditatie
  * Wordt gebruikt door de board member menu en de 1 & 2 lijn auditor.
 */
function eurami_accreditation_block_eurami_auditor($block) {
  global $user;
  $accr = new eurami_accreditation_accreditation($_SESSION['acc_id']);//id of accreditation
  og_user_roles_grant_roles($user, node_load($accr->getID()));
  
  $is_auditor = in_array('Eurami auditor', $user->roles);
  $is_secondary_auditor = in_array('Eurami secondary auditor', $user->roles);
  $is_admin = in_array('Eurami administrator', $user->roles);
  $is_board_member = in_array('Eurami board member', $user->roles);
  
  if(!$is_auditor && !$is_secondary_auditor && !$is_admin) {
    return;
  }
  
  if(!$accr->getNode() || (
      $accr->getWorkflowState() != eurami_accreditation_accreditation::READY_FOR_VISIT &&
      $accr->getWorkflowState() != eurami_accreditation_accreditation::VISITED &&
      $accr->getWorkflowState() != eurami_accreditation_accreditation::OPEN_FOR_VOTING
     )) {
    return;
  }
  
  $menu = array();
  $menu[] = l(t('Company details'), 'node/'. $accr->getCompany()->getID());
  
  //deze link zou enkel zichtbaar mogen zijn voor admins
  if (user_access('administer organic groups')) {
    $menu[] = l(t('Add users'), 'og/users/'. $accr->getID() .'/add_user');
    $menu[] = l(t('Manage user roles'), 'og/users/'. $accr->getID() .'/roles');
  }
  
  if($accr->getWorkflowState() == eurami_accreditation_accreditation::VISITED
    || $accr->getWorkflowState() == eurami_accreditation_accreditation::APPROVED 
    || $accr->getWorkflowState() == eurami_accreditation_accreditation::REJECTED 
    || $accr->getWorkflowState() == eurami_accreditation_accreditation::OPEN_FOR_VOTING
    || $is_secondary_auditor) {
    $menu[] = l(t('View files'), 'accreditation/'.$accr->getID().'/files', array('query' => 'gids[]='. $accr->getID()));
    $menu[] = l(t('View images'), 'accreditation/'.$accr->getID().'/images', array('query' => 'gids[]='. $accr->getID()));

  }
  elseif ($is_auditor || $is_admin) {
    $menu[] = l(t('Manage files'), 'accreditation/'.$accr->getID().'/files', array('query' => 'gids[]='. $accr->getID()));
    $menu[] = l(t('Manage images'), 'accreditation/'.$accr->getID().'/images', array('query' => 'gids[]='. $accr->getID()));
  }

  $menu[] = l(t('Client survey'), 'node/'. $accr->getQuizNodeId() .'/results/'. $accr->getQuizResultId());
  if($accr->getQuizAuditorResultId()) {
    $menu[] = l(t('Auditor survey'), 'node/'. $accr->getQuizAuditorNodeId() . '/results/'. $accr->getQuizAuditorResultId());
  }
  elseif (user_access('complete auditor survey')) {
    $menu[] = l(t('Enter auditor survey'), 'node/'. $accr->getQuizAuditorNodeId());
  }
  
  if ($is_auditor || $is_admin) {
    //Ready for visit state and is the auditor quiz done --> mark visited
    if ($accr->getWorkflowState() == eurami_accreditation_accreditation::READY_FOR_VISIT
        && $accr->isAuditorSurveyFinished()) {
      $menu[] = '<b>'. flag_create_link('acc_visited', $accr->getID()) .'</b>';
    }
  }
  if ($is_admin) {
    //Ready for voting...
    if ($accr->getWorkflowState() == eurami_accreditation_accreditation::VISITED  
        && $accr->isAuditorSurveyFinished()) {
      $menu[] = '<b>'. flag_create_link('ready_for_voting', $accr->getID()) .'</b>';
    }
  }
  
  $block['title'] = $accr->getNode()->title;
  $block['content'] = theme_item_list($menu, NULL, 'ul', array('class' => 'menu', 'id' => 'auditor_menu'));
  return $block;
}

function eurami_accreditation_block_eurami_poll($block) {
  if(!isset($_SESSION['acc_id']) || IsSet($_GET['gids'])) {
    return false;
  }

  $accr = new eurami_accreditation_accreditation($_SESSION['acc_id']);//id of accreditation
  
  if($accr->getWorkflowState() != eurami_accreditation_accreditation::OPEN_FOR_VOTING) {
    return false;
  }
  
  $node = $accr->getPoll();
  
  if(empty($node->title)) { // poll doesn't exist yet
    return false;
  }
  
  $block['title'] = $node->title;
  $block['content'] = node_view($node);
  return $block;
}
