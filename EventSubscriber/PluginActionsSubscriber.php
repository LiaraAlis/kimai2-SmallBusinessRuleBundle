<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\EventSubscriber;

use App\Event\ThemeEvent;
use App\Plugin\Plugin;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

final class PluginActionsSubscriber implements EventSubscriberInterface
{
    private $router;
    private $security;

    /**
     * @param UrlGeneratorInterface $router
     * @param AuthorizationCheckerInterface $security
     */
    public function __construct(UrlGeneratorInterface $router, AuthorizationCheckerInterface $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    /**
     * @return string[][]
     */
    public static function getSubscribedEvents(): array
    {
        return [
            'actions.plugin' => ['onPluginEvent'],
        ];
    }

    /**
     * @param ThemeEvent $event
     * @return void
     */
    public function onPluginEvent(ThemeEvent $event): void
    {
        $payload = $event->getPayload();

        if (!isset($payload['actions']) || !isset($payload['plugin'])) {
            return;
        }

        /** @var Plugin $plugin */
        $plugin = $payload['plugin'];

        if ($plugin->getId() !== 'SmallBusinessRuleBundle') {
            return;
        }

        if (!$this->security->isGranted('demo')) {
            return;
        }

        $payload['actions']['divider'] = null;

        $payload['actions']['settings'] = [
            'url' => $this->router->generate('system_configuration_section', ['section' => 'small_business_rule']),
            'class' => 'modal-ajax-form',
        ];

        $event->setPayload($payload);
    }
}
