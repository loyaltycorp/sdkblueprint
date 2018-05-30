<?php
declare(strict_types=1);

namespace Tests\LoyaltyCorp\SdkBlueprint\DataTransferObjects\Requests;

use LoyaltyCorp\SdkBlueprint\Sdk\Interfaces\RequestMethodInterface;
use LoyaltyCorp\SdkBlueprint\Sdk\RequestObject;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

class User extends RequestObject
{
    /**
     * @Assert\NotBlank(groups={"delete"})
     * @Groups({"delete"})
     */
    private $id;

    /**
     * @Assert\NotBlank(groups={"update","create"})
     * @Groups({"create", "update"})
     */
    private $name;

    /**
     * @Assert\NotBlank(groups={"update","create"})
     * @Groups({"create", "update"})
     */
    private $email;

    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email): self
    {
        $this->email = $email;

        return $this;
    }

    public function expectObject(): ?string
    {
        return self::class;
    }

    public function getUris(): array
    {
        return [
            RequestMethodInterface::CREATE => 'create_uri',
            RequestMethodInterface::UPDATE => 'update_uri',
            RequestMethodInterface::DELETE => 'delete_uri'
        ];
    }

    public function getOptions(): array
    {
        return [
            RequestMethodInterface::CREATE => ['name' => $this->name, 'email' => $this->email],
            RequestMethodInterface::UPDATE => ['name' => $this->name, 'email' => $this->email],
            RequestMethodInterface::DELETE => ['id' => $this->id]
        ];
    }

    public function getValidationGroups(): array
    {
        return [
            RequestMethodInterface::CREATE => [RequestMethodInterface::CREATE],
            RequestMethodInterface::UPDATE => [RequestMethodInterface::UPDATE],
            RequestMethodInterface::DELETE => [RequestMethodInterface::DELETE]
        ];
    }
}
