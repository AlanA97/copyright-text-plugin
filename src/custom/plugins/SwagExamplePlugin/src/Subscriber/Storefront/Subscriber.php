<?php

namespace SwagExamplePlugin\Subscriber\Storefront;

use Shopware\Storefront\Event\StorefrontRenderEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class Subscriber implements EventSubscriberInterface
{
    /**
     * @var SystemConfigService
     */
    private $systemConfigService;

    public function __construct(SystemConfigService $systemConfigService)
    {
        $this->systemConfigService = $systemConfigService;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            StorefrontRenderEvent::class => 'onStorefrontRender',
        ];
    }

    /**
     * @param StorefrontRenderEvent $event
     */
    public function onStorefrontRender(StorefrontRenderEvent $event): void
    {
        $copyrightText = $this->systemConfigService->get('SwagExamplePlugin.config.copyrightText');
        $copyrightColor = $this->systemConfigService->get('SwagExamplePlugin.config.textColor');

        $event->setParameter('color', $copyrightColor);
        $event->setParameter('text', $copyrightText);
    }

}
