<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\sender;
class MailSender extends AbstractSender
{
    private string $resellerEmail;
    private string $emailTo;
    public function __construct(string $subject, string $message, string $resellerEmail, string $emailTo)
    {
        parent::__construct($subject, $message);
        $this->resellerEmail = $resellerEmail;
        $this->emailTo = $emailTo;
    }
    public function send(): bool
    {
        // fakes the method
        return true;
    }
}