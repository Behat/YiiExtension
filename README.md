YiiExtension
============

Provides integration layer for the [Yii framework](http://www.yiiframework.com/):

* Additional services for Behat (`Yii`, `Sessions`, `Drivers`)
* `Behat\YiiExtension\Context\YiiAwareContextInterface` which provides `CWebApplication`
  instance for your contexts

between Behat 3.2+ and Yii 1.0+.


Behat configuration
-------------------

```yml
default:
  suites:
    default:
      contexts:
          - Behat\YiiExtension\Context\YiiContext

   extensions:
    Behat\YiiExtension:
      framework_script: ../../framework/yii.php
      config_script: ../config/test.php
```

Installation
------------

```json
{
    "require-dev": {
		    "behat/mink-extension": "^2.2",
		    "behat/yii-extension":  "~2.0"
    }
}
```

```bash
$ composer update 'behat/mink-extension' 'behat/yii-extension'
```

Copyright
---------

Copyright (c) 2012 Konstantin Kudryashov (ever.zet). See LICENSE for details.

Maintainers
-----------

* Konstantin Kudryashov [everzet](http://github.com/everzet) [lead developer]
* Other [awesome developers](https://github.com/Behat/YiiExtension/graphs/contributors)
