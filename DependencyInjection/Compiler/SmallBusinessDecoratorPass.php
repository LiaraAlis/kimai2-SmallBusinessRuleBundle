<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\DependencyInjection\Compiler;

use App\Kernel;
use KimaiPlugin\SmallBusinessRuleBundle\Invoice\Calculator\SmallBusinessCalculator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SmallBusinessDecoratorPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     * @return void
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(SmallBusinessCalculator::class)) {
            return;
        }

        $taggedServices = $container->findTaggedServiceIds(Kernel::TAG_INVOICE_CALCULATOR);

        foreach ($taggedServices as $id => $tags) {
            if ($id === SmallBusinessCalculator::class) {
                continue;
            }

            $decoratedServiceId = $this->generateAliasName($id);

            $container->register($decoratedServiceId, SmallBusinessCalculator::class)
                ->setPublic(false)
                ->setAutowired(true)
                ->setAutoconfigured(true)
                ->setDecoratedService($id);
        }
    }

    /**
     * Generate a snake_case service name from the service class name
     *
     * @param $serviceName
     * @return string
     */
    private function generateAliasName($serviceName): string
    {
        if (false !== strpos($serviceName, '\\')) {
            $parts = explode('\\', $serviceName);
            $className = end($parts);
            $alias = strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($className)));
        } else {
            $alias = $serviceName;
        }
        return $alias . '_decorator';
    }
}
