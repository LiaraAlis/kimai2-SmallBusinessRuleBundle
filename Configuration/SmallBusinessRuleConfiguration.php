<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Configuration;

use App\Configuration\SystemConfiguration;

class SmallBusinessRuleConfiguration
{
    private $configuration;

    public function __construct(SystemConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function isSmallBusinessRule(): bool
    {
        return (bool)$this->configuration->find('small_business_rule.enable');
    }
}
