<?php

/*
 * This file is part of the Behat\YiiExtension
 *
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (file_exists('yii_extension.phar')) {
    unlink('yii_extension.phar');
}

$phar = new \Phar('yii_extension.phar', 0, 'extension.phar');
$phar->setSignatureAlgorithm(\Phar::SHA1);
$phar->startBuffering();

addFileToPhar($phar, 'src/Behat/YiiExtension/Context/YiiAwareContextInterface.php');
addFileToPhar($phar, 'src/Behat/YiiExtension/Context/YiiAwareContextInitializer.php');
addFileToPhar($phar, 'src/Behat/YiiExtension/Extension.php');
addFileToPhar($phar, 'src/Behat/YiiExtension/services/yii.xml');
addFileToPhar($phar, 'init.php');

$phar->setStub(<<<STUB
<?php

/*
 * This file is part of the Behat\YiiExtension
 *
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

Phar::mapPhar('extension.phar');

return require 'phar://extension.phar/init.php';

__HALT_COMPILER();
STUB
);
$phar->stopBuffering();

function addFileToPhar($phar, $path) {
    $phar->addFromString($path, file_get_contents(__DIR__.'/'.$path));
}
