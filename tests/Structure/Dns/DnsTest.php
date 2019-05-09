<?php

use PHPUnit\Framework\TestCase;

final class DnsTest extends TestCase
{

    /**
     * Test the logic that is contained withing structures
     */

    public function testAbstractDnsRecord() {

        // test constructor
        $r = new \TomCan\CombellApi\Structure\Dns\AbstractDnsRecord('test-123', 'A', 'example.com', 123);
        $this->assertEquals('A', $r->getType());
        $this->assertEquals('test-123', $r->getId());
        $this->assertEquals('example.com', $r->getHostname());
        $this->assertEquals(123, $r->getTtl());

        // test object
        $o = $r->getObject();
        $this->doStandardObjectTests($r, $o);
    }

    /** @dataProvider dataHostnameValues */
    public function testAbstractDnsRecordHostnameValidation($value, $isValid) {

        if (!$isValid) $this->expectException(\InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\AbstractDnsRecord('test-123', 'A', $value, 3600);

        $this->assertTrue($isValid);

    }

    /** @dataProvider dataUInt32Values */
    public function testAbstractDnsRecordTTLValidation($value, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\AbstractDnsRecord('test-123', 'A', 'example.com', $value);

        $this->assertTrue($isValid);

    }

    public function testDNSAAAARecord() {

        // test constructor
        $r = new \TomCan\CombellApi\Structure\Dns\DnsAAAARecord('test-123', 'example.com', 123, '::1');
        $this->assertEquals('AAAA', $r->getType());
        $this->assertEquals('test-123', $r->getId());
        $this->assertEquals('example.com', $r->getHostname());
        $this->assertEquals(123, $r->getTtl());
        $this->assertEquals('::1', $r->getContent());

        // test object
        $o = $r->getObject();
        $this->doStandardObjectTests($r, $o);
        $this->assertObjectHasAttribute('content', $o);
        $this->assertEquals($r->getContent(), $o->content);
    }

    /** @dataProvider dataIpv6Values */
    public function testDNSAAAARecordContentValidation($address, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsAAAARecord('test-123', 'example.com', 123, $address);

        $this->assertTrue($isValid);

    }

    public function testDNSARecord() {

        // test constructor
        $r = new \TomCan\CombellApi\Structure\Dns\DnsARecord('test-123', 'example.com', 123, '127.0.0.1');
        $this->assertEquals('A', $r->getType());
        $this->assertEquals('test-123', $r->getId());
        $this->assertEquals('example.com', $r->getHostname());
        $this->assertEquals(123, $r->getTtl());
        $this->assertEquals('127.0.0.1', $r->getContent());

        // test object
        $o = $r->getObject();
        $this->doStandardObjectTests($r, $o);
        $this->assertObjectHasAttribute('content', $o);
        $this->assertEquals($r->getContent(), $o->content);
    }

    /** @dataProvider dataIpv4Values */
    public function testDNSARecordContentValidation($address, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsARecord('test-123', 'example.com', 123, $address);

        $this->assertTrue($isValid);

    }


    public function testDNSCNAMERecord() {

        // test constructor
        $r = new \TomCan\CombellApi\Structure\Dns\DnsCNAMERecord('test-123', 'example.com', 123, 'valid.example.com');
        $this->assertEquals('CNAME', $r->getType());
        $this->assertEquals('test-123', $r->getId());
        $this->assertEquals('example.com', $r->getHostname());
        $this->assertEquals(123, $r->getTtl());
        $this->assertEquals('valid.example.com', $r->getContent());

        // test object
        $o = $r->getObject();
        $this->doStandardObjectTests($r, $o);
        $this->assertObjectHasAttribute('content', $o);
        $this->assertEquals($r->getContent(), $o->content);
    }

    /** @dataProvider dataHostnameValues */
    public function testDNSCNAMERecordContentValidation($address, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsCNAMERecord('test-123', 'example.com', 123, $address);
        $this->assertTrue($isValid);
    }

    public function testMXRecord() {

        // test constructor
        $r = new \TomCan\CombellApi\Structure\Dns\DnsMXRecord('test-123', 'example.com', 123, 'mail.example.com', 5);
        $this->assertEquals('MX', $r->getType());
        $this->assertEquals('test-123', $r->getId());
        $this->assertEquals('example.com', $r->getHostname());
        $this->assertEquals(123, $r->getTtl());
        $this->assertEquals('mail.example.com', $r->getContent());
        $this->assertEquals(5, $r->getPriority());

        // test object
        $o = $r->getObject();
        $this->doStandardObjectTests($r, $o);
        $this->assertObjectHasAttribute('content', $o);
        $this->assertEquals($r->getContent(), $o->content);
        $this->assertObjectHasAttribute('priority', $o);
        $this->assertEquals($r->getPriority(), $o->priority);
    }

    /** @dataProvider dataHostnameValues */
    public function testDnsMXRecordContentValidation($address, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsMXRecord('test-123', 'example.com', 123, $address, 10);

        $this->assertTrue($isValid);
    }

    //** @dataProvider dataUInt16Values */
    /*
        public function testDNSMXRecordPriorityValidation($value, $isValid) {

            if (!$isValid) $this->expectException(InvalidArgumentException::class);
            $r = new \TomCan\CombellApi\Structure\Dns\DnsMXRecord('test-123', 'example.com', 123, 'mail.example.com', $value);

            $this->assertTrue($isValid);

        }
    */

    public function testSOARecord() {

        // test constructor
        $r = new \TomCan\CombellApi\Structure\Dns\DnsSOARecord('test-123', 'example.com', 123, 'ns1.example.com hostmaster.example.com 123 456 789 012');
        $this->assertEquals('SOA', $r->getType());
        $this->assertEquals('test-123', $r->getId());
        $this->assertEquals('example.com', $r->getHostname());
        $this->assertEquals(123, $r->getTtl());
        $this->assertEquals('ns1.example.com hostmaster.example.com 123 456 789 012', $r->getContent());

        // test object
        $o = $r->getObject();
        $this->doStandardObjectTests($r, $o);
        $this->assertObjectHasAttribute('content', $o);
        $this->assertEquals($r->getContent(), $o->content);
    }

//    /** @dataProvider dataHostnameValues */
/*
    public function testSOARecordMasterValidation($value, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsSOARecord('test-123', 'example.com', 123, 'ns1.example.com dnsmaster.example.com 123 456 789 012');
        $r->setMaster($value);

        $this->assertTrue($isValid);

    }
*/
//    /** @dataProvider dataHostnameValues */
/*
    public function testSOARecordResponsibleValidation($value, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsSOARecord('test-123', 'example.com', 123, 'ns1.example.com dnsmaster.example.com 123 456 789 012');
        $r->setResponsible($value);

        $this->assertTrue($isValid);

    }
*/

//    /** @dataProvider dataUInt32Values */
/*
    public function testSOARecordSerialValidation($value, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsSOARecord('test-123', 'example.com', 123, 'ns1.example.com dnsmaster.example.com 123 456 789 012');
        $r->setSerial($value);

        $this->assertTrue($isValid);

    }
*/
//    /** @dataProvider dataUInt32Values */
/*
    public function testSOARecordRefreshValidation($value, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsSOARecord('test-123', 'example.com', 123, 'ns1.example.com dnsmaster.example.com 123 456 789 012');
        $r->setRefresh($value);

        $this->assertTrue($isValid);

    }
*/
//    /** @dataProvider dataUInt32Values */
/*
    public function testSOARecordRetryValidation($value, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsSOARecord('test-123', 'example.com', 123, 'ns1.example.com dnsmaster.example.com 123 456 789 012');
        $r->setRetry($value);

        $this->assertTrue($isValid);

    }
*/
//    /** @dataProvider dataUInt32Values */
/*
    public function testSOARecordExpireValidation($value, $isValid) {

        if (!$isValid) $this->expectException(InvalidArgumentException::class);
        $r = new \TomCan\CombellApi\Structure\Dns\DnsSOARecord('test-123', 'example.com', 123, 'ns1.example.com dnsmaster.example.com 123 456 789 012');
        $r->setExpire($value);

        $this->assertTrue($isValid);

    }
*/

    private function doStandardObjectTests(\TomCan\CombellApi\Structure\Dns\AbstractDnsRecord $record, stdClass $object): void
    {
        // check if attributes exist
        $this->assertObjectHasAttribute('id', $object);
        $this->assertObjectHasAttribute('record_name', $object);
        $this->assertObjectHasAttribute('type', $object);
        $this->assertObjectHasAttribute('ttl', $object);

        // check if attribute values equal record values
        $this->assertEquals($record->getId(), $object->id);
        $this->assertEquals($record->getHostname(), $object->record_name);
        $this->assertEquals($record->getType(), $object->type);
        $this->assertEquals($record->getTtl(), $object->ttl);
    }

    public function dataIpv4Values() {
        return [
            ['', false],
            ['127.0.0.1', true],
            ['127.0.0.256', false],
            ['0.0.0.0', true],
            ['::1', false],
            ['banana', false],
        ];
    }

    public function dataIpv6Values() {
        return [
            ['', false],
            ['::', true],
            ['::1', true],
            ['2001:0db8:85a3:0000:0000:8a2e:0370:7334', true],
            ['2001:0db8:85a3::8a2e:0370:7334', true],
            ['127.0.0.1', false],
            ['banana', false],
        ];
    }

    public function dataHostnameValues() {
        return [
            ['', true],
            ['@', true],
            ['example', true],
            ['example.com', true],
            ['example.com ', false],
            [' example.com', false],
            ['127.0.0.1', true],
            ['2001:0db8:85a3:0000:0000:8a2e:0370:7334', false],
            ['yellow-banana.example.com', true],
            ['brown_banana.example.com', false],
            ['_banana.example.com', true],
            ['__banana.example.com', false],
            ['-banana.example.com', false],
        ];
    }

    public function dataUInt16Values() {
        return [
            [0, true],
            [-1, false],
            [65535, true],
            [65536, false],
        ];
    }

    public function dataUInt32Values() {
        return [
            [0, true],
            [-1, false],
            [2147483647, true],
            [2147483648, false],
        ];
    }

}
 
