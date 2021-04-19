[![Latest Stable Version](https://img.shields.io/packagist/v/value-object/email.svg?style=flat-square)](https://packagist.org/packages/value-object/email)
[![Total Downloads](https://img.shields.io/packagist/dt/value-object/email.svg?style=flat-square)](https://packagist.org/packages/value-object/email/stats)
[![License](https://img.shields.io/packagist/l/value-object/email.svg?style=flat-square)](https://github.com/php-value-object/email/blob/master/LICENSE)
[![PHP](https://img.shields.io/packagist/php-v/value-object/email.svg?style=flat-square)](https://php.net)

# Email

PHP email value-object.

# Install

```bash
composer require value-object/email:^1.0
```

# Using

```php
<?php

require_once('vendor/autoload.php');

$value = new ValueObject\Email\EmailAddress('tyler@fight.club');
echo $value->getHost(); // fight.club
echo $value->getUser(); // tyler
echo $value->getEmail(); // tyler@fight.club
echo $value->getValue(); // tyler@fight.club

$value = new ValueObject\Email\EmailAddress('tyler+mayhem@fight.club');
echo $value->getHost(); // fight.club
echo $value->getUser(); // tyler
echo $value->getTag(); // mayhem
echo $value->getEmail(); // tyler+mayhem@fight.club
echo $value->getValue(); // tyler+mayhem@fight.club

$value = new ValueObject\Email\EmailAddress('Tyler Durden <tyler@fight.club>');
echo $value->getHost(); // fight.club
echo $value->getUser(); // tyler
echo $value->getEmail(); // tyler@fight.club
echo $value->getName(); // Tyler Durden
echo $value->getValue(); // Tyler Durden <tyler@fight.club>

$value = new ValueObject\Email\EmailAddress('"R. Paulson" <bob@fight.club>');
echo $value->getHost(); // fight.club
echo $value->getUser(); // bob
echo $value->getEmail(); // bob@fight.club
echo $value->getName(); // R. Paulson
echo $value->getValue(); // "R. Paulson" <tyler@fight.club>

$value = new ValueObject\Email\EmailAddress('email'); // throws InvalidArgumentException
```