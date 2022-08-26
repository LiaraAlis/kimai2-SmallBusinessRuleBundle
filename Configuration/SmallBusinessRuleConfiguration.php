<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Configuration;

use App\Configuration\SystemConfiguration;

class SmallBusinessRuleConfiguration
{
    /**
     * @var SystemConfiguration
     */
    private $configuration;

    /**
     * @param SystemConfiguration $configuration
     */
    public function __construct(SystemConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return bool
     */
    public function isSmallBusinessRule(): bool
    {
        return (bool)$this->configuration->find('small_business_rule.enable');
    }
}
