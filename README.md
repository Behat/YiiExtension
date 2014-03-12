YiiExtension
============

Provides integration layer for the [Yii framework](http://www.yiiframework.com/):

* Additional services for Behat (`Yii`, `Sessions`, `Drivers`)
* `Behat\MinkExtension\Context\YiiAwareInterface` which provides `CWebApplication`
  instance for your contexts or subcontexts
* Additional `wunit` session (sets as default) for Mink (if MinkExtension is installed)
  for functional testing without Selenium through [wunit](http://www.yiiframework.com/extension/wunit)

between Behat 2.4+ and Yii.

Behat configuration
-------------------

``` yml
default:
  extensions:
    Behat\MinkExtension\Extension:
      default_session: wunit

    Behat\YiiExtension\Extension:
      framework_script: ../../framework/yii.php
      config_script: ../config/test.php
      mink_driver: true
```

Installation
------------

``` json
{
    "requires": {
        "behat/mink":           "1.4.*",
		"behat/mink-extension": "*",
		"behat/yii-extension":  "*"
    }
}
```

``` bash
curl http://getcomposer.org/installer | php
php composer.phar install
```

Copyright
---------

Copyright (c) 2012 Konstantin Kudryashov (ever.zet). See LICENSE for details.

Maintainers
-----------

* Konstantin Kudryashov [everzet](http://github.com/everzet) [lead developer]
* Other [awesome developers](https://github.com/Behat/MinkExtension/graphs/contributors)
