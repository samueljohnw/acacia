<?php

namespace Acacia\Email;

use Acacia\Email\CampaignMonitor\Passwords;
use Acacia\Email\CampaignMonitor\Donations;
use Acacia\Email\CampaignMonitor\Contact;
use Acacia\Email\CampaignMonitor\Information;
use Acacia\Email\CampaignMonitor\Application;

/**
* For Handling Transactional Emails
*/

class Transactional
{

    function __construct(Passwords $password, Donations $donation, Contact $contact, Information $information, Application $application)
    {

        $this->application = $application;
        $this->password = $password;
        $this->donation = $donation;
        $this->contact = $contact;
        $this->information = $information;
    }

    public function sendResetRequest($name, $email)
    {
        return $this->password->request($name,$email);
    }

    public function sendResetLink($name,$email,$reset_link)
    {
        return $this->password->reset($name,$email,$reset_link);
    }

    public function sendReceipt($name, $email, $amount, $date, $missionary, $last4)
    {
        $this->donation->sendReceipt($name, $email, $amount, $date, $missionary, $last4);
    }

    public function invoice_failed($name, $email)
    {
        $this->donation->invoice_failed_notification($name, $email);
    }
    public function check_request($name,$email,$user)
    {
        $this->donation->check_request($name, $email, $user);
    }
    public function contact_form($fields)
    {
        $this->contact->form_submitted($fields);
    }
    public function more_info($fields)
    {
        $this->information->request($fields);
    }
    public function confirm_application($name, $email, $application)
    {
      $app = '';
      foreach($application as $applicant => $value)
      {
        $app .= '<b>'.str_replace("_"," ",$applicant).'</b> - '.$value.'<br/>';
      }
      $this->notify_admin($app);
      $this->application->confirm_application($name, $email);
    }
    public function notify_admin($application)
    {
      $this->application->notify_admin($application);
    }
}
