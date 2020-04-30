<?php

class CRM_Msgtemplateheader_Header {

  /**
   * Update header in msg templates
   *
   * @param string $msgTemplateIds
   *  comma separated string of template ids to update.
   */
  public static function updateHTML($msgTemplateIds) {
    if (empty($msgTemplateIds)) {
      return;
    }
    $getParams = [
      'sequential' => 1,
      'return' => ["msg_html", "id"],
      'msg_html' => ['NOT LIKE' => "%UPDATED BY MSGTEMPLATEHEADER EXT%"],
      'options' => ['limit' => 0],
    ];
    if ($msgTemplateIds != 'all') {
      $templateIds = explode(',', $msgTemplateIds);
      $getParams['id'] = ['IN' => $templateIds];
    }
    $msgTemplates = civicrm_api3('MessageTemplate', 'get', $getParams);
    $mailingComponent = civicrm_api3('MailingComponent', 'get', [
      'sequential' => 1,
      'return' => ["body_html"],
      'name' => "System Template Header",
    ]);
    if (!empty($mailingComponent['values'][0]['body_html'])) {
      $headerHTML = $mailingComponent['values'][0]['body_html'];
    }
    else {
      throw new API_Exception(/*errorMessage*/ 'No Mailing component with name - System Template Header', /*errorCode*/ 1234);
      return;
    }

    foreach ($msgTemplates['values'] as $templates) {
      if (!empty($templates['msg_html'])) {
        $newHeader = "<!-- BEGIN HEADER UPDATED BY MSGTEMPLATEHEADER EXT--> {$headerHTML}";
        $templates['msg_html'] = preg_replace('<!-- BEGIN HEADER -->', $newHeader, $templates['msg_html'], 1);
        civicrm_api3('MessageTemplate', 'create', [
          'id' => $templates['id'],
          'msg_html' => $templates['msg_html'],
        ]);
      }
    }
  }

}