<?php
declare(strict_types=1);

namespace CleanArch\Domain\Repositories;

use CleanArch\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function find(int $id): ?User;

    public function save(User $user): bool;
}
