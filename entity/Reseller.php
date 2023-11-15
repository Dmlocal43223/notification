<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\entity;
class Reseller extends User
{
    public static function getById(?int $id): static
    {
        $reseller = parent::getByid($id);

        if (!$reseller) {
            throw new \Exception('Reseller not found!', 400);
        }

        return $reseller;
    }

    public function getEmailsByPermit(string $event): array
    {
        return ['someemeil@example.com', 'someemeil2@example.com'];
    }
}