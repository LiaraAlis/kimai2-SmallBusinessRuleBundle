<?php

namespace KimaiPlugin\SmallBusinessRuleBundle\DependencyInjection;

use App\Plugin\AbstractPluginExtension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class SmallBusinessRuleExtension extends AbstractPluginExtension implements PrependExtensionInterface
{
    /**
     * @param array $configs
     * @param ContainerBuilder $container
     * @return void
     * @throws \Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $this->registerBundleConfiguration($container, $config);

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__ . '/../Resources/config')
        );

        $loader->load('services.yaml');
    }

    /**
     * @param ContainerBuilder $container
     * @return void
     */
    public function prepend(ContainerBuilder $container): void
    {
        // Add new directory for invoice templates
        $container->prependExtensionConfig('kimai', [
            'invoice' => [
                'documents' => [
                    'var/plugins/SmallBusinessRuleBundle/Resources/views/invoices/'
                ],
            ],
        ]);
    }
}
