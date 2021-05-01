<?php
declare(strict_types=1);

namespace CleanArch\Application\UseCases;

use CleanArch\Application\DataAccess\Database\GatewayInterface;
use CleanArch\Application\Exceptions\SaveEntityException;
use CleanArch\Application\Repositories\UserRepository;
use CleanArch\Domain\Repositories\UserRepositoryInterface;
use CleanArch\Application\Requests\CreateUserRequestInterface;
use CleanArch\Application\Requests\GetUserRequestInterface;
use CleanArch\Application\Responses\CreateUserResponse;
use CleanArch\Application\Responses\GetUserResponse;
use CleanArch\Application\Responses\GetUserResponseInterface;
use CleanArch\Domain\Entities\User;
use CleanArch\Domain\ValueObjects\Identifier;
use CleanArch\Domain\ValueObjects\MailAddress;
use CleanArch\Domain\ValueObjects\UserName;
use CleanArch\Domain\ValueObjects\UserPassword;

class CreateUserInteractor
{
    /**
     * @var GatewayInterface
     */
    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function handle(CreateUserRequestInterface $request): GetUserResponseInterface
    {
        $repository = new UserRepository($this->gateway);
        $entity = new User(
            null,
            UserName::of($request->getUserName()),
            MailAddress::of($request->getMailAddress()),
            UserPassword::of($request->getPassword())
        );
        if (!$repository->save($entity)) {
            throw new SaveEntityException();
        }

        return new CreateUserResponse($entity);
    }
}
