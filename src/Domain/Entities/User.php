<?php
declare(strict_types=1);

namespace CleanArch\Domain\Entities;

use CleanArch\Domain\ValueObjects\Identifier;
use CleanArch\Domain\ValueObjects\MailAddress;
use CleanArch\Domain\ValueObjects\UserName;
use CleanArch\Domain\ValueObjects\UserPassword;

class User
{
    /**
     * @var Identifier
     */
    private $id;
    /**
     * @var UserName
     */
    private $name;
    /**
     * @var MailAddress
     */
    private $mail;
    /**
     * @var UserPassword
     */
    private $password;

    public function __construct(Identifier $id = null, UserName $name, MailAddress $mail, UserPassword $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->mail = $mail;
        $this->password = $password;
    }

    /**
     * @return Identifier
     */
    public function getId(): Identifier
    {
        return $this->id;
    }

    /**
     * @return UserName
     */
    public function getName(): UserName
    {
        return $this->name;
    }

    /**
     * @return MailAddress
     */
    public function getMail(): MailAddress
    {
        return $this->mail;
    }

    /**
     * @return UserPassword
     */
    public function getPassword(): UserPassword
    {
        return $this->password;
    }
}
