<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Configuration;

use App\Configuration\SystemConfiguration;

class SmallBusinessRuleConfiguration
{
    public function __construct(private SystemConfiguration $configuration)
    {
    }

    public function isSmallBusinessRule(): bool
    {
        return (bool)$this->configuration->find('small_business_rule.enable');
    }
}
