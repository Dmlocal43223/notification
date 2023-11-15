<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\sender;
use NW\WebService\References\Operations\Notification\entity\Contractor;
use NW\WebService\References\Operations\Notification\entity\Reseller;
use NW\WebService\References\Operations\Notification\service\ContentGenerator;
use NW\WebService\References\Operations\Notification\service\MessageClient;

class SenderFactory
{
    public static function get(
        string $messageType,
        ContentGenerator $contentGenerator,
        Reseller $reseller,
        string $emailTo,
        Contractor $contractor
    ): AbstractSender
    {
        switch ($messageType) {
            case MessageClient::MESSAGE_TYPE_SMS:
                return new SmsSender(
                    $contentGenerator->getSubject(),
                    $contentGenerator->getMessage(),
                    $contractor->getMobile()
                );
            default:
                return new MailSender(
                    $contentGenerator->getSubject(),
                    $contentGenerator->getMessage(),
                    $reseller->getEmail(),
                    $emailTo
                );
        }
    }
}