<?php

namespace Behat\YiiExtension\Context;

use Behat\Behat\Context\ContextInitializerInterface,
    Behat\Behat\Context\ContextInterface;

/*
 * This file is part of the Behat\YiiExtension.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Yii aware contexts initializer.
 * Sets Yii web app instance to the YiiAware contexts.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class YiiAwareContextInitializer implements ContextInitializerInterface
{
    private $yii;

    /**
     * Initializes initializer.
     */
    public function __construct($frameworkScript, $configScript)
    {
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        require_once($frameworkScript);

        // tells Yii to not just include files, but to let other
        // autoloaders or the include path try
        \YiiBase::$enableIncludePath = false;

        // create the application and remember it
        $this->yii = \Yii::createWebApplication($configScript);
    }

    /**
     * Checks if initializer supports provided context.
     *
     * @param ContextInterface $context
     *
     * @return Boolean
     */
    public function supports(ContextInterface $context)
    {
        return $context instanceof YiiAwareContextInterface;
    }

    /**
     * Initializes provided context.
     *
     * @param ContextInterface $context
     */
    public function initialize(ContextInterface $context)
    {
        $context->setYii($this->yii);
    }
}
