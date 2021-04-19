<?php

declare(strict_types=1);

namespace ValueObject\Email;

interface Email
{

    public function getHost(): string;

    public function getUser(): string;

    public function getEmail(): string;

    public function getName(): ?string;

    public function getTag(): ?string;

    public function getValue(): string;
}
