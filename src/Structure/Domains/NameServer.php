<?php

namespace TomCan\CombellApi\Structure\Domains;

class NameServer
{
    private $domainName;
    private $ip;

    public function __construct(string $domainName, string $ip)
    {
        $this->domainName = $domainName;
        $this->ip = $ip;
    }

    public function getDomainName(): string
    {
        return $this->domainName;
    }

    public function getIp(): string
    {
        return $this->ip;
    }
}
