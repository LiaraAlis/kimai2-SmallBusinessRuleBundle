<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\EventSubscriber;

use App\Event\InvoicePreRenderEvent;
use KimaiPlugin\SmallBusinessRuleBundle\Configuration\SmallBusinessRuleConfiguration;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class InvoicePreRenderEventSubscriber implements EventSubscriberInterface
{
    private $smallBusinessRuleConfiguration;
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

    public function onInvoicePreRenderEvent(InvoicePreRenderEvent $event)
    {
        if (!$this->smallBusinessRuleConfiguration->isSmallBusinessRule()) {
            return;
        }

        $terms = $event->getModel()->getTemplate()->getPaymentTerms();
        $text = $this->translator->trans('invoice.small_business_rule');

        if (strpos($terms, $text) !== false) {
            return;
        }

        $terms = $text . PHP_EOL . PHP_EOL . $terms;
        $event->getModel()->getTemplate()->setPaymentTerms($terms);
    }
}
