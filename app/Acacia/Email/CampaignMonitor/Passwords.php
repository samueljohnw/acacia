<?php

namespace Acacia\Email\CampaignMonitor;


use Acacia\Email\CampaignMonitor\Settings;

/**
* Handling Password Related Email Transactions
*/

class Passwords
{

    function __construct(Settings $settings)
    {
        $this->auth = $settings->api_key();
    }

    public function reset($name, $email, $reset_link)
    {

        $smart_email_id = '6cd8b080-f2c7-45b5-a20a-8b8b5fc9ada3';

        $wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);

        $message = array(
            "To" => $name.' <'.$email.'>',
            "Data" => ['reset_url' => $reset_link]
        );

        $result = $wrap->send($message);
    }

    public function request($name, $email)
    {
                # The unique identifier for this smart email
        $smart_email_id = '11b2cfbe-00ec-46f9-ae50-452940f4dc31';

        # Create a new mailer and define your message
        $wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
        $message = array(
            "To" => $name.' <'.$email.'>',
            "Data" => array(
                'reset_url' => env('URL').'/password/email',
            ),
        );

        # Send the message and save the response
        $result = $wrap->send($message);
    }
}
