<?php

function unsubscribeSubscriber($email)
{
  (new \Acacia\Email\CampaignMonitor\Subscriber)->unsubscribe($email);
}

function addSubscriber($name,$email)
{
  (new \Acacia\Email\CampaignMonitor\Subscriber)->add($name,$email);
}
