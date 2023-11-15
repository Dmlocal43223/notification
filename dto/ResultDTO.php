<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\dto;
class ResultDTO
{
    public bool $notificationEmployeeByEmail = false;
    public bool $notificationClientByEmail = false;
    public bool $notificationClientBySmsIsSent = false;
    public string $notificationClientBySmsMessage = '';
}