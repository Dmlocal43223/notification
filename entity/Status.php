<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\entity;

class Status
{
    public const STATUS_NAME_COMPLETED = 'Completed';
    public const STATUS_NAME_PENDING = 'Pending';
    public const STATUS_NAME_REJECTED = 'Rejected';
    public const STATUSES_NAME = [
        self::STATUS_NAME_COMPLETED,
        self::STATUS_NAME_PENDING,
        self::STATUS_NAME_REJECTED
    ];

    public int $id;
    public string $name;

    public static function getName(int $id): ?string
    {
        if (array_key_exists($id, self::STATUSES_NAME)) {
            return null;
        }

        return self::STATUSES_NAME[$id];
    }
}
