<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Invoice\Calculator;

use App\Invoice\CalculatorInterface;
use App\Invoice\InvoiceModel;
use KimaiPlugin\SmallBusinessRuleBundle\Configuration\SmallBusinessRuleConfiguration;

class SmallBusinessCalculator implements CalculatorInterface
{
    /**
     * @var CalculatorInterface
     */
    private $coreCalculator;

    /**
     * @var SmallBusinessRuleConfiguration
     */
    private $configuration;

    /**
     * @param CalculatorInterface $coreCalculator
     * @param SmallBusinessRuleConfiguration $configuration
     */
    public function __construct(CalculatorInterface $coreCalculator, SmallBusinessRuleConfiguration $configuration)
    {
        $this->coreCalculator = $coreCalculator;
        $this->configuration = $configuration;
    }

    /**
     * @return float|null
     */
    public function getVat(): ?float
    {
        if ($this->configuration->isSmallBusinessRule()) {
            return 0.00;
        }

        return $this->coreCalculator->getVat();
    }

    /**
     * @return \App\Invoice\InvoiceItem[]
     */
    public function getEntries(): array
    {
        return $this->coreCalculator->getEntries();
    }

    /**
     * @param InvoiceModel $model
     * @return void
     */
    public function setModel(InvoiceModel $model): void
    {
        $this->coreCalculator->setModel($model);
    }

    /**
     * @return float
     */
    public function getSubtotal(): float
    {
        return $this->coreCalculator->getSubtotal();
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
     * @return float
     */
    public function getTotal(): float
    {
        return $this->coreCalculator->getTotal();
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->coreCalculator->getCurrency();
    }

    /**
     * @return int
     */
    public function getTimeWorked(): int
    {
        return $this->coreCalculator->getTimeWorked();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->coreCalculator->getId();
    }
}
