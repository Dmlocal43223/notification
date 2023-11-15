<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\sender;
abstract class AbstractSender
{
    protected string $subject;
    protected string $message;
    public function __construct(string $subject, string $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }
}