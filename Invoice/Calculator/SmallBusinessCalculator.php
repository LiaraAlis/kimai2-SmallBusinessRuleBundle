<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Invoice\Calculator;

use App\Invoice\Calculator\AbstractCalculator;
use App\Invoice\CalculatorInterface;
use App\Invoice\InvoiceModel;
use KimaiPlugin\SmallBusinessRuleBundle\Configuration\SmallBusinessRuleConfiguration;

class SmallBusinessCalculator extends AbstractCalculator implements CalculatorInterface
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
     * @param InvoiceModel $model
     * @return void
     */
    public function setModel(InvoiceModel $model): void
    {
        parent::setModel($model);

        $this->coreCalculator->setModel($model);
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
        return $this->coreCalculator->getEntries();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->coreCalculator->getId();
    }
}
