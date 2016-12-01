<?php

/*
 * This file is part of the Behat\YiiExtension
 *
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Behat\YiiExtension\Context\Initializer;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use Behat\YiiExtension\Context\YiiAwareContextInterface;

/**
 * Yii aware contexts initializer.
 * Sets Yii web app instance to the YiiAware contexts.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class YiiAwareInitializer implements ContextInitializer
{
    private $yii;

    /**
     * Initializes initializer.
     */
    public function __construct($frameworkScript, $configScript, $webApplicationFactory)
    {
        defined('YII_DEBUG') or define('YII_DEBUG', true);
        require_once($frameworkScript);

        // tells Yii to not just include files, but to let other
        // autoloaders or the include path try
        \YiiBase::$enableIncludePath = false;

        // create the application and remember it
        $this->yii = $webApplicationFactory::createWebApplication($configScript);
    }

    /**
     * Initializes provided context.
     *
     * @param ContextInterface $context
     */
    public function initializeContext(Context $context)
    {
        if (!$context instanceof YiiAwareContextInterface) {
            return;
        }

        $context->setYiiWebApplication($this->yii);
    }
}
