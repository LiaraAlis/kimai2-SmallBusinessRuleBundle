<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Invoice\Calculator;

use App\Invoice\Calculator\AbstractCalculator;
use App\Invoice\CalculatorInterface;
use App\Invoice\TaxRow;
use KimaiPlugin\SmallBusinessRuleBundle\Configuration\SmallBusinessRuleConfiguration;

class SmallBusinessCalculator extends AbstractCalculator implements CalculatorInterface
{

    /**
     * @var array
     */
    private array $cached = [];

    /**
     * @param CalculatorInterface $coreCalculator
     * @param SmallBusinessRuleConfiguration $configuration
     */
    public function __construct(
        private readonly CalculatorInterface $coreCalculator,
        private readonly SmallBusinessRuleConfiguration $configuration
    )
    {
    }

    /**
     * @return float
     */
    public function getVat(): float
    {
        if ($this->configuration->isSmallBusinessRule()) {
            return 0.00;
        }

        return $this->coreCalculator->getVat();
    }

    /**
     * @return array|TaxRow[]
     */
    public function getTaxRows(): array
    {
        return [];
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        if ($this->configuration->isSmallBusinessRule()) {
            return 0.00;
        }

        return $this->coreCalculator->getTax();
    }

    /**
     * @return \App\Invoice\InvoiceItem[]
     */
    public function getEntries(): array
    {
        $this->coreCalculator->setModel($this->model);
        return $this->calculateEntries();
    }

    protected function calculateEntries(): array
    {
        if (\count($this->cached) === 0) {
            $this->cached = $this->coreCalculator->calculateEntries();
        }

        return $this->cached;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->coreCalculator->getId();
    }
}
