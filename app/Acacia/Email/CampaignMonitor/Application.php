<?php
  namespace Acacia\Email\CampaignMonitor;

  use Acacia\Email\CampaignMonitor\Settings;

/**
 * For Application Submissions
 */
class Application
{

  function __construct(Settings $settings)
  {
      $this->auth = $settings->api_key();
  }

  public function confirm_application($name, $email)
  {

    # The unique identifier for this smart email
    $smart_email_id = 'de2a36f8-c39e-49ec-bc3b-10394a551cc5';

    # Create a new mailer and define your message
    $wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
    $message = array(
        "To" => $name.' <'.$email.'>'
    );

    # Send the message and save the response
    $result = $wrap->send($message);

  }

  public function notify_admin($application)
  {
  
  # The unique identifier for this smart email
  $smart_email_id = 'bcd844c5-0ea7-434c-a23c-1b020e8c292e';

  # Create a new mailer and define your message
  $wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
  $message = array(
      "To" => 'Sam Werner <samuel@acaciaministries.international>',
      "Data" => array(
          'application' => $application,
      ),
  );

  # Send the message and save the response
  $result = $wrap->send($message);
  }
}
