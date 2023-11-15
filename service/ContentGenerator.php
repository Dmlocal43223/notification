<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\service;
use NW\WebService\References\Operations\Notification\dto\ComplaintDTO;

class ContentGenerator
{
    private ComplaintDTO $complaintDTO;
    private string $returnStatus;
    public function __construct(ComplaintDTO $complaintDTO, string $returnStatus)
    {
        $this->complaintDTO = $complaintDTO;
        $this->returnStatus = $returnStatus;
    }

    public function generate(): void
    {
        // fakes the method
    }

    public function getSubject(): string
    {
        // fakes the method
        return '';
    }

    public function getMessage(): string
    {
        // fakes the method
        return '';
    }
}