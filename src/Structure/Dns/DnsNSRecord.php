<?php

namespace TomCan\CombellApi\Structure\Dns;

class DnsNSRecord extends AbstractDnsRecord
{
    private $content;

    public function __construct(string $id = '', string $hostname = '', int $ttl = 3600, string $content = '')
    {
        parent::__construct($id, 'NS', $hostname, $ttl);
        $this->setContent($content);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    private function setContent(string $content): void
    {
        $this->content = $this->validateHostname($content);
    }

    public function getObject(): \stdClass
    {
        $obj = parent::getObject();
        $obj->content = $this->getContent();

        return $obj;
    }
}
