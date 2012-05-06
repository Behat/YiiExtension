<?php

namespace Behat\YiiExtension\Context;

/*
 * This file is part of the Behat\YiiExtension.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Yii aware interface for contexts.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface YiiAwareContextInterface
{
    /**
     * Sets Yii web application instance.
     *
     * @param Yii $mink Yii session manager
     */
    function setYiiWebApplication(\CWebApplication $yii);
}
