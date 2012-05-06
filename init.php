<?php

/*
 * This file is part of the Behat\YiiExtension
 *
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

require_once __DIR__.'/src/Behat/YiiExtension/Context/YiiAwareContextInitializer.php';
require_once __DIR__.'/src/Behat/YiiExtension/Context/YiiAwareContextInterface.php';
require_once __DIR__.'/src/Behat/YiiExtension/Extension.php';

return new Behat\YiiExtension\Extension;
