<?php

namespace Behat\YiiExtension;

use Symfony\Component\Config\FileLocator,
    Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

use Behat\Behat\Extension\Extension as BaseExtension;

/*
 * This file is part of the Behat\YiiExtension
 *
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * Yii extension for Behat class.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class Extension extends BaseExtension
{
    /**
     * Loads a specific configuration.
     *
     * @param array            $config    Extension configuration hash (from behat.yml)
     * @param ContainerBuilder $container ContainerBuilder instance
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/services'));
        $loader->load('yii.xml');
        $configPath = $container->getParameter('behat.paths.base');

        if (!isset($config['framework_script'])) {
            throw new \InvalidArgumentException(
                'Specify `framework_script` parameter for yii_extension.'
            );
        }
        if (file_exists($cfg = $configPath.DIRECTORY_SEPARATOR.$config['framework_script'])) {
            $config['framework_script'] = $cfg;
        }

        if (!isset($config['config_script'])) {
            throw new \InvalidArgumentException(
                'Specify `config_script` parameter for yii_extension.'
            );
        }
        if (file_exists($cfg = $configPath.DIRECTORY_SEPARATOR.$config['config_script'])) {
            $config['config_script'] = $cfg;
        }

        $container->setParameter('behat.yii_extension.framework_script', $config['framework_script']);
        $container->setParameter('behat.yii_extension.config_script', $config['config_script']);

        if (isset($config['mink_driver']) && $config['mink_driver']) {
            if (!class_exists('Behat\\Mink\\Driver\\BrowserKitDriver')) {
                throw new \RuntimeException(
                    'Install MinkBrowserKitDriver in order to activate wunit session.'
                );
            }
            $loader->load('sessions/wunit.xml');
        }
    }
}
