twitter-oauth-test
==================

TwitterでOAuthして、AccessTokenとSecretもらうサンプル

## HOW TO USE

```bash
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
$ cp config.sample.php config.php
$ vim config.php
```

config.php
```php
<?php

define('CONSUMER_KEY',    '');
define('CONSUMER_SECRET', '');
```

Enter Consumer key & secret.


Access to http://example.com/hogehoge/oauth-test.php
