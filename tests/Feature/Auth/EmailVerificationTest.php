<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    public function test_email_verification_screen_can_be_rendered(): void
    {
        $this->markTestSkipped('Fitur email verification tidak digunakan.');
    }

    public function test_email_can_be_verified(): void
    {
        $this->markTestSkipped('Fitur email verification tidak digunakan.');
    }

    public function test_email_is_not_verified_with_invalid_hash(): void
    {
        $this->markTestSkipped('Fitur email verification tidak digunakan.');
    }
}