<?php declare(strict_types=1);

use EmailAddressAnonymiser\Anonymiser;
use PHPUnit\Framework\TestCase;

final class AnonymiserTest extends TestCase
{
    use Codeception\AssertThrows;

    private Anonymiser $anonymiser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->anonymiser = new EmailAddressAnonymiser\Anonymiser();
    }

    private function anonymise(string $email): string
    {
        return $this->anonymiser->anonymise($email);
    }

    public function testAnonymisation(): void
    {
        $this->assertEquals('a***n@gmail.com', $this->anonymise('admin@gmail.com'));
        $this->assertEquals('r***t@googlemail.com', $this->anonymise('root@googlemail.com'));
        $this->assertEquals('w***r@hotmail.co.uk', $this->anonymise('webmaster@hotmail.co.uk'));
        $this->assertEquals('w***r@outlook.com', $this->anonymise('webmaster@outlook.com'));

        $this->assertEquals('j***e@e***m', $this->anonymise('john.doe@example.com'));
        $this->assertEquals('n***y@b***o', $this->anonymise('no-reply@benyoung.io'));
        $this->assertEquals('a***a@e***g', $this->anonymise('a@example.org'));
        $this->assertEquals('a***b@e***g', $this->anonymise('ab@example.org'));
        $this->assertEquals('a***c@e***g', $this->anonymise('abc@example.org'));

        $this->assertEquals('m***l@a***s', $this->anonymise('might be an email @ address'));

        $this->assertThrows(\InvalidArgumentException::class, function() {
            $this->anonymise('no domain');
        });

        $this->assertThrows(\InvalidArgumentException::class, function() {
            $this->anonymise('too@many@domains');
        });
    }
}
