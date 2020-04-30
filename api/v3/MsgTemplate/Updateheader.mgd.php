<?php
// This file declares a managed database record of type "Job".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return array (
  0 =>
  array (
    'name' => 'Update headers in templates',
    'entity' => 'Job',
    'params' =>
    array (
      'version' => 3,
      'name' => 'Update headers in templates',
      'description' => 'Update Header HTML in Message Templates',
      'run_frequency' => 'Monthly',
      'api_entity' => 'MsgTemplate',
      'api_action' => 'Updateheader',
      'parameters' => 'msg_template_ids=comma_separated_list_of_ids',
    ),
  ),
);
