<?php

namespace Tests\Unit;

use App\Support\Phone;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public static function numbers(): array
    {
        return [
            'local with trunk 0 and spaces' => ['03 123 456', '9613123456'],
            'international with plus and spaces' => ['+961 3 123 456', '9613123456'],
            'already 961 without plus' => ['961 3 123 456', '9613123456'],
            'double zero prefix' => ['00961 3 123 456', '9613123456'],
            'local without trunk 0' => ['3 123 456', '9613123456'],
            'two-digit mobile prefix' => ['70/000-000', '96170000000'],
            'trunk 0 kept after the country code' => ['+961 (0)3 123 456', '9613123456'],
            'foreign number keeps its country code' => ['+44 7911 123456', '447911123456'],
            'empty' => ['', null],
            'null' => [null, null],
            'no digits' => ['call me', null],
        ];
    }

    #[DataProvider('numbers')]
    public function test_whatsapp_digits(?string $input, ?string $expected): void
    {
        $this->assertSame($expected, Phone::whatsapp($input));
    }
}
