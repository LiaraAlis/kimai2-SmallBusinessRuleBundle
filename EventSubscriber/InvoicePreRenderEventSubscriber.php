<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\EventSubscriber;

use App\Event\InvoicePreRenderEvent;
use App\Invoice\InvoiceModel;
use KimaiPlugin\SmallBusinessRuleBundle\Configuration\SmallBusinessRuleConfiguration;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class InvoicePreRenderEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var SmallBusinessRuleConfiguration
     */
    private $smallBusinessRuleConfiguration;
    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(SmallBusinessRuleConfiguration $smallBusinessRuleConfiguration, TranslatorInterface $translator)
    {
        $this->smallBusinessRuleConfiguration = $smallBusinessRuleConfiguration;
        $this->translator = $translator;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            InvoicePreRenderEvent::class => ['onInvoicePreRenderEvent', 100],
        ];
    }

    public function onInvoicePreRenderEvent(InvoicePreRenderEvent $event): void
    {
        if (!$this->smallBusinessRuleConfiguration->isSmallBusinessRule()) {
            return;
        }

        $model = $event->getModel();
        $this->setModelPaymentTerms($model);
        $model->setHideZeroTax(true);
    }

    /**
     * Adds a note about the small business rule to the model payment terms.
     *
     * @param InvoiceModel $model
     * @return void
     */
    private function setModelPaymentTerms(InvoiceModel $model): void
    {
        $terms = $model->getTemplate()->getPaymentTerms();
        $text = $this->translator->trans('invoice.small_business_rule');

        if (strpos($terms, $text) !== false) {
            return;
        }

        $terms = $text . PHP_EOL . PHP_EOL . $terms;
        $model->getTemplate()->setPaymentTerms($terms);
    }
}
