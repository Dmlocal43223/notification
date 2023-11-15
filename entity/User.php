<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\entity;
class User
{
    private int $id;
    private int $type;
    private string $name;
    private string $email = 'contractor@example.com';

    public function __construct(int $id, int $type, string $name)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
    }

    public static function getById(?int $id): static
    {
        if (!$id) {
            throw new \Exception('Empty user id', 400);
        }

        return new static($id, 0, 'mockName'); // fakes the getById method
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getFullName(): string
    {
        return "$this->name $this->id";
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}