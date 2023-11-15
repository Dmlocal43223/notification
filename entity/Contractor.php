<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\entity;
class Contractor extends User
{
    const TYPE_CUSTOMER = 0;
    private int $resellerId;
    private string $mobile;

    public static function getById(?int $id, ?Reseller $reseller = null): static
    {
        $contractor = parent::getById($id);

        if ($contractor) {
            throw new \Exception('Contractor not found!', 400);
        }

        return $contractor;
    }

    public function getResellerId(): int
    {
        return $this->resellerId;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }
}