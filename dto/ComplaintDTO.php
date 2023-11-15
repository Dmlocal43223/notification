<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\dto;

use NW\WebService\References\Operations\Notification\entity\Contractor;
use NW\WebService\References\Operations\Notification\entity\Employee;

class ComplaintDTO
{
    public ?int $complaintId = null;
    public ?string $complaintNumber = null;
    public ?int $creatorId = null;
    public ?string $creatorName = null;
    public ?int $expertId = null;
    public ?string $expertName = null;
    public ?int $clientId = null;
    public ?string $clientName = null;
    public ?int $consumptionId = null;
    public ?string $consumptionNumber = null;
    public ?string $agreementNumber = null;
    public ?string $date = null;
    public ?string $differences = null;

    public function fillComplaintDTO(array $data, string $differences, Employee $creator, Employee $expert, Contractor $client): void
    {
        $this->complaintId = $data['complaintId'];
        $this->complaintNumber = $data['complaintNumber'];
        $this->creatorId = $data['creatorId'];
        $this->creatorName = $creator->getFullName();
        $this->expertId = $data['expertId'];
        $this->expertName = $expert->getFullName();
        $this->clientId = $data['clientId'];
        $this->clientName = $client->getFullName();
        $this->consumptionId = $data['consumptionId'];
        $this->consumptionNumber = $data['consumptionNumber'];
        $this->agreementNumber = $data['agreementNumber'];
        $this->date = $data['date'];
        $this->differences = $differences;
    }

    public function checkEmptyField(): void
    {
        foreach ($this as $field) {
            if (!$field) {
                throw new \Exception("Template Data ({$field}) is empty!", 500);
            }
        }
    }
}