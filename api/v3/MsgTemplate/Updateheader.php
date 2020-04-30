<?php
use CRM_Msgtemplateheader_ExtensionUtil as E;

/**
 * MsgTemplate.Updateheader API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see http://wiki.civicrm.org/confluence/display/CRMDOC/API+Architecture+Standards
 */
function _civicrm_api3_msg_template_Updateheader_spec(&$spec) {
  $spec['msg_template_ids']['api.required'] = 1;
}

/**
 * MsgTemplate.Updateheader API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_msg_template_Updateheader($params) {
  if (!empty($params['msg_template_ids'])) {
    $returnValues = [];
    CRM_Msgtemplateheader_Header::updateHTML($params['msg_template_ids']);
    return civicrm_api3_create_success($returnValues, $params, 'NewEntity', 'NewAction');
  }
  else {
    throw new API_Exception(/*errorMessage*/ 'Empty parameter - msg_template_ids', /*errorCode*/ 1234);
  }
}
