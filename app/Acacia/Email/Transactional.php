<?php

namespace Acacia\Email;

use Acacia\Email\CampaignMonitor\Passwords;
use Acacia\Email\CampaignMonitor\Donations;


/**
* For Handling Transactional Emails
*/

class Transactional
{

    function __construct(Passwords $password, Donations $donation)
    {
        $this->password = $password;
        $this->donation = $donation;
    }

    public function sendResetRequest($name, $email)
    {
        return $this->password->request($name,$email);
    }

    public function sendResetLink($name,$email,$reset_link)
    {
        return $this->password->reset($name,$email,$reset_link);
    }

    public function sendReceipt($name, $email, $amount, $date, $missionary)
    {
        $this->donation->sendReceipt($name, $email, $amount, $date, $missionary);
    }

    public function invoice_failed($name, $email)
    {
        $this->donation->invoice_failed_notification($name, $email);
    }
    public function check_request($name,$email,$user)
    {
        $this->donation->check_request($name, $email, $user);
    }
}
