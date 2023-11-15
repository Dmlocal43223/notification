<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\sender;
class SmsSender extends AbstractSender
{
    private string $contractorMobile;
    public function __construct(string $subject, string $message, string $contractorMobile)
    {
        parent::__construct($subject, $message);
        $this->contractorMobile = $contractorMobile;
    }
    public function send(): bool
    {
        // fakes the method
        return true;
    }
}