<?php
declare(strict_types=1);

namespace CleanArch\Application\Requests;

interface GetUserRequestInterface
{
    public function getIdentifier(): int;
}
