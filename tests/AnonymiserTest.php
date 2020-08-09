<?php declare(strict_types=1);

use EmailAddressAnonymiser\Anonymiser;
use PHPUnit\Framework\TestCase;

final class AnonymiserTest extends TestCase
{
    private Anonymiser $anonymiser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->anonymiser = new EmailAddressAnonymiser\Anonymiser();
    }

    public function testAnonymisation(): void
    {
        $this->assertEquals('a***n@gmail.com', $this->anonymiser->anonymise('admin@gmail.com'));
        $this->assertEquals('r***t@googlemail.com', $this->anonymiser->anonymise('root@googlemail.com'));
        $this->assertEquals('w***r@hotmail.co.uk', $this->anonymiser->anonymise('webmaster@hotmail.co.uk'));
        $this->assertEquals('w***r@outlook.com', $this->anonymiser->anonymise('webmaster@outlook.com'));

        $this->assertEquals('j***e@e***m', $this->anonymiser->anonymise('john.doe@example.com'));
        $this->assertEquals('n***y@b***o', $this->anonymiser->anonymise('no-reply@benyoung.io'));
        $this->assertEquals('a***a@e***g', $this->anonymiser->anonymise('a@example.org'));
        $this->assertEquals('a***b@e***g', $this->anonymiser->anonymise('ab@example.org'));
        $this->assertEquals('a***c@e***g', $this->anonymiser->anonymise('abc@example.org'));
    }
}
