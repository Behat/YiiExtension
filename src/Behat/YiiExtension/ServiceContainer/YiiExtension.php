<?php

/*
 * This file is part of the Behat\YiiExtension
 *
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Behat\YiiExtension\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Yii extension for Behat class.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class YiiExtension implements Extension
{
    public function getConfigKey()
    {
        return 'yii_extension';
    }

    /**
     * Loads a specific configuration.
     *
     * @param array            $config    Extension configuration hash (from behat.yml)
     * @param ContainerBuilder $container ContainerBuilder instance
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../services'));
        $loader->load('yii.xml');

        $basePath = $container->getParameter('paths.base');

        if (!isset($config['framework_script'])) {
            throw new \InvalidArgumentException(
                'Specify `framework_script` parameter for yii_extension.'
            );
        }
        if (file_exists($cfg = $basePath.DIRECTORY_SEPARATOR.$config['framework_script'])) {
            $config['framework_script'] = $cfg;
        }
        $container->setParameter('yii_extension.framework_script', $config['framework_script']);

        if (!isset($config['config_script'])) {
            throw new \InvalidArgumentException(
                'Specify `config_script` parameter for yii_extension.'
            );
        }
        if (file_exists($cfg = $basePath.DIRECTORY_SEPARATOR.$config['config_script'])) {
            $config['config_script'] = $cfg;
        }
        $container->setParameter('yii_extension.config_script', $config['config_script']);
    }

    /**
     * Setups configuration for current extension.
     *
     * @param ArrayNodeDefinition $builder
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $boolFilter = function ($v) {
            $filtered = filter_var($v, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
            return (null === $filtered) ? $v : $filtered;
        };

        $builder->
            children()->
                scalarNode('framework_script')->
                    isRequired()->
                end()->
                scalarNode('config_script')->
                    isRequired()->
                end()->
            end()
        ;
    }

    public function initialize(ExtensionManager $extensionManager) {}
    public function process(ContainerBuilder $container) {}
}
