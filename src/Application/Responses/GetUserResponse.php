<?php
declare(strict_types=1);

namespace CleanArch\Application\Responses;

use CleanArch\Domain\Entities\User;

class GetUserResponse implements GetUserResponseInterface
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserId(): int
    {
        return $this->user->getId()->asInt();
    }

    public function getUserName(): string
    {
        return $this->user->getName()->asString();
    }

    public function getMailAddress(): string
    {
        return $this->user->getMail()->asString();
    }
}
