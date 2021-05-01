<?php
declare(strict_types=1);

namespace CleanArch\Application\Repositories;

use CleanArch\Application\DataAccess\Database\GatewayInterface;
use CleanArch\Domain\Entities\User;
use CleanArch\Domain\Repositories\UserRepositoryInterface;
use CleanArch\Domain\ValueObjects\Identifier;
use CleanArch\Domain\ValueObjects\MailAddress;
use CleanArch\Domain\ValueObjects\UserName;
use CleanArch\Domain\ValueObjects\UserPassword;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var GatewayInterface
     */
    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function find(int $id): ?User
    {
        $users = $this->gateway->select('SELECT * FROM users WHERE id = ?', [$id]);

        if (isset($users[0])) {
            return new User(
                Identifier::of($users[0]['id']),
                UserName::of($users[0]['name']),
                MailAddress::of($users[0]['email']),
                UserPassword::of($users[0]['password'])
            );
        } else {
            return null;
        }
    }

    public function save(User $user): bool
    {
        return $this->gateway->insert('INSERT INTO users (name, email, password) VALUES (?, ?, ?)', [
            $user->getName(),
            $user->getMail(),
            $user->getPassword()
        ]);
    }
}
