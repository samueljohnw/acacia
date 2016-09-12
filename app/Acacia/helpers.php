<?php

function deleteSubscriber($email)
{
  (new \Acacia\Email\CampaignMonitor\Subscriber)->delete($email);
}

function addSubscriber($name,$email)
{
  (new \Acacia\Email\CampaignMonitor\Subscriber)->add($name,$email);
}
