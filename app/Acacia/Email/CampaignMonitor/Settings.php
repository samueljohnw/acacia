<?php

namespace Acacia\Email\CampaignMonitor;

/**
* Settings for Campaign Monitir
*/
class Settings
{


    public function api_key()
    {
        return env('CAMPAIGN_MONITOR_API_KEY');
    }

}