<?php
namespace Acacia\Email\CampaignMonitor;

use Acacia\Email\CampaignMonitor\Settings;

/**
*
*/

class Contact
{

  function __construct(Settings $settings)
  {
      $this->auth = $settings->api_key();
  }

  public function form_submitted($fields)
  {

    $smart_email_id = '0ebea01c-da5a-42f9-8b4d-fb43e305e8eb';

    $wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
    $message = array(
        "To" => 'Sam Werner <samuel@acaciaministries.international>',
        "Data" => array(
            'full_name' => $fields->full_name,
            'email' => $fields->email,
            'phone' => $fields->phone,
            'body' => $fields->body,
        ),
    );

    # Send the message and save the response
    $result = $wrap->send($message);
  }

}
