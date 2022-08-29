<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\Form\Extension;

use App\Entity\InvoiceTemplate;
use App\Form\InvoiceTemplateForm;
use KimaiPlugin\SmallBusinessRuleBundle\Configuration\SmallBusinessRuleConfiguration;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class InvoiceTemplateFormExtension extends AbstractTypeExtension
{
    /**
     * @var SmallBusinessRuleConfiguration
     */
    private $configuration;

    /**
     * @param SmallBusinessRuleConfiguration $configuration
     */
    public function __construct(SmallBusinessRuleConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return iterable
     */
    public static function getExtendedTypes(): iterable
    {
        return [InvoiceTemplateForm::class];
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if (!$this->configuration->isSmallBusinessRule()) {
            return;
        }

        /** @var InvoiceTemplate $data */
        $data = $options['data'];
        $data->setVat(0.00);

        $builder->get('vat')
            ->setDisabled(true);
    }
}
