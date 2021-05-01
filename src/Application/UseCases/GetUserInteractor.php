<?php
declare(strict_types=1);

namespace CleanArch\Application\UseCases;

use CleanArch\Application\DataAccess\Database\GatewayInterface;
use CleanArch\Application\Exceptions\EntityNotFoundException;
use CleanArch\Application\Repositories\UserRepository;
use CleanArch\Application\Requests\GetUserRequestInterface;
use CleanArch\Application\Responses\GetUserResponse;
use CleanArch\Application\Responses\GetUserResponseInterface;
use Illuminate\Database\Connection;

class GetUserInteractor
{
    /**
     * @var GatewayInterface
     */
    private $gateway;

    public function __construct(GatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function handle(GetUserRequestInterface $request): GetUserResponseInterface
    {
        $repository = new UserRepository($this->gateway);
        if (is_null($user = $repository->find($request->getIdentifier()))) {
            throw new EntityNotFoundException();
        }

        return new GetUserResponse($user);
    }
}
