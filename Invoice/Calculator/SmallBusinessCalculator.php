<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Invoice\Calculator;

use App\Invoice\CalculatorInterface;
use App\Invoice\InvoiceItem;
use App\Invoice\InvoiceModel;
use KimaiPlugin\SmallBusinessRuleBundle\Configuration\SmallBusinessRuleConfiguration;

class SmallBusinessCalculator implements CalculatorInterface
{
    public function __construct(private CalculatorInterface $coreCalculator, private SmallBusinessRuleConfiguration $configuration)
    {
    }

    public function getVat(): float
    {
        if ($this->configuration->isSmallBusinessRule()) {
            return 0.00;
        }

        return $this->coreCalculator->getVat();
    }

    /**
     * @return InvoiceItem[]
     */
    public function getEntries(): array
    {
        return $this->coreCalculator->getEntries();
    }

    public function setModel(InvoiceModel $model): void
    {
        $this->coreCalculator->setModel($model);
    }

    public function getSubtotal(): float
    {
        return $this->coreCalculator->getSubtotal();
    }

    public function getTax(): float
    {
        if ($this->configuration->isSmallBusinessRule()) {
            return 0.00;
        }

        return $this->coreCalculator->getTax();
    }

    public function getTotal(): float
    {
        return $this->coreCalculator->getTotal();
    }

    public function getTimeWorked(): int
    {
        return $this->coreCalculator->getTimeWorked();
    }

    public function getId(): string
    {
        return $this->coreCalculator->getId();
    }
}
