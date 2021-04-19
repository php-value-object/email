<?php

declare(strict_types=1);

namespace Tests\ValueObject\Email;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ValueObject\Email\EmailAddress;

class EmailTest extends TestCase
{

    public function testSimpleEmail()
    {
        $value = new EmailAddress('user@host');
        $this->assertSame('host', $value->getHost());
        $this->assertSame('user', $value->getUser());
        $this->assertSame('user@host', $value->getEmail());
        $this->assertNull($value->getName());
        $this->assertNull($value->getTag());
        $this->assertSame('user@host', $value->getValue());
    }

    public function testEmailWithTag()
    {
        $value = new EmailAddress('user+tag@host');
        $this->assertSame('host', $value->getHost());
        $this->assertSame('user', $value->getUser());
        $this->assertSame('user+tag@host', $value->getEmail());
        $this->assertNull($value->getName());
        $this->assertSame('tag', $value->getTag());
        $this->assertSame('user+tag@host', $value->getValue());
    }

    public function testEmailWithName()
    {
        $value = new EmailAddress('User <user@host>');
        $this->assertSame('host', $value->getHost());
        $this->assertSame('user', $value->getUser());
        $this->assertSame('user@host', $value->getEmail());
        $this->assertSame('User', $value->getName());
        $this->assertNull($value->getTag());
        $this->assertSame('User <user@host>', $value->getValue());
    }

    public function testEmailWithTagAndName()
    {
        $value = new EmailAddress('Mr. Nobody <user+tag@host>');
        $this->assertSame('host', $value->getHost());
        $this->assertSame('user', $value->getUser());
        $this->assertSame('user+tag@host', $value->getEmail());
        $this->assertSame('Mr. Nobody', $value->getName());
        $this->assertSame('tag', $value->getTag());
        $this->assertSame('"Mr. Nobody" <user+tag@host>', $value->getValue());
    }

    public function testEmailWithTagAndQuotedName()
    {
        $value = new EmailAddress('"Mr. Nobody" <user+tag@host>');
        $this->assertSame('host', $value->getHost());
        $this->assertSame('user', $value->getUser());
        $this->assertSame('user+tag@host', $value->getEmail());
        $this->assertSame('Mr. Nobody', $value->getName());
        $this->assertSame('tag', $value->getTag());
        $this->assertSame('"Mr. Nobody" <user+tag@host>', $value->getValue());
    }

    public function testThree()
    {
        $this->expectException(InvalidArgumentException::class);
        new EmailAddress('test@tag@phpunit');
    }
}
