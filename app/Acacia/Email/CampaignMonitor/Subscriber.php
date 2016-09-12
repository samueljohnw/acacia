<?php
namespace Acacia\Email\CampaignMonitor;

use Acacia\Email\CampaignMonitor\Settings;

class Subscriber
{

  function __construct()
  {
    $this->auth = (new Settings)->api_key();
  }

  public function add($name, $email)
  {
    $wrap = new \CS_REST_Subscribers('c8b0603b52047efd3953757f95a986dd', $this->auth);
    $result = $wrap->add(array(
        'EmailAddress' => $email,
        'Name' => $name,
        'Resubscribe' => true,
      ));
  }

  public function delete($email)
  {
    $wrap = new \CS_REST_Subscribers('c8b0603b52047efd3953757f95a986dd', $this->auth);
    $result = $wrap->delete($email);
  }
}
