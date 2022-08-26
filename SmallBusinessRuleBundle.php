<?php

namespace KimaiPlugin\SmallBusinessRuleBundle;

use App\Plugin\PluginInterface;
use KimaiPlugin\SmallBusinessRuleBundle\DependencyInjection\Compiler\SmallBusinessDecoratorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SmallBusinessRuleBundle extends Bundle implements PluginInterface
{
    /**
     * @param ContainerBuilder $container
     * @return void
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SmallBusinessDecoratorPass());
    }
}
