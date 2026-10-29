<?php

namespace App\Support;

class Phone
{
    /**
     * Digits for a wa.me link, or null when the phone has none.
     *
     * "+" or "00" marks an international number and is kept as typed. Anything else is read as
     * Lebanese: the trunk 0 is dropped and 961 is added, so "03 123 456" and "+961 3 123 456"
     * both give 9613123456.
     */
    public static function whatsapp(?string $phone): ?string
    {
        $digits = preg_replace('/\D/', '', (string) $phone);

        if ($digits === '') {
            return null;
        }

        if (str_starts_with(trim((string) $phone), '+') || str_starts_with($digits, '00')) {
            $digits = preg_replace('/^00/', '', $digits);
        } elseif (! str_starts_with($digits, '961')) {
            $digits = '961'.ltrim($digits, '0');
        }

        // "+961 (0)3 123 456": drop the trunk 0 that follows the country code.
        return preg_replace('/^9610/', '961', $digits);
    }
}
