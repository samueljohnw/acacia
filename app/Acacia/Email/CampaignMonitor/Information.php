<?php
namespace Acacia\Email\CampaignMonitor;

use Acacia\Email\CampaignMonitor\Settings;

/**
*
*/

class Information
{

  function __construct(Settings $settings)
  {
      $this->auth = $settings->api_key();
  }

  public function request($fields)
  {

    $smart_email_id = '5ff6d230-8027-4f4b-93e2-998024aa33ff';

    # Create a new mailer and define your message
    $wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
    $message = array(
        "To" => $fields->first_name.'<'.$fields->email.'>'
    );

    # Send the message and save the response
    $result = $wrap->send($message);
  }

}
