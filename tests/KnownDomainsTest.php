<?php declare(strict_types=1);

use EmailAddressAnonymiser\KnownDomains;
use PHPUnit\Framework\TestCase;

final class KnownDomainsTest extends TestCase
{
    private KnownDomains $knownDomains;

    protected function setUp(): void
    {
        parent::setUp();

        $this->knownDomains = new EmailAddressAnonymiser\KnownDomains();
    }

    public function testKnownDomains(): void
    {
        $this->assertTrue($this->knownDomains->isKnown('gmail.com'));
        $this->assertTrue($this->knownDomains->isKnown('googlemail.com'));
        $this->assertTrue($this->knownDomains->isKnown('hotmail.co.uk'));
        $this->assertTrue($this->knownDomains->isKnown('outlook.com'));

        $this->assertFalse($this->knownDomains->isKnown('example.com'));
        $this->assertFalse($this->knownDomains->isKnown('benyoung.io'));
        $this->assertFalse($this->knownDomains->isKnown('foobar'));
    }
}
