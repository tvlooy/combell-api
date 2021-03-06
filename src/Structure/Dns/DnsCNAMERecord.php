<?php

namespace TomCan\CombellApi\Structure\Dns;

class DnsCNAMERecord extends AbstractDnsRecord
{
    private $content;

    public function __construct(string $id = '', string $hostname = '', int $ttl = 3600, string $content = '')
    {
        parent::__construct($id, 'CNAME', $hostname, $ttl);
        $this->setContent($content);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    private function setContent(string $content): void
    {
        try {
            $filtered = $this->validateHostname($content);
            $this->content = $filtered;
        } catch (\Exception $exception) {
            throw new \InvalidArgumentException('Invalid value for content: "'.$content.'"');
        }
    }

    public function getObject(): \stdClass
    {
        $obj = parent::getObject();
        $obj->content = $this->getContent();

        return $obj;
    }
}
