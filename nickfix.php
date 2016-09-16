<?php

require_once 'nickfix.civix.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function nickfix_civicrm_config(&$config) {
  _nickfix_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function nickfix_civicrm_xmlMenu(&$files) {
  _nickfix_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function nickfix_civicrm_install() {
  _nickfix_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function nickfix_civicrm_uninstall() {
  _nickfix_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function nickfix_civicrm_enable() {
  _nickfix_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function nickfix_civicrm_disable() {
  _nickfix_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function nickfix_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _nickfix_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function nickfix_civicrm_managed(&$entities) {
  _nickfix_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function nickfix_civicrm_caseTypes(&$caseTypes) {
  _nickfix_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function nickfix_civicrm_angularModules(&$angularModules) {
_nickfix_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function nickfix_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _nickfix_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

function nickfix_civicrm_pre($op, $objectName, $id, &$params) {
  if ($objectName == 'Individual' && ($op == 'create' || $op == 'edit')) {
    /* Bail if nickname is provided */
    if (!empty($params['nick_name'])) {
      return;
    }
    /* Fetch nickname if contact exists */
    $nickname = NULL;
    if (!empty($id)) {
      $nickname = civicrm_api3('Contact', 'getvalue', array(
        'return' => 'nick_name',
        'id' => $id
      ));
    }
    /* We already have a nickname for this contact */
    if (!empty($nickname)) {
      /* if nickname is provided and not an empty string; bail */
      if (array_key_exists('nick_name', $params) && !empty($params['nick_name'])) {
        return;
      }
      if (!array_key_exists('nick_name', $params)) {
        return;
      }
    }

    /* Fetch first name if not provided */
    $firstname = CRM_Utils_Array::value('first_name', $params);
    if (!empty($id) && empty($firstname)) {
      $firstname = civicrm_api3('Contact', 'getvalue', array(
        'return' => 'first_name',
        'id' => $id
      ));
    }
    $params['nick_name'] = $firstname;
  }
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
 **/
/*
function nickfix_civicrm_preProcess($formName, &$form) {

}
*/

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
**/
/*
function nickfix_civicrm_navigationMenu(&$menu) {
  _nickfix_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'org.leadercenter.nickfix')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _nickfix_civix_navigationMenu($menu);
}
*/
