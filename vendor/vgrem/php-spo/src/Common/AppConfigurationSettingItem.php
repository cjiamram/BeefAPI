<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AppConfigurationSettingItem extends ClientValue
{
    /**
     * @var string
     */
    public $AppConfigKey;
    /**
     * @var string
     */
    public $AppConfigKeyValue;
}