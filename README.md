YiiExtension
============


This package is abandoned
-------------------------

This package (which was never updated for Behat v3.x) is now abandoned and will not receive further updates.
There is an in-progress PR at https://github.com/Behat/YiiExtension/pull/13 which may be useful should 
anyone wish to fork to a community extension.

---

Provides integration layer for the [Yii framework](http://www.yiiframework.com/):

* Additional services for Behat (`Yii`, `Sessions`, `Drivers`)
* `Behat\MinkExtension\Context\YiiAwareInterface` which provides `CWebApplication`
  instance for your contexts or subcontexts
* Additional `wunit` session (sets as default) for Mink (if MinkExtension is installed)
  for functional testing without Selenium through [wunit](http://www.yiiframework.com/extension/wunit)

between Behat 2.5+ and Yii.

Behat configuration
-------------------

```yml
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

```json
{
    "require-dev": {
        "behat/mink":           "~1.5",
		"behat/mink-extension": "~1.3",
		"behat/yii-extension":  "~1.0"
    }
}
```

```bash
$ composer update 'behat/mink' 'behat/mink-extension' 'behat/yii-extension'
```

Copyright
---------

Copyright (c) 2012 Konstantin Kudryashov (ever.zet). See LICENSE for details.

Maintainers
-----------

* Konstantin Kudryashov [everzet](http://github.com/everzet) [lead developer]
* Other [awesome developers](https://github.com/Behat/YiiExtension/graphs/contributors)
