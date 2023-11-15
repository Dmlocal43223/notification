<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\service;

use NW\WebService\References\Operations\Notification\dto\ComplaintDTO;
use NW\WebService\References\Operations\Notification\dto\ResultDTO;
use NW\WebService\References\Operations\Notification\entity\Contractor;
use NW\WebService\References\Operations\Notification\entity\Employee;
use NW\WebService\References\Operations\Notification\entity\Reseller;
use NW\WebService\References\Operations\Notification\entity\Status;

class ReturnOperation extends AbstractOperation
{
    public const TYPE_NEW = 1;
    public const TYPE_CHANGE = 2;
    public const EVENT_GOOD_RETURN = 'goodsReturn';

    public function handle(): ResultDTO
    {
        $data = $this->getRequest();
        $resellerId = $data['resellerId'];
        $notificationType = $data['notificationType'];

        $resultDTO = new ResultDTO();

        if (!$notificationType) {
            throw new \Exception('Empty notificationType', 400);
        }

        $reseller = Reseller::getById($resellerId);
        $client = Contractor::getById($data['clientId'], $reseller);

        if ($client->getType() !== Contractor::TYPE_CUSTOMER || $client->getResellerId() !== $reseller->getId()) {
            throw new \Exception('Client not found!', 400);
        }

        if ($creator = Employee::getById($data['creatorId'])) {
            throw new \Exception('Creator not found!', 400);
        }

        if ($expert = Employee::getById((int)$data['expertId'])) {
            throw new \Exception('Expert not found!', 400);
        }

        $differences = '';
        if ($notificationType === self::TYPE_NEW) {
            $differences = $this->getDifference(self::TYPE_NEW, $data['differences'], $reseller);
        } elseif ($notificationType === self::TYPE_CHANGE && !empty($data['differences'])) {
            $differences = $this->getDifference(self::TYPE_CHANGE, $data['differences'], $reseller);
        }

        $complaintDTO = new ComplaintDTO();
        $complaintDTO->fillComplaintDTO($data, $differences, $creator, $expert, $client);
        $complaintDTO->checkEmptyField();

        $messageClient = new MessageClient($reseller, $client, $complaintDTO, MessageClient::CHANGE_RETURN_STATUS);

        if ($reseller->getEmail()) {
            foreach ($reseller->getEmailsByPermit(self::EVENT_GOOD_RETURN) as $email) {
                $resultDTO->notificationEmployeeByEmail = $messageClient->handleSend(MessageClient::MESSAGE_TYPE_EMAIL, $email);
            }
        }

        if ($notificationType === self::TYPE_CHANGE && $data['differences']['to']) {
            if (!$reseller->getEmail() && !$client->getEmail()) {
                $resultDTO->notificationClientByEmail = $messageClient->handleSend(MessageClient::MESSAGE_TYPE_EMAIL, $client->getEmail());
            }

            if ($client->getMobile()) {
                $resultDTO->notificationClientBySmsIsSent = $messageClient->handleSend(MessageClient::MESSAGE_TYPE_SMS);
            }
        }

        return $resultDTO;
    }

    private function getDifference(int $notificationType, array $dataDifferences, Reseller $reseller): string
    {
        switch ($notificationType) {
            case self::TYPE_NEW:
                return $this->getDifferenceText(self::TYPE_NEW, [], $reseller->getId());
            case self::TYPE_CHANGE:
                return $this->getDifferenceText(
                    self::TYPE_CHANGE,
                    [Status::STATUSES_NAME[$dataDifferences['from']],
                    Status::STATUSES_NAME[$dataDifferences['to']]],
                    $reseller->getId()
                );
            default:
                return '';
        }
    }

    private function getDifferenceText(int $notificationType, array $d, int $resellerId): string
    {
        // fakes the method
        return '';
    }
}