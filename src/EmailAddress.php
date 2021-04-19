<?php

declare(strict_types=1);

namespace ValueObject\Email;

use InvalidArgumentException;

final class EmailAddress implements Email
{

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $tag;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $value;

    public function __construct(string $email)
    {
        preg_match('/^(?<name>.*)(\s+)?<(?<user>\pL+)(\+(?<tag>\pL+))?@(?<host>\pL+)>$/ui', trim($email), $matches);
        if (!$matches) {
            preg_match('/^(?<user>\pL+)(\+(?<tag>\pL+))?@(?<host>\pL+)$/ui', trim($email), $matches);
        }
        if (!$matches) {
            throw new InvalidArgumentException($email . ' is not email');
        }
        $this->host = $matches['host'];
        $this->user = $matches['user'];
        if (array_key_exists('name', $matches)) {
            $name = trim($matches['name']);
            $name = trim($name, "\"");
            $this->name = $name ?: null;
        }
        $this->tag = $matches['tag'] ?: null;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getEmail(): string
    {
        if (!$this->email) {
            $user = $this->getUser();
            $host = $this->getHost();
            $tag = $this->getTag();
            if ($tag) {
                $user .= '+' . $tag;
            }
            $this->email = $user .  '@' . $host;
        }
        return $this->email;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function getValue(): string
    {
        if (!$this->value) {
            $email = $this->getEmail();
            $name = $this->getName();
            if ($name && preg_match('/[^a-z0-9\s]/ui', $name)) {
                $name = '"' . $name . '"';
            }
            $this->value = $name ? $name . ' <' . $email . '>' : $email;
        }
        return $this->value;
    }
}
