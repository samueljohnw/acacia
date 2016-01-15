<?php
namespace Acacia\Email\CampaignMonitor;

use Acacia\Email\CampaignMonitor\Settings;

/**
*
*/

class Donations
{
    function __construct(Settings $settings)
    {
        $this->auth = $settings->api_key();
    }

    public function sendReceipt($name,$email,$amount, $date, $missionary, $last4)
    {

		# The unique identifier for this smart email
		$smart_email_id = 'dd6bcedf-87e6-4d66-9049-8c652aced8a9';

		# Create a new mailer and define your message
		$wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
		$message = array(
		    "To" => $name.' <'.$email.'>',
		    "Data" => array(
		        'name' => $name,
		        'email' => $email,
		        'amount' => $amount,
		        'date' => $date,
		        'missionary' => $missionary,
            'last4'   => $last4,
		    ),
		);

		# Send the message and save the response
		$result = $wrap->send($message);

    }

    public function invoice_failed_notification($name, $email)
    {
		# The unique identifier for this smart email
		$smart_email_id = '4adead59-b7ee-4204-b000-bae5b27f7c1c';

		# Create a new mailer and define your message
		$wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
		$message = array(
		"To" => $name.' <'.$email.'>'
		);

		# Send the message and save the response
		$result = $wrap->send($message);
    }

    public function check_request($name, $email, $user)
    {

		$smart_email_id = 'b2b49a19-2da8-4c65-a94d-2b7500415bee';

		$wrap = new \CS_REST_Transactional_SmartEmail($smart_email_id, $this->auth);
		$message = array(
		    "To" => $name.' <'.$email.'>',
        "Data" => array(
            'missionary' => $user
        ),
		);

		$result = $wrap->send($message);
    }
}
