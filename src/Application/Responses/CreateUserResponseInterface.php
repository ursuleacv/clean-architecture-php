<?php
declare(strict_types=1);

namespace CleanArch\Application\Responses;

interface CreateUserResponseInterface
{
    public function getUserId(): int;

    public function getUserName(): string;

    public function getMailAddress(): string;
}
