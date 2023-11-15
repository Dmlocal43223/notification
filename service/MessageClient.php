<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\service;
use NW\WebService\References\Operations\Notification\dto\ComplaintDTO;
use NW\WebService\References\Operations\Notification\entity\Contractor;
use NW\WebService\References\Operations\Notification\entity\Reseller;
use NW\WebService\References\Operations\Notification\sender\SenderFactory;

class MessageClient
{
    public const MESSAGE_TYPE_EMAIL = 'email';
    public const MESSAGE_TYPE_SMS = 'sms';
    public const CHANGE_RETURN_STATUS = 'changeReturnStatus';
    public const NEW_RETURN_STATUS    = 'newReturnStatus';

    private Reseller $reseller;
    private Contractor $contractor;
    private ContentGenerator $contentGenerator;
    public function __construct(Reseller $reseller, Contractor $contractor, ComplaintDTO $complaintDTO, string $returnStatus)
    {
        $this->reseller = $reseller;
        $this->contractor = $contractor;
        $this->contentGenerator = new ContentGenerator($complaintDTO, $returnStatus);

    }

    public function handleSend(string $messageType, ?string $emailTo = null): bool
    {
        $this->contentGenerator->generate();

        $sender = SenderFactory::get($messageType, $this->contentGenerator, $this->reseller, $emailTo, $this->contractor);

        return $sender->send();
    }
}