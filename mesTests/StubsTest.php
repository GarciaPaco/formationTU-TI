<?php
namespace mesTests;
require_once "EmailServices/EmailServices.php";

use PHPUnit\Framework\TestCase;
use EmailServices\EmailServices;

final class StubsTest extends TestCase
{
    public function testStub(): void
    {
        // Create a stub for the EmailServices class.
        $stub = $this->createStub(EmailServices::class);

        // Configure the stub.
        $stub->method('sendEmail')
            ->willReturn('foo');

        // Calling $stub->sendEmail() will now return
        // 'foo'.
        $this->assertSame('foo', $stub->sendEmail());
    }
}