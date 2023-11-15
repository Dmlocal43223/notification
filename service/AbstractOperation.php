<?php

declare(strict_types=1);

namespace NW\WebService\References\Operations\Notification\service;

use NW\WebService\References\Operations\Notification\dto\ResultDTO;

abstract class AbstractOperation
{
    private array $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    abstract public function handle(): ResultDTO;

    protected function getRequest(): array
    {
        return $this->request['data'];
    }
}
